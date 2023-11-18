@extends('layouts.app')
@section('content')
    <div class="container">
        <h1>Shoes List</h1>

        <div class="row flex-wrap">
            @foreach ($shoes as $shoe)
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
