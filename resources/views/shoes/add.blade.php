@extends('layouts.app')
@section('content')
    <div class="container" style="max-width: 600px">

        @if ($errors->any())
            <div class="alert alert-warning">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif


        <form method="POST" class="m-4">
            @csrf
            <h1>Add Shoes</h1>
            <div class="mb-3">
                <input type="text" name="shoe_name" class="form-control" placeholder="Enter Shoe Name">
            </div>

            <div class="mb-3">
                <select name="model" class="form-select">
                    @foreach ($brands as $brand)
                        <option value="{{ $brand['id'] }}">
                            {{ $brand['name'] }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text">$</span>
                </div>
                <input type="number" name="price" class="form-control" placeholder="Enter price" aria-label="Price"
                    aria-describedby="basic-addon1">
            </div>

            <div class="text-lg-end text-md-end text-sm-center">
                <input type="submit" value="Add Shoe" class="btn btn-outline-dark">
            </div>

        </form>
    </div>
@endsection
