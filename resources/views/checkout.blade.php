@extends('layouts.app')

@section('content')
    <div class="container" style="max-width: 1000px">
        <h2 class="mb-4 mx-5">Checkout</h2>

        <form action="{{ route('checkout.process') }}" method="POST" class="m-3 card p-3 mx-5 p-4" id="checkoutForm">
            @csrf

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="firstname" class="form-label">First Name</label>
                    <input type="text" class="form-control" id="firstname" name="firstName" required>
                </div>

                <div class="col-md-6 mb-3">
                    <label for="lastname" class="form-label">Last Name</label>
                    <input type="text" class="form-control" id="lastname" name="lastName" required>
                </div>
            </div>

            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" id="email" name="email" required>
            </div>

            <div class="mb-3">
                <label for="phone" class="form-label">Phone</label>
                <input type="text" class="form-control" id="phone" name="phone" required>
            </div>

            <div class="mb-3">
                <label for="order_date" class="form-label">Order Date</label>
                <input type="text" class="form-control" id="order_date" name="order_date" value="{{ now() }}"
                    readonly>
            </div>

            <div class="mb-5">
                <label class="form-label">Payment Type</label>
                <div aria-label="Payment Type">
                    <button type="button" class="btn btn-outline-dark payment-option" data-value="cash">
                        <img src="{{ asset('images/icons8-cash-48.png') }}" alt="Cash">
                        Cash
                    </button>
                    <button type="button" class="btn btn-outline-dark payment-option" data-value="credit_card">
                        <img src="{{ asset('images/icons8-credit-card-48.png') }}" alt="Credit Card">
                        Credit Card
                    </button>
                    <button type="button" class="btn btn-outline-dark payment-option" data-value="paypal">
                        <img src="{{ asset('images/icons8-paypal-48.png') }}" alt="PayPal">
                        PayPal
                    </button>
                    <button type="button" class="btn btn-outline-dark payment-option" data-value="visa">
                        <img src="{{ asset('images/icons8-visa-48.png') }}" alt="Visa">
                        Visa
                    </button>
                </div>
                <input type="hidden" name="payment_type" id="payment_type" value="" required>
            </div>

            <div class="text-lg-center text-md-end text-sm-center">
                <input type="submit" value="Order" class="btn btn-outline-dark w-25" data-toggle="modal"
                    data-target="#PopupInfo">
            </div>
        </form>

        <script>
            document.querySelectorAll('.payment-option').forEach(function(button) {
                button.addEventListener('click', function() {
                    document.getElementById('payment_type').value = this.getAttribute('data-value');
                    document.querySelectorAll('.payment-option').forEach(function(btn) {
                        btn.classList.remove('active');
                    });
                    this.classList.add('active');
                });
            });
        </script>
    </div>
@endsection
