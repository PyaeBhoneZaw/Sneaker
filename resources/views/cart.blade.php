@extends('layouts.app')
@section('content')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <div class="container">

        <div class="row g-0">
            <div class="col-md-6 col-sm-12 mb-3 mt-4" style="max-width: auto">
                <img src="https://img.freepik.com/premium-vector/shoe-logo-design_639744-220.jpg?w=2000" class="card-img">

            </div>
            <div class="col-md-6">
                <h3 class=" text-center mb-5">Order Summary</h3>

                <div class="mb-3">
                    <div class="card-body">
                        <h5 class="card-title mb-3">
                            {{ $shoe->shoe_name }}
                        </h5>
                        <p class="card-text">
                            <b>Brand:</b>
                            {{ $shoe->shoeModel->brand->name }}
                        </p>
                        <p class="card-text">
                            <b>Model:</b>
                            {{ $shoe->shoeModel->name }}
                        </p>
                        <p class="card-text">
                            <b>Price:</b>
                            $ {{ $shoe->price }}
                        </p>
                        <p class="card-text">
                            <b>Selected Size:</b>
                            {{ $selectedSize }}
                        </p>
                    </div>
                </div>

                <form method="POST" action="{{ route('shoes.checkout') }}">
                    @csrf

                    <div class="row mb-3">
                        <div class="col-md-6 mb-3">
                            <input type="text" class="form-control" placeholder="First Name" name="first_name" required>
                        </div>

                        <div class="col-md-6 mb-3">
                            <input type="text" class="form-control" placeholder="Last Name" name="last_name" required>
                        </div>
                    </div>

                    <div class="mb-3">
                        <input type="text" class="form-control" placeholder="Email" name="email" required>
                    </div>

                    <div class="mb-3">
                        <input type="text" class="form-control" placeholder="Phone" name="phone" required>
                    </div>

                    <div class="mb-3">
                        <textarea class="form-control" id="address" placeholder="Address" name="address" rows="3" required></textarea>
                    </div>

                    <button type="submit" class="btn btn-dark align-content-center">Checkout</button>
                </form>


            </div>

        </div>

    </div>
@endsection
