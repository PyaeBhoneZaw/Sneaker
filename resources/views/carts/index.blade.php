@extends('layouts.app')

@section('content')
    <div class="container">

        @if (session('info'))
            <div class="alert alert-info text-center" id="info">
                {{ session('info') }}
            </div>
            <script>
                setTimeout(function() {
                    document.getElementById('info').style.display = 'none';
                }, 3000);
            </script>
        @endif
        <ol class="breadcrumb mx-2">
            <a class="breadcrumb-item active ms-1" href="{{ route('shoes') }}"><i
                    class="fa-solid fa-angle-left fa-2xl"></i></a>
        </ol>
        <h2 class="mb-5 text-center">My Cart</h2>

        @if ($cartItems->isEmpty())
            <h3 class="text-center">Your cart is empty.</h3>
        @else
            <div class="row">
                <div class="col-12">
                    <table class="table mb-5">
                        <thead>
                            <tr>
                                <th>Image</th>
                                <th>Shoe Name</th>
                                <th>Size</th>
                                <th>Quantity</th>
                                <th>Price</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($cartItems as $cartItem)
                                <tr>
                                    <td>
                                        <img src="{{ asset('storage/images/shoes/' . basename($cartItem->shoe->shoe_image)) }}"
                                            alt="{{ $cartItem->shoe->shoe_name }}"
                                            style="max-width: 100px; max-height: 100px;">
                                    </td>
                                    <td>{{ $cartItem->shoe->shoe_name }}</td>
                                    <td>{{ $cartItem->size }}</td>
                                    <td>{{ $cartItem->quantity }}</td>
                                    <td>${{ $cartItem->shoe->price }}</td>
                                    <td>
                                        <a href="{{ route('cart.remove', $cartItem->id) }}"
                                            class="btn btn-outline-dark">Remove</a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>



            <div class="text-center">
                <a href="{{ route('checkout.form') }}" class="btn btn-outline-dark">Checkout</a>
            </div>
        @endif
    </div>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>

    <script>
        $(document).ready(function() {
            var quantityInput = $('#quantityInput');

            $('#increaseBtn').click(function() {
                quantityInput.val(parseInt(quantityInput.val()) + 1);
            });

            $('#decreaseBtn').click(function() {
                var currentValue = parseInt(quantityInput.val());
                if (currentValue > 1) {
                    quantityInput.val(currentValue - 1);
                }
            });
        });
    </script>
@endsection
