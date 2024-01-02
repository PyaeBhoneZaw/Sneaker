@extends('layouts.app')

@section('content')
    <div class="container">
        <ol class="breadcrumb mx-2">
            <a class="breadcrumb-item active ms-1" href="{{ url()->previous() }}"><i
                    class="fa-solid fa-angle-left fa-2xl"></i></a>
        </ol>
        <h2 class="mb-5 text-center">Your Cart</h2>

        @if ($cartItems->isEmpty())
            <p>Your cart is empty.</p>
        @else
            <table class="table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Shoe Name</th>
                        <th>Size</th>
                        <th>Price</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($cartItems as $cartItem)
                        <tr>
                            <td>{{ $cartItem->id }}</td>
                            <td>{{ $cartItem->shoe->shoe_name }}</td>
                            <td>{{ $cartItem->size }}</td>
                            <td>${{ $cartItem->shoe->price }}</td>
                            <td>
                                <a href="{{ route('cart.remove', $cartItem->id) }}"
                                    class="btn btn-outline-secondary">Remove</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            <div class="text-end">
                <a href="{{ route('checkout') }}" class="btn btn-outline-dark">Checkout</a>
            </div>
        @endif
    </div>
@endsection
