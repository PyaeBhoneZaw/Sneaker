@extends('layouts.app')
@section('content')
    <div class="container">
        <h1>Shoes List</h1>

        @if (session('info'))
            <div class="alert alert-info" id="info">
                {{ session('info') }}
            </div>
            <script>
                setTimeout(function() {
                    document.getElementById('info').style.display = 'none';
                }, 3000);
            </script>
        @endif

        <div class="row flex-wrap">
            @foreach ($shoes as $shoe)
                <div class="col-12 col-md-6 col-xl-3 p-3">

                    <div class="card p-3">
                        <div class="card-body">
                            <div class="row flex-wrap">
                                <a class="btn" href="{{ url("/shoes/detail/$shoe->id") }}">
                                    <div class="col-12 col-md-12">
                                        <img src="https://img.freepik.com/premium-vector/shoe-logo-design_639744-220.jpg?w=2000"
                                            class="card-img">
                                    </div>
                                </a>
                                <div class="col-12 col-md-12 mt-lg-2">
                                    <div class="card-header mb-3">
                                        <b>{{ $shoe->shoe_name }}</b>
                                    </div>
                                    <span class="card-text mt-2">
                                        <b>Brand: {{ $shoe->shoeModel->brand->name }} </b>
                                        <br>
                                    </span>
                                    <span class="card-text mt-2">
                                        <b>Model: {{ $shoe->shoeModel->name }} </b>
                                        <br>
                                    </span>
                                    <span class="card-text mt-2">
                                        <b> $ {{ $shoe->price }} </b>
                                        <br>
                                    </span>
                                </div>

                            </div>
                            @if (Auth::user() && Auth::user()->role == 'admin')
                                <div>
                                    <button type="button" class="btn btn-outline-dark mt-2 mb-0 w-25"
                                        data-bs-toggle="modal" data-bs-target="#editModal{{ $shoe->id }}">
                                        Edit
                                    </button>
                                </div>
                            @endif
                        </div>
                    </div>

                </div>

                {{-- Edit Modal --}}
                <div class="modal fade" id="editModal{{ $shoe->id }}" tabindex="-1" aria-labelledby="editModalLabel"
                    aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content p-3">
                            <div class="modal-header">
                                <h3 class="modal-title mx-auto" id="editModalLabel">Edit Shoe
                                </h3>
                                <span>
                                    <button type="button" class="btn-close ml-auto" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </span>

                            </div>
                            <div class="modal-body">
                                <!-- Your update form goes here -->
                                <form action="{{ route('shoes.update', ['id' => $shoe->id]) }}" method="POST">
                                    @csrf
                                    @method('PUT')

                                    <div class="mb-3">
                                        <label for="shoe_name" class="form-label">Shoe Name</label>
                                        <input type="text" class="form-control" id="shoe_name" name="shoe_name"
                                            value="{{ $shoe->shoe_name }}">
                                    </div>

                                    {{-- <div class="mb-3">
                                        <label for="model" class="form-label">Model</label>
                                        <input type="text" class="form-control" id="model" name="model"
                                            value="{{ $shoe->shoeModel->name }}">
                                    </div> --}}

                                    <div class="mb-3">
                                        <label for="price" class="form-label">Price</label>
                                        <div class="input-group">
                                            <span class="input-group-text">$</span>
                                            <input type="number" class="form-control" id="price" name="price"
                                                value="{{ $shoe->price }}">
                                        </div>
                                    </div>

                                    <button type="submit" class="btn btn-outline-success text-end">Update</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
            <div class="d-flex justify-content-center mt-5">
                {{ $shoes->links() }}
            </div>


        </div>
    </div>
@endsection
