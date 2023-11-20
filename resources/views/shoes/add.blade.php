@extends('layouts.app')

@section('content')
    <div class="container" style="max-width: 600px">

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" class="m-4" id="shoeForm">
            @csrf
            <h1>Add Shoes</h1>

            <div class="mb-3">
                <input type="text" name="shoe_name" class="form-control" placeholder="Enter Shoe Name">
            </div>

            {{-- Brands --}}
            <div class="mb-3">
                <label for="brand">Select Brand:</label>
                <select name="brand" id="brand" class="form-select">
                    @foreach ($brands as $brand)
                        <option value="{{ $brand->id }}" data-models="{{ json_encode($brand->shoeModel) }}">
                            {{ $brand->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            {{-- Models --}}
            <div class="mb-3">
                <label for="model">Select Model:</label>
                <select name="model" id="model" class="form-select">
                    <!-- Models will be dynamically populated here -->
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

        <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
        <script>
            $(document).ready(function() {
                $('#brand').change(function() {
                    var selectedBrand = $(this).find(':selected');
                    var models = selectedBrand.data('models');

                    $('#model').empty();

                    if (Array.isArray(models)) {
                        $.each(models, function(index, model) {
                            $('#model').append('<option value="' + model.id + '">' + model.name +
                                '</option>');
                        });
                    } else {
                        console.error('Invalid models data:', models);
                    }
                });
            });
        </script>
    </div>
@endsection
