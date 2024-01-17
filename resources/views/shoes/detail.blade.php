@extends('layouts.app')
@section('content')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <style>
        .size-btn {
            width: 50px;
            height: 50px;
            text-align: center;
            line-height: 35px;
            border-radius: 30px
        }
    </style>
    <div class="container">
        @if ($errors->any())
            <div class="alert alert-danger text-center" id="info">
                <ul class="my-auto">
                    @foreach ($errors->all() as $error)
                        {{ $error }}
                    @endforeach
                </ul>
            </div>
            <script>
                setTimeout(function() {
                    document.getElementById('info').style.display = 'none';
                }, 3000);
            </script>
        @endif
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
            <a class="breadcrumb-item active ms-1" href="{{ url()->previous() }}"><i
                    class="fa-solid fa-angle-left fa-2xl"></i></a>
        </ol>
        @if ($shoe->stock_quantity <= 0)
            <div class="alert alert-danger text-center">
                Out of Stock!
            </div>
        @endif


        <div class="row g-0">

            <div class="col-md-5 col-sm-12 mb-3 mt-2" style="max-width: auto">
                <img src="{{ asset('storage/images/shoes/' . basename($shoe->shoe_image)) }}" alt="{{ $shoe->shoe_name }}"
                    class="card-img" style="height: 300px, width: 300px">
            </div>

            <div class="col-md-1"></div>

            <div class="col-md-6">
                <div class="card-body mx-5">
                    <h2 class="card-title">
                        <b>{{ $shoe->shoe_name }}</b>
                    </h2>
                    <p class="card-text fw-semibold h4 mt-3">
                        {{ $shoe->shoeModel->brand->brand_name }} / {{ $shoe->shoeModel->model_name }}
                    </p>
                    <p class="card-text fw-semibold h4 mt-4">
                        <b>$ {{ $shoe->price }}</b>
                    </p>
                    <hr>
                </div>

                <form method="POST" action="{{ route('cart.addToCart', $shoe->id) }}">
                    @csrf
                    <label for="select_size" class="mx-5 h4">Choose Size</label>
                    <input type="hidden" name="selected_size" id="selected_size" value="">
                    <div class="mx-5">
                        @foreach (json_decode($shoe->size) as $size)
                            <input type="radio" class="btn-check m-2" name="shoe_size" id="size_{{ $size }}"
                                value="{{ $size }}" autocomplete="off"
                                onclick="setSelectedSize('{{ $size }}')">
                            <label class="btn btn-outline-dark m-2 size-btn"
                                for="size_{{ $size }}">{{ $size }}</label>
                        @endforeach
                    </div>


                    @if ($shoe->stock_quantity == 0)
                        <div class="m-5 text-end">
                            <button type="submit" class="btn btn-dark" disabled>Add to Cart</button>
                        </div>
                    @else
                        <div class="m-5 text-end">
                            <button type="submit" class="btn btn-dark">Add to Cart</button>
                        </div>
                    @endif


                </form>
            </div>

        </div>


    </div>
    <script>
        function setSelectedSize(size) {
            document.getElementById('selected_size').value = size;
        }
    </script>
@endsection
