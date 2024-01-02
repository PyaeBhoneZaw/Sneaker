<!-- resources/views/shoes/search.blade.php -->
@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Search Results for "{{ $query }}"</h1>

        <div class="row flex-wrap">
            @forelse ($shoes as $shoe)
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
            @empty
                <p>No results found.</p>
            @endforelse
        </div>
    </div>
@endsection
