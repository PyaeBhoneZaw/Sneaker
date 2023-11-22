@extends('layouts.app')

@section('content')
    <div class="container" style="max-width: 600px">

        @if (session('info'))
            <div class="alert alert-info">
                {{ session('info') }}
            </div>
            <script>
                setTimeout(function() {
                    document.getElementById('info').style.display = 'none';
                }, 3000);
            </script>
        @endif

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
            <h1 class="mb-4">Add Model</h1>

            <div class="mb-3">
                <select name="brand" id="brand" class="form-select">
                    <option value="" selected disabled>Select a Brand</option>
                    @foreach ($brands as $brand)
                        <option value="{{ $brand['id'] }}">
                            {{ $brand->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <input type="text" name="model_name" class="form-control" placeholder="Enter Model Name">
            </div>

            <div class="text-lg-end text-md-end text-sm-center">
                <input type="submit" value="Add Model" class="btn btn-outline-dark">
            </div>
        </form>
    </div>
@endsection
