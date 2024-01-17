@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-4"></div>
            <div class="col-4">
                {{-- <h2 class=" row-cols-lg-6  text-center fs-5 fw-bold">SNEAKER HUB</h2> --}}
                <h1 class="text-center fw-bold text-uppercase mt-0">Elevate Your Stride, Redefine Your Style.</h1>
            </div>
        </div>
        <!-- Gallery -->
        <div class="row">
            <div class="col-lg-4 col-md-12 mb-4 mb-lg-0">
                <img src="{{ asset('images/TS_slider1.jpg') }}" class="w-100 shadow-1-strong rounded mb-4" alt="TravisScott" />

                <img src="{{ asset('images/TS_slider2.jpg') }}" class="w-100 shadow-1-strong rounded mb-4"
                    alt="NewBalance" />
            </div>

            <div class="col-lg-8 mb-4 mb-lg-0">
                <img src="{{ asset('images/forum_slide.jpg') }}" class="w-100 shadow-1-strong rounded mb-4"
                    alt="Forumr" />
            </div>
        </div>
        <!-- Gallery -->

    </div>


    <div class="container-fluid mt-5">

        <div class="row flex-wrap">
            {{-- Nike Brand --}}
            <div class="h2 text-center text-capitalize "
                style="font-family:-apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, 'Open Sans', 'Helvetica Neue', sans-serif">
                <img src="{{ asset('images/nikelogo.png') }}"> NIKE DUNKS
            </div>
            @foreach ($nikeShoes as $nikeshoe)
                <div class="col-12 col-md-6 col-xl-3 p-3 mb-5">
                    <a class="btn p-0" href="{{ url("/shoes/detail/$nikeshoe->id") }}">
                        <div class="card p-3" style="height: 370px">
                            <div class="card-body">
                                <div class="row flex-wrap">
                                    <div class="col-6 col-md-12">
                                        <img src="{{ asset('storage/images/shoes/' . basename($nikeshoe->shoe_image)) }}"
                                            class="img-fluid mb-4" alt="Shoe Image">
                                    </div>
                                    <div class="col-6 col-md-12 mt-lg-2">
                                        <div class="card-title"><b>{{ $nikeshoe->shoe_name }} </b></div>
                                        <span class="card-text">
                                            <b> $ {{ $nikeshoe->price }} </b>
                                            <br>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
            @endforeach
            {{-- Carousel Start --}}
            <div class="col-md-12 mt-3">
                <div id="carouselExampleIndicators" class="carousel slide carousel-fade" data-bs-ride="carousel"
                    data-bs-interval="2000">
                    <div class="carousel-inner">
                        <div class="carousel-item active">
                            <img src="{{ asset('images/AJ_Dior.jpg') }}" class="d-block w-100 " alt="Slide 1"
                                style="object-fit: cover; height: 550px;">
                        </div>
                        <div class="carousel-item">
                            <img src="{{ asset('images/forrum_slide2.jpg') }}" class="d-block w-100" alt="Slide 2"
                                style="object-fit: cover; height: 550px;">
                        </div>
                        <div class="carousel-item">
                            <img src="{{ asset('images/AJlogo.jpg') }}" class="d-block w-100" alt="Slide 2"
                                style="object-fit: cover; height: 550px;">
                        </div>
                        <div class="carousel-item">
                            <img src="{{ asset('images/JordanSlider.jpg') }}" class="d-block w-100" alt="Slide 2"
                                style="object-fit: cover; height: 550px;">
                        </div>
                        <div class="carousel-item">
                            <img src="{{ asset('images/AJ4/Air Jordan 4 Retro SE Craft - Olive.jpg') }}"
                                class="d-block w-100" alt="Slide 2" style="object-fit: cover; height: 550px;">
                        </div>


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
            {{-- End of Carousel --}}
            {{-- Air Jordan Brand --}}
            <div class="h2 text-center text-black mt-5"
                style="font-family:-apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, 'Open Sans', 'Helvetica Neue', sans-serif">
                <img src="{{ asset('images/jordanlogo.png') }}"> AIR JORDAN 4
            </div>
            @foreach ($ajShoes as $ajshoes)
                <div class="col-12 col-md-6 col-xl-3 p-3">
                    <a class="btn p-0" href="{{ url("/shoes/detail/$ajshoes->id") }}">
                        <div class="card p-3">
                            <div class="card-body">
                                <div class="row flex-wrap">
                                    <div class="col-6 col-md-12">
                                        <img src="{{ asset('storage/images/shoes/' . basename($ajshoes->shoe_image)) }}"
                                            class="img-fluid mb-4" alt="Shoe Image">
                                    </div>
                                    <div class="col-6 col-md-12 mt-lg-2">
                                        <div class="card-title"><b>Name: </b>{{ $ajshoes->shoe_name }}</div>
                                        <span class="card-text">
                                            <b> $ {{ $ajshoes->price }} </b>
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
    <!-- Modal -->
    <div class="modal fade" id="infoModel" tabindex="-1" role="dialog" aria-labelledby="infoModelTitle"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title text-center" id="infoModelTitle">Sneaker Hub</h5>
                </div>
                <div class="modal-body text-center">
                    {{ session('success') }}
                    <div class="d-flex justify-content-center">
                        <img src="{{ asset('images/checkout_icon.png') }}" alt="checkoutlogo">
                    </div>
                </div>

            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>

    <script>
        $(document).ready(function() {
            // Check if the checkoutSuccess variable is set, then show the modal
            @if (session('success'))
                $('#infoModel').modal('show');
            @endif
        });
    </script>
@endsection
