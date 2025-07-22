<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Shoe;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class CartController extends Controller
{
    /**
     * Display the user's cart
     */
    public function index()
    {
        $cartItems = Cart::with(['shoe.shoeModel.brand'])
            ->where('user_id', Auth::id())
            ->get();

        $total = $cartItems->sum(function ($item) {
            return $item->quantity * $item->shoe->price;
        });

        return response()->json([
            'success' => true,
            'data' => [
                'cart_items' => $cartItems,
                'total_items' => $cartItems->sum('quantity'),
                'total_amount' => $total
            ]
        ]);
    }

    /**
     * Add item to cart
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'shoe_id' => 'required|exists:shoes,id',
            'quantity' => 'required|integer|min:1',
            'size' => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validation errors',
                'errors' => $validator->errors()
            ], 422);
        }

        $shoe = Shoe::find($request->shoe_id);

        // Check stock availability
        if ($shoe->stock_quantity < $request->quantity) {
            return response()->json([
                'success' => false,
                'message' => 'Insufficient stock available'
            ], 400);
        }

        // Check if item already exists in cart
        $existingCartItem = Cart::where('user_id', Auth::id())
            ->where('shoe_id', $request->shoe_id)
            ->where('size', $request->size)
            ->first();

        if ($existingCartItem) {
            // Update quantity
            $newQuantity = $existingCartItem->quantity + $request->quantity;

            if ($shoe->stock_quantity < $newQuantity) {
                return response()->json([
                    'success' => false,
                    'message' => 'Insufficient stock available'
                ], 400);
            }

            $existingCartItem->quantity = $newQuantity;
            $existingCartItem->save();

            $cartItem = $existingCartItem;
        } else {
            // Create new cart item
            $cartItem = Cart::create([
                'user_id' => Auth::id(),
                'shoe_id' => $request->shoe_id,
                'quantity' => $request->quantity,
                'size' => $request->size,
            ]);
        }

        $cartItem->load(['shoe.shoeModel.brand']);

        return response()->json([
            'success' => true,
            'message' => 'Item added to cart successfully',
            'data' => $cartItem
        ], 201);
    }

    /**
     * Update cart item
     */
    public function update(Request $request, $id)
    {
        $cartItem = Cart::where('id', $id)
            ->where('user_id', Auth::id())
            ->first();

        if (!$cartItem) {
            return response()->json([
                'success' => false,
                'message' => 'Cart item not found'
            ], 404);
        }

        $validator = Validator::make($request->all(), [
            'quantity' => 'required|integer|min:1',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validation errors',
                'errors' => $validator->errors()
            ], 422);
        }

        // Check stock availability
        if ($cartItem->shoe->stock_quantity < $request->quantity) {
            return response()->json([
                'success' => false,
                'message' => 'Insufficient stock available'
            ], 400);
        }

        $cartItem->quantity = $request->quantity;
        $cartItem->save();

        $cartItem->load(['shoe.shoeModel.brand']);

        return response()->json([
            'success' => true,
            'message' => 'Cart item updated successfully',
            'data' => $cartItem
        ]);
    }

    /**
     * Remove item from cart
     */
    public function destroy($id)
    {
        $cartItem = Cart::where('id', $id)
            ->where('user_id', Auth::id())
            ->first();

        if (!$cartItem) {
            return response()->json([
                'success' => false,
                'message' => 'Cart item not found'
            ], 404);
        }

        $cartItem->delete();

        return response()->json([
            'success' => true,
            'message' => 'Item removed from cart successfully'
        ]);
    }

    /**
     * Clear all items from cart
     */
    public function clear()
    {
        Cart::where('user_id', Auth::id())->delete();

        return response()->json([
            'success' => true,
            'message' => 'Cart cleared successfully'
        ]);
    }

    /**
     * Get cart item count
     */
    public function count()
    {
        $count = Cart::where('user_id', Auth::id())->sum('quantity');

        return response()->json([
            'success' => true,
            'data' => [
                'count' => $count
            ]
        ]);
    }
}
