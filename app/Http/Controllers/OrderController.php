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
                'firstName' => 'required',
                'lastName' => 'required',
                'email' => 'required',
                'phone' => 'required',
                'payment_type' => 'required',
            ]);

            if ($validator->fails()) {
                return back()->withErrors($validator);
            }
            $cartItems = Cart::where('user_id', auth()->id())->get();
            $user_id = Auth::id();
            foreach ($cartItems as $cartItem) {
                $shoe = Shoe::find($cartItem->shoe_id);

                $data = new Order();
                $data->user_id = $user_id;
                $data->firstName = request()->firstName;
                $data->lastName = request()->lastName;
                $data->email = request()->email;
                $data->phone = request()->phone;
                $data->address = request()->address;
                $data->orderDate = Carbon::now()->format('F j, Y');
                $data->shoe_name = $cartItem->shoe_name;
                $data->price = $cartItem->price;
                $data->quantity = $cartItem->quantity;
                $shoe->decrement('stock_quantity', $cartItem->quantity);
                $data->payment_type = request()->payment_type;
                $data->save();
            }

            $cartItems = Cart::where('user_id', auth()->id())->get();

            foreach ($cartItems as $cartItem) {

                OrderDetail::create([
                    'order_id' => $data->id,
                    'shoe_id' => $cartItem->shoe_id,
                    'size' => $cartItem->size,
                    'total_price' => $cartItem->price,
                ]);

                $cartItem->delete();
            }
            session()->flash('success', 'Your order has been successfully processed.');
            return redirect()->route('home');
        }
    }
    public function dashboard()
    {
        $data = Order::latest()->paginate(12);
        return view('order_dashboard', ['orders' => $data]);
    }
    public function delete($id)
    {
        $data = Order::find($id);
        $data->delete();
        return back()->with('info', 'Order Deleted');
    }
}
