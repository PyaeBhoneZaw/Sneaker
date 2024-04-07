@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <h2 class="text-center">Shoes Dashboard</h2>

        @if (session('info'))
            <div class="alert alert-info text-center" id="info">
                {{ session('info') }}
            </div>
            <script>
                setTimeout(function() {
                    document.getElementById('info').style.display = 'none';
                }, 3000);
            </script>
        @endif
        @if ($errors->any())
            <div class="alert alert-danger text-center" id="info">
                @foreach ($errors->all() as $error)
                    {{ $error }}
                @endforeach
            </div>
            <script>
                setTimeout(function() {
                    document.getElementById('info').style.display = 'none';
                }, 3000);
            </script>
        @endif
        @if ($shoes->isEmpty())
            <h3 class="text-center mt-4">There is no Shoe.</h3>
        @else
            <table class="table table-responsive-sm table-bordered mt-4">
                <thead>
                    <tr class="text-center">
                        <th>ID</th>
                        <th>Name</th>
                        <th>Brand</th>
                        <th>Model</th>
                        <th>Price</th>
                        <th>Stock Quantity</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($shoes as $shoe)
                        <tr class="text-center">
                            <td>{{ $shoe->id }}</td>
                            <td>{{ $shoe->shoe_name }}</td>
                            <td>{{ $shoe->shoeModel->brand->brand_name }}</td>
                            <td>{{ $shoe->shoeModel->model_name }}</td>
                            <td>${{ $shoe->price }}</td>
                            <td>{{ $shoe->stock_quantity }}</td>
                            <td>
                                <a href="{{ url("/shoes/detail/$shoe->id") }}" class="btn btn-outline-dark">View</a>
                                <button type="button" class="btn btn-outline-dark mb-0 w-25" data-bs-toggle="modal"
                                    data-bs-target="#editModal{{ $shoe->id }}">
                                    Edit
                                </button>
                                <a href="{{ url("/shoes/delete/$shoe->id") }}" class="btn btn-outline-danger"
                                    data-bs-toggle="modal"
                                    data-bs-target="#confirmDeleteModal{{ $shoe->id }}">Delete</a>
                            </td>
                        </tr>

                        {{-- Edit Modal --}}
                        <div class="modal fade" id="editModal{{ $shoe->id }}" tabindex="-1"
                            aria-labelledby="editModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content p-3">
                                    <div class="modal-header">
                                        <h3 class="modal-title mx-auto" id="editModalLabel">Edit Shoe</h3>

                                    </div>
                                    <div class="modal-body">
                                        <!-- Your update form goes here -->
                                        <form action="{{ route('shoes.update', ['id' => $shoe->id]) }}" method="POST">
                                            @csrf
                                            @method('PUT')

                                            <div class="mb-3">
                                                <label for="shoe_name" class="form-label">Shoe Name</label>
                                                <input type="text" class="form-control" id="shoe_name" name="shoe_name"
                                                    value="{{ $shoe->shoe_name }}">
                                            </div>

                                            <div class="mb-3">
                                                <label for="price" class="form-label">Price</label>
                                                <div class="input-group">
                                                    <span class="input-group-text">$</span>
                                                    <input type="number" class="form-control" id="price" name="price"
                                                        value="{{ $shoe->price }}">
                                                </div>
                                            </div>

                                            <div class="d-flex justify-content-center">
                                                <button type="submit" class="btn btn-outline-dark">Update</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        {{-- Delete Confirmation Modal --}}
                        <div class="modal fade" id="confirmDeleteModal{{ $shoe->id }}" tabindex="-1"
                            aria-labelledby="confirmDeleteModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content p-3">
                                    <div class="modal-header">
                                        <h3 class="modal-title mx-auto" id="confirmDeleteModalLabel">Confirm Delete</h3>
                                    </div>
                                    <div class="modal-body">
                                        <h5>Are you sure you want to delete this shoe?</h5>
                                    </div>
                                    <div class="modal-footer text-center">
                                        <button type="button" class="btn btn-outline-dark"
                                            data-bs-dismiss="modal">Cancel</button>
                                        <a href="{{ url("/shoes/delete/$shoe->id") }}"
                                            class="btn btn-outline-danger">Delete</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        {{-- Model End --}}
                    @endforeach
                </tbody>
            </table>
        @endif
    </div>
@endsection
