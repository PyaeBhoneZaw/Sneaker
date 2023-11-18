@extends('layouts.app')

@section('content')
    <div class="container-fluid">

        <div class="row">
            <div class="col-4"></div>
            <div class="col-4">
                <h2 class=" row-cols-lg-6 h6 text-center fs-5 fw-bold">SNEAKER HUB</h2>
                <br>
                <h1 class="text-center fw-bolder ">EXPERIENCE YOUR BEST. WEAR THEM NOW.</h1>
            </div>
        </div>
        <div class="col-md-12 mt-3">
            <div id="carouselExampleIndicators" class="carousel slide carousel-fade" style="height: 500px">
                <div class="carousel-inner">
                    <div class="carousel-item active">
                        <img src="{{ asset('images/AJ_Dior.jpg') }}" class="d-block w-100 " alt="Slide 1"
                            style="object-fit: cover; height: 500px;">
                    </div>
                    <div class="carousel-item">
                        <img src="{{ asset('images/AJ_UNC.jpg') }}" class="d-block w-100" alt="Slide 2"
                            style="object-fit: cover; height: 500px;">
                    </div>
                    <div class="carousel-item">
                        <img src="{{ asset('images/AJ_Spider.jpg') }}" class="d-block w-100" alt="Slide 2"
                            style="object-fit: cover; height: 500px;">
                    </div>
                    <div class="carousel-item">
                        <img src="{{ asset('images/AJ4/Air Jordan 4 Retro SE Craft - Olive.jpg') }}" class="d-block w-100"
                            alt="Slide 2" style="object-fit: cover; height: 500px;">
                    </div>
                    <!-- Add more slides as needed -->
                </div>
                <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators"
                    data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators"
                    data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Next</span>
                </button>
            </div>
        </div>
    </div>
    {{-- End of Carousel --}}

    <div class="container mt-5">
        <h1 class=" text-md-center">Grab Your Best</h1>

        <div class="row flex-wrap">
            @foreach ($shoes as $shoe)
                @for ($i = 0; $i < 6; $i++)
                @endfor
                <div class="col-12 col-md-6 col-xl-3 p-3">
                    <a class="btn" href="{{ url("/shoes/detail/$shoe->id") }}">
                        <div class="card p-3">
                            <div class="card-body">
                                <div class="row flex-wrap">
                                    <div class="col-6 col-md-12">
                                        <img src="https://img.freepik.com/premium-vector/shoe-logo-design_639744-220.jpg?w=2000"
                                            class="card-img">
                                    </div>
                                    <div class="col-6 col-md-12 mt-lg-2">
                                        <div class="card-title"><b>Name: </b>{{ $shoe->shoe_name }}</div>
                                        <span class="card-text">
                                            {{-- <b>Price: $</b> --}}
                                            <b> $ {{ $shoe->price }} </b>
                                            <br>
                                            <b>Date: </b>
                                            <small class="text-secondary">
                                                {{ $shoe->created_at->diffForHumans() }} </small>
                                            <br>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
            @endforeach
        </div>
    </div>
@endsection
