<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Cart;
use App\Models\Shoe;
use Carbon\Carbon;

class OrderController extends Controller
{
    public function showCheckoutForm()
    {
        // Fetch cart items for the checkout form
        $cartItems = Cart::where('user_id', auth()->id())->get();

        return view('checkout', compact('cartItems'));
    }

    public function processCheckout(Request $request)
    {

        if (Auth::check()) {
            $validator = validator(request()->all(), [
                'customer_name' => 'required',
                'email' => 'required',
                'payment_type' => 'required',
            ]);

            if ($validator->fails()) {
                return back()->withErrors('Please Fill Information');
            }
            $cartItems = Cart::where('user_id', auth()->id())->get();

            foreach ($cartItems as $cartItem) {
                $data = new Order();
                $data->customer_name = request()->customer_name;
                $data->email = request()->email;
                $data->orderDate = Carbon::now();
                $data->shoe_name = $cartItem->shoe_name;
                $data->price = $cartItem->price;
                $data->quantity = $cartItem->quantity;
                $data->payment_type = request()->payment_type;
                $data->save();
            }

            // Fetch cart items for the user
            $cartItems = Cart::where('user_id', auth()->id())->get();

            foreach ($cartItems as $cartItem) {
                // Create order detail for each cart item

                OrderDetail::create([
                    'order_id' => $data->id,
                    'shoe_id' => $cartItem->shoe_id,
                    'size' => $cartItem->size,
                    'total_price' => $cartItem->price,
                ]);

                $cartItem->delete();
            }

            // Redirect or show a success message
            return redirect()->route('checkout.success')->with('success', 'Order placed successfully!');
        }
    }

    public function checkoutSuccess()
    {
        // You can customize this view or redirect logic
        return view('checkoutSuccess');
    }
}
