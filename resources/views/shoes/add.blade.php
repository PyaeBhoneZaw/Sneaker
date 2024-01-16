@extends('layouts.app')

@section('content')
    <div class="container" style="max-width: 600px">

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
        @if ($errors->any())
            <div class="alert alert-danger" id="info">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            <script>
                setTimeout(function() {
                    document.getElementById('info').style.display = 'none';
                }, 3000);
            </script>
        @endif

        <form method="POST" class="m-3 card p-4" id="shoeForm" enctype="multipart/form-data">
            @csrf
            <h1 class="mb-4">Add Shoes</h1>

            <div class="mb-3">
                <input type="text" name="shoe_name" class="form-control" placeholder="Enter Shoe Name">
            </div>

            {{-- Brands --}}
            <div class="mb-3">
                <select name="brand" id="brand" class="form-select">
                    <option value="" selected disabled>Select a Brand</option>
                    @foreach ($brands as $brand)
                        <option value="{{ $brand->id }}" data-models="{{ json_encode($brand->shoeModels) }}">
                            {{ $brand->brand_name }}
                        </option>
                    @endforeach
                </select>
            </div>

            {{-- Models --}}
            <div class="mb-3" id="modelsInput" style="display: none;">
                <label for="model" class=" text-muted mx-2">Choose Model</label>
                <select name="model" id="model" class="form-select">
                    <!-- Models will be dynamically populated here -->
                </select>
            </div>

            <div class="input-group mb-3">
                <input type="number" name="quantity" class="form-control" placeholder="Quantity" aria-label="quantity"
                    aria-describedby="basic-addon1">
            </div>

            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text">$</span>
                </div>
                <input type="number" name="price" class="form-control" placeholder="Enter price" aria-label="Price"
                    aria-describedby="basic-addon1">
            </div>

            <input type="file" name="shoe_image" class="form-control mb-3">

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
                            $('#model').append('<option value="' + model.id + '">' + model.model_name +
                                '</option>');
                        });

                        // Show the Models input when a brand is selected
                        $('#modelsInput').slideDown();
                    } else {
                        console.error('Invalid models data:', models);

                        // Hide the Models input if no models are available
                        $('#modelsInput').slideUp();
                    }
                });
            });
        </script>
    </div>
@endsection
