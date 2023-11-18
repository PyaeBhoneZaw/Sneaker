@extends('layouts.app')
@section('content')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <div class="container">
        <ol class="breadcrumb mx-2">
            <a class="breadcrumb-item active ms-1" href="{{ url('/shoes') }}"><i class="fa-solid fa-angle-left fa-2xl"></i></a>
        </ol>
        <div class="mb-3 mt-4" style="max-width: auto">
            <div class="row g-0">
                <div class="col-md-4 col-sm-12">
                    <img src="https://img.freepik.com/premium-vector/shoe-logo-design_639744-220.jpg?w=2000"
                        class="card-img">
                </div>
                <div class="card-body mx-4">
                    <h5 class="card-title">
                        {{ $shoe->shoe_name }}
                    </h5>
                    <div class="car-subtitle mb-2 text-muted small">
                        {{ $shoe->created_at->diffForHumans() }}
                    </div>
                    <p class="card-text">
                        $ {{ $shoe->price }}
                    </p>
                    <a href="{{ url("/shoes/delete/$shoe->id") }}" class="btn btn-outline-danger">Delete</a>
                </div>
            </div>
        </div>
    </div>
@endsection
