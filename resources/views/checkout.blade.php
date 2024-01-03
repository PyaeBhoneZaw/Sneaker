@extends('layouts.app')

@section('content')
    <div class="container">
        <h2 class="mb-4">Checkout</h2>

        <form action="{{ route('checkout.process') }}" method="post" class="m-3 card p-3 mx-5">
            @csrf

            <div class="mb-3">
                <label for="customer_name" class="form-label">Customer Name</label>
                <input type="text" class="form-control" id="customer_name" name="customer_name" required>
            </div>

            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" id="email" name="email" required>
            </div>


            <div class="mb-3">
                <label for="order_date" class="form-label">Order Date</label>
                <input type="text" class="form-control" id="order_date" name="order_date" value="{{ now() }}"
                    readonly>
            </div>

            <div class="mb-3">
                <label for="payment_type" class="form-label">Payment Type</label>
                <select class="form-select" id="payment_type" name="payment_type" required>
                    <option value="credit_card">Credit Card</option>
                    <option value="paypal">PayPal</option>
                    <!-- Add more payment options as needed -->
                </select>
            </div>

            <!-- Add more fields for additional customer information as needed -->

            <div class="text-lg-center text-md-end text-sm-center">
                <input type="submit" value="Order" class="btn btn-outline-dark w-25">
            </div>
        </form>
    </div>
@endsection
