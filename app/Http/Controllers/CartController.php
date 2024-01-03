<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Cart;
use App\Models\Shoe;
use App\Models\User;

class CartController extends Controller
{
    public function index()
    {
        if (Auth::check()) {
            $cartItems = auth()->user()->cartItems; // Assuming you have a 'cartItems' relationship in your User model

            return view('carts.index', compact('cartItems'));
        }
        return redirect()->route('login');
    }
    public function addToCart(Request $request, $id)
    {
        if (Auth::check()) {
            $validator = validator(request()->all(), [
                'shoe_size' => 'required',
            ]);

            if ($validator->fails()) {
                return back()->withErrors('Please Select Size');
            }

            $shoe = Shoe::find($id);
            $user_id = Auth::id();
            $selectedSize = $request->input('shoe_size');

            $data = new Cart();
            $data->user_id = $user_id;
            $data->shoe_id = $shoe->id;
            $data->shoe_name = $shoe->shoe_name;
            $data->shoe_model = $shoe->shoeModel->name;
            $data->size = $selectedSize;
            $data->price = $shoe->price;
            $data->save();

            return back()->with('info', 'Added to Cart');
        }
        session(['previous_url' => url()->previous()]);

        return redirect()->route('login');
    }

    public function updateQuantity($id)
    {
        $validator = validator(request()->all(), [
            'shoe_size' => 'required',
        ]);

        if ($validator->fails()) {
            return back()->withErrors('Please Select Size');
        }
        $data = Cart::find($id);
        $data->quantity = request()->quantity;
        $data->save();

        return back()->with('info', 'Added to Cart');
    }
    public function removeFromCart($cartItemId)
    {
        $cartItem = Cart::findOrFail($cartItemId);

        // You might want to check if the authenticated user owns this cart item
        if ($cartItem->user_id == auth()->id()) {
            $cartItem->delete();
            return redirect()->route('cart.index')->with('info', 'Item removed from cart successfully.');
        }

        // Handle unauthorized access or redirect as needed
    }
    public function checkout()
    {
        // Assuming you have a Cart model with a relationship to Shoe
        $cartItems = Cart::with('shoe')->where('user_id', auth()->id())->get();

        // You can pass $cartItems to your checkout view
        return view('checkout.confirmation', ['cartItems' => $cartItems]);
    }
}
