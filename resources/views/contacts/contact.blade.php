@extends('layouts.app')

@section('content')
    <h2 class="mb-4 text-center">Contact Form</h2>

    <div class="container card p-3" style="max-width: 800px">

        @if (session('message'))
            <div class="alert alert-success">
                {{ session('message') }}
            </div>
        @endif



        <div class="row g-0">
            <div class="col-md-6 col-sm-12 mb-3 mt-4">
                <form method="POST" action="{{ route('contacts.create') }}">
                    @csrf

                    <div class="mb-3">
                        <label for="name" class="form-label">Your Name</label>
                        <input type="text" class="form-control" id="name" name="name" required>
                    </div>

                    <div class="mb-3">
                        <label for="email" class="form-label">Your Email</label>
                        <input type="email" class="form-control" id="email" name="email" required>
                    </div>

                    <div class="mb-3">
                        <label for="message" class="form-label">Your Message</label>
                        <textarea class="form-control" id="message" name="message" rows="4" required></textarea>
                    </div>

                    <div class="text-center">
                        <button type="submit" class="btn btn-outline-dark w-75">Send</button>
                    </div>
                </form>
            </div>
            <div class="col-md-1">

            </div>
            <div class="col-md-5 d-flex align-items-center" style="background-color: rgba(218, 218, 222, 0.304)">
                <div class="fw-bold text-uppercase text-center text-black">
                    <h3 class=" fw-bold">Contact Us</h3>
                    <br>
                    <p>Address: 50th Street, Downtown, Yangon</p>
                    <p>Email: sneakerhub@gmail.com</p>
                    <p>Phone: (+959)795590951</p>
                </div>
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
@endsection
