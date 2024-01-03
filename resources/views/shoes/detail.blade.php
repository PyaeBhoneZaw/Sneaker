@extends('layouts.app')
@section('content')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <style>
        .size-btn {
            width: 50px;
            /* Set your desired width */
            height: 50px;
            /* Set your desired height */
            text-align: center;
            line-height: 35px;
            border-radius: 30px
        }
    </style>
    <div class="container">
        @if ($errors->any())
            <div class="alert alert-danger text-center">
                <ul class="my-auto">
                    @foreach ($errors->all() as $error)
                        {{ $error }}
                    @endforeach
                </ul>
            </div>
        @endif
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
        <ol class="breadcrumb mx-2">
            <a class="breadcrumb-item active ms-1" href="{{ url()->previous() }}"><i
                    class="fa-solid fa-angle-left fa-2xl"></i></a>
        </ol>


        <div class="row g-0">
            <div class="col-md-6 col-sm-12 mb-3 mt-4" style="max-width: auto">
                <img src="https://img.freepik.com/premium-vector/shoe-logo-design_639744-220.jpg?w=2000" class="card-img">

            </div>
            <div class="col-md-6 mb-3">
                <div class="card-body mx-4 mb-5">
                    <h5 class="card-title mb-2">
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
                        $ <b> {{ $shoe->price }}</b>
                    </p>
                </div>

                <form method="POST" action="{{ route('cart.addToCart', $shoe->id) }}">
                    @csrf
                    <input type="hidden" name="selected_size" id="selected_size" value="">
                    <div class="mx-4">
                        @foreach (json_decode($shoe->size) as $size)
                            <input type="radio" class="btn-check m-2" name="shoe_size" id="size_{{ $size }}"
                                value="{{ $size }}" autocomplete="off"
                                onclick="setSelectedSize('{{ $size }}')">
                            <label class="btn btn-outline-dark m-2 size-btn"
                                for="size_{{ $size }}">{{ $size }}</label>
                        @endforeach
                    </div>

                    <div class="m-5 text-end">
                        <button type="submit" class="btn btn-dark">Add to Cart</button>
                    </div>
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
