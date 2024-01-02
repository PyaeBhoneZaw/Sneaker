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
