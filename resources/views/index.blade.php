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

        <h1 class="text-center fw-bold text-uppercase mt-3">Step Up Your Style Game – One Sneaker at a Time.</h1>
        <div class="row flex-wrap mt-5">
            @foreach ($shoes as $shoe)
                <div class="col-12 col-md-6 col-sm-12 col-xl-3">
                    <a class="btn p-0" href="{{ url("/shoes/detail/$shoe->id") }}">
                        <div class="card p-1 mb-5" style="height: 350px;">
                            <div class="card-body">
                                <div class="row flex-wrap">
                                    <div class="col-12 col-md-12">
                                        <img src="{{ asset('storage/images/shoes/' . basename($shoe->shoe_image)) }}"
                                            alt="{{ $shoe->shoe_name }}" class="card-img">
                                    </div>
                                    <div class="col-12 col-md-12 mt-lg-2">

                                        <div class="card-header mb-3">
                                            <b>{{ $shoe->shoe_name }}</b>
                                        </div>
                                        <span class="card-text mt-2">
                                            <b> $ {{ $shoe->price }} </b>
                                            <br>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
            @endforeach
            <div class="d-flex justify-content-center mt-5">
                {{ $shoes->links() }}
            </div>


        </div>
    </div>
@endsection
