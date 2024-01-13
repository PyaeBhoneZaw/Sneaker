@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>Model Dashboard</h2>

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
        @if ($models->isEmpty())
            <h3 class="text-center mt-4">There is no Model.</h3>
        @else
            <table class="table table-bordered mt-4">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Model</th>
                        <th class=" text-end">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($models as $model)
                        <tr>
                            <td>{{ $model->id }}</td>
                            <td>{{ $model->model_name }}</td>
                            <td class="text-end">
                                <a href="{{ url("/shoes/model/delete/$model->id") }}" class="btn btn-outline-danger "
                                    data-bs-toggle="modal"
                                    data-bs-target="#confirmDeleteModal{{ $model->id }}">Delete</a>
                            </td>
                        </tr>
                        {{-- Delete Confirmation Modal --}}
                        <div class="modal fade" id="confirmDeleteModal{{ $model->id }}" tabindex="-1"
                            aria-labelledby="confirmDeleteModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content p-3">
                                    <div class="modal-header">
                                        <h3 class="modal-title mx-auto" id="confirmDeleteModalLabel">Confirm Delete</h3>
                                    </div>
                                    <div class="modal-body">
                                        <h5>Are you sure you want to delete this model?</h5>
                                    </div>
                                    <div class="modal-footer text-center">
                                        <button type="button" class="btn btn-outline-dark"
                                            data-bs-dismiss="modal">Cancel</button>
                                        <a href="{{ url("/shoes/model/delete/$model->id") }}"
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
