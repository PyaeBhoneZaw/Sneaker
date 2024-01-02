@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>Model Dashboard</h2>

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
                        <td>{{ $model->name }}</td>
                        <td class="text-end">
                            <a href="{{ url("/shoes/model/delete/$model->id") }}" class="btn btn-outline-danger ">Delete</a>
                        </td>
                    </tr>

                    {{-- Edit Modal --}}
                    {{-- <div class="modal fade" id="editModal{{ $brand->id }}" tabindex="-1"
                        aria-labelledby="editModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content p-3">
                                <div class="modal-header">
                                    <h3 class="modal-title mx-auto" id="editModalLabel">Edit Shoe</h3>

                                </div>

                            </div>
                        </div>
                    </div> --}}
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
