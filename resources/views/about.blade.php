@extends('layouts.app')
@section('content')
    <div class="container mt-4 bg">
        <div class="row">
            <div class="col-md-12">

                <div class="row mb-5">
                    <div class="col-lg-6 col-md-12 mb-4 mb-lg-0">
                        <img src="{{ asset('images/about-1.jpg') }}" class="w-100 shadow-1-strong rounded mb-4"
                            alt="TravisScott" />
                    </div>
                    <div class="col-lg-6">
                        <h1>About Sneaker Hub</h1>

                        <p class="">"Welcome to Sneaker Hub, where style meets comfort and passion for footwear takes
                            center
                            stage. At
                            Sneaker Hub, we are dedicated to providing an unparalleled sneaker shopping experience. Our
                            curated
                            collection showcases the latest trends, iconic classics, and limited editions from renowned
                            brands and
                            emerging designers. With a commitment to quality and style, we aim to be your go-to destination
                            for the
                            freshest kicks. Explore our diverse range, find the perfect pair that speaks to your
                            individuality, and
                            step into the world of Sneaker Hub – where every step is a statement."
                        </p>
                    </div>
                </div>


                <div class="row mb-5">
                    <div class="col-lg-6 col-md-12 mb-4 mb-lg-0">
                        <h2>Our Collection</h2>
                        <p>Explore our extensive collection of sneakers from renowned brands and emerging designers.
                            From
                            classic
                            designs to limited editions, we curate our selection to bring you the most sought-after and
                            on-trend
                            footwear.</p>

                        <h2>Visit Us</h2>
                        <p>Come and visit our store to experience the Sneaker Hub difference in person. Our friendly
                            staff is
                            here
                            to assist you in finding the perfect pair that suits your style and fits your needs.</p>
                        <h2>Contact Us</h2>
                        <p>Have questions or need assistance? Feel free to contact us through our <a
                                href="{{ route('contacts.create') }}" class="text-decoration-none">contact page</a>. We
                            value your
                            feedback and are
                            always here to
                            help!
                        </p>
                    </div>
                    <div class="col-lg-6 col-md-12 mb-4 mb-lg-0">
                        <img src="{{ asset('images/about-2.jpg') }}" class="w-100 shadow-1-strong rounded mb-4"
                            alt="TravisScott" />
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
