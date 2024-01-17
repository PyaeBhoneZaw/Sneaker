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
        @if ($errors->any())
            <div class="alert alert-danger text-center" id="info">
                @foreach ($errors->all() as $error)
                    {{ $error }}
                @endforeach
            </div>
            <script>
                setTimeout(function() {
                    document.getElementById('info').style.display = 'none';
                }, 3000);
            </script>
        @endif

        <ol class="breadcrumb mx-2">
            <a class="breadcrumb-item active ms-1" href="{{ url()->previous() }}"><i
                    class="fa-solid fa-angle-left fa-2xl"></i></a>
        </ol>

        <h2 class="mb-5 text-center">Order List</h2>

        @if ($orders->isEmpty())
            <h3 class="text-center mt-4">There is no Orders</h3>
        @else
            <div class="row mb-3 h5 fw-bold">
                <div class="col-md-2">Name</div>
                <div class="col-md-2">Email</div>
                <div class="col-md-2">Phone</div>
                <div class="col-md-2">Shoe Name</div>
                <div class="col-md-2">Price</div>
                <div class="col-md-2">Order Date</div>
            </div>
            <hr>
            @foreach ($orders as $order)
                <div class="row mb-4">
                    <div class="col-md-2">
                        <p>{{ $order->firstName }} {{ $order->lastName }}</p>

                    </div>
                    <div class="col-md-2">
                        <p>{{ $order->email }}</p>
                    </div>
                    <div class="col-md-2">
                        <p>{{ $order->phone }}</p>
                    </div>
                    <div class="col-md-2">
                        <p>{{ $order->shoe_name }}</p>
                    </div>
                    <div class="col-md-2">
                        <p>$ {{ $order->price }}</p>
                    </div>
                    <div class="col-md-2">
                        <p>{{ $order->orderDate }}</p>
                        <a href="{{ url("/order/delete/$order->id") }}" class="btn btn-outline-dark btn-md"
                            data-bs-toggle="modal" data-bs-target="#confirmDeleteModal{{ $order->id }}">Delete</a>
                    </div>
                </div>
                <hr>
                {{-- Delete Confirmation Modal --}}
                <div class="modal fade" id="confirmDeleteModal{{ $order->id }}" tabindex="-1"
                    aria-labelledby="confirmDeleteModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content p-3">
                            <div class="modal-header">
                                <h3 class="modal-title mx-auto" id="confirmDeleteModalLabel">Confirm Delete</h3>
                            </div>
                            <div class="modal-body">
                                <h5>Are you sure you want to delete this order?</h5>
                            </div>
                            <div class="modal-footer text-center">
                                <button type="button" class="btn btn-outline-dark" data-bs-dismiss="modal">Cancel</button>
                                <a href="{{ url("/order/delete/$order->id") }}" class="btn btn-outline-danger">Delete</a>
                            </div>
                        </div>
                    </div>
                </div>
                {{-- Model End --}}
            @endforeach
        @endif
    </div>
@endsection
