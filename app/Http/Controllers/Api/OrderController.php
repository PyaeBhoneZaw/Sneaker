<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Cart;
use App\Models\Shoe;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class OrderController extends Controller
{
    /**
     * Display user's orders
     */
    public function index()
    {
        $orders = Order::with(['orderDetails.shoe.shoeModel.brand'])
            ->where('user_id', Auth::id())
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return response()->json([
            'success' => true,
            'data' => [
                'orders' => $orders->items(),
                'pagination' => [
                    'current_page' => $orders->currentPage(),
                    'last_page' => $orders->lastPage(),
                    'per_page' => $orders->perPage(),
                    'total' => $orders->total(),
                ]
            ]
        ]);
    }

    /**
     * Create a new order (checkout)
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'shipping_address' => 'required|string|max:500',
            'phone' => 'required|string|max:20',
            'payment_method' => 'required|in:credit_card,paypal,cash_on_delivery',
            'payment_details' => 'nullable|array',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validation errors',
                'errors' => $validator->errors()
            ], 422);
        }

        // Get user's cart items
        $cartItems = Cart::with('shoe')
            ->where('user_id', Auth::id())
            ->get();

        if ($cartItems->isEmpty()) {
            return response()->json([
                'success' => false,
                'message' => 'Cart is empty'
            ], 400);
        }

        // Check stock availability for all items
        foreach ($cartItems as $cartItem) {
            if ($cartItem->shoe->stock_quantity < $cartItem->quantity) {
                return response()->json([
                    'success' => false,
                    'message' => "Insufficient stock for {$cartItem->shoe->shoe_name}"
                ], 400);
            }
        }

        // Calculate total
        $totalAmount = $cartItems->sum(function ($item) {
            return $item->quantity * $item->shoe->price;
        });

        DB::beginTransaction();

        try {
            // Process mock payment
            $paymentResult = $this->processMockPayment($request->payment_method, $totalAmount, $request->payment_details);

            if (!$paymentResult['success']) {
                return response()->json([
                    'success' => false,
                    'message' => $paymentResult['message']
                ], 400);
            }

            // Create order
            $order = Order::create([
                'user_id' => Auth::id(),
                'total_amount' => $totalAmount,
                'shipping_address' => $request->shipping_address,
                'phone' => $request->phone,
                'payment_method' => $request->payment_method,
                'payment_status' => $paymentResult['status'],
                'payment_transaction_id' => $paymentResult['transaction_id'],
                'order_status' => 'pending',
            ]);

            // Create order details and update stock
            foreach ($cartItems as $cartItem) {
                OrderDetail::create([
                    'order_id' => $order->id,
                    'shoe_id' => $cartItem->shoe_id,
                    'quantity' => $cartItem->quantity,
                    'price' => $cartItem->shoe->price,
                    'size' => $cartItem->size,
                ]);

                // Update stock
                $shoe = Shoe::find($cartItem->shoe_id);
                $shoe->stock_quantity -= $cartItem->quantity;
                $shoe->save();
            }

            // Clear cart
            Cart::where('user_id', Auth::id())->delete();

            DB::commit();

            // Load order with details
            $order->load(['orderDetails.shoe.shoeModel.brand']);

            return response()->json([
                'success' => true,
                'message' => 'Order placed successfully',
                'data' => $order
            ], 201);

        } catch (\Exception $e) {
            DB::rollback();
            return response()->json([
                'success' => false,
                'message' => 'Failed to process order'
            ], 500);
        }
    }

    /**
     * Display the specified order
     */
    public function show($id)
    {
        $order = Order::with(['orderDetails.shoe.shoeModel.brand'])
            ->where('id', $id)
            ->where('user_id', Auth::id())
            ->first();

        if (!$order) {
            return response()->json([
                'success' => false,
                'message' => 'Order not found'
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data' => $order
        ]);
    }

    /**
     * Cancel an order (if status is pending)
     */
    public function cancel($id)
    {
        $order = Order::where('id', $id)
            ->where('user_id', Auth::id())
            ->first();

        if (!$order) {
            return response()->json([
                'success' => false,
                'message' => 'Order not found'
            ], 404);
        }

        if ($order->order_status !== 'pending') {
            return response()->json([
                'success' => false,
                'message' => 'Order cannot be cancelled'
            ], 400);
        }

        DB::beginTransaction();

        try {
            // Restore stock
            foreach ($order->orderDetails as $detail) {
                $shoe = Shoe::find($detail->shoe_id);
                $shoe->stock_quantity += $detail->quantity;
                $shoe->save();
            }

            // Update order status
            $order->order_status = 'cancelled';
            $order->save();

            DB::commit();

            return response()->json([
                'success' => true,
                'message' => 'Order cancelled successfully',
                'data' => $order
            ]);

        } catch (\Exception $e) {
            DB::rollback();
            return response()->json([
                'success' => false,
                'message' => 'Failed to cancel order'
            ], 500);
        }
    }

    /**
     * Mock payment processing
     */
    private function processMockPayment($paymentMethod, $amount, $paymentDetails = null)
    {
        // Simulate different payment scenarios
        $scenarios = ['success', 'failure', 'pending'];
        $randomScenario = $scenarios[array_rand($scenarios)];

        // For demo purposes, let's make success more likely
        if (rand(1, 10) <= 8) {
            $randomScenario = 'success';
        }

        switch ($randomScenario) {
            case 'success':
                return [
                    'success' => true,
                    'status' => 'completed',
                    'transaction_id' => 'TXN_' . strtoupper(uniqid()),
                    'message' => 'Payment processed successfully'
                ];

            case 'pending':
                return [
                    'success' => true,
                    'status' => 'pending',
                    'transaction_id' => 'TXN_' . strtoupper(uniqid()),
                    'message' => 'Payment is being processed'
                ];

            case 'failure':
            default:
                return [
                    'success' => false,
                    'status' => 'failed',
                    'transaction_id' => null,
                    'message' => 'Payment failed. Please try again.'
                ];
        }
    }

    /**
     * Get order statistics for admin
     */
    public function statistics()
    {
        $totalOrders = Order::count();
        $totalRevenue = Order::where('payment_status', 'completed')->sum('total_amount');
        $pendingOrders = Order::where('order_status', 'pending')->count();
        $completedOrders = Order::where('order_status', 'completed')->count();

        return response()->json([
            'success' => true,
            'data' => [
                'total_orders' => $totalOrders,
                'total_revenue' => $totalRevenue,
                'pending_orders' => $pendingOrders,
                'completed_orders' => $completedOrders,
            ]
        ]);
    }
}
