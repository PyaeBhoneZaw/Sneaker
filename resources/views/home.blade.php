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
            <div id="carouselExampleIndicators" class="carousel slide carousel-fade" data-bs-ride="carousel"
                data-bs-interval="2000" style="height: 500px">
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
                <div class="col-12 col-md-6 col-xl-3 p-3">
                    <a class="btn" href="{{ url("/shoes/detail/$shoe->id") }}">
                        <div class="card p-3">
                            <div class="card-body">
                                <div class="row flex-wrap">
                                    <div class="col-6 col-md-12">
                                        <img src="{{ asset('storage/images/shoes/' . basename($shoe->shoe_image)) }}" <div
                                            class="col-6 col-md-12 mt-lg-2">
                                        <div class="card-title"><b>Name: </b>{{ $shoe->shoe_name }}</div>
                                        <span class="card-text">

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
        </div>
    </div>
    <!-- Modal -->
    <div class="modal fade" id="checkoutSuccessModal" tabindex="-1" role="dialog"
        aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Checkout Success</h5>
                </div>
                <div class="modal-body text-center">
                    Your order has been successfully processed.
                    <br>
                    Thank you for your purchase!
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
            @if (session('checkoutSuccess'))
                $('#checkoutSuccessModal').modal('show');
            @endif
        });
    </script>
@endsection
