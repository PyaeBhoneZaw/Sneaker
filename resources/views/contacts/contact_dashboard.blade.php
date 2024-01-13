@extends('layouts.app')

@section('content')
    <div class="container mt-3">
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
        <h2 class="text-center mb-5">Contact Messages</h2>
        @if ($contacts->isEmpty())
            <h3 class="text-center mt-4">There is no Contact.</h3>
        @else
            <div class="row row-cols-1 row-cols-md-4 g-4">

                @foreach ($contacts as $contact)
                    <div class="col">
                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-center mb-3">
                                    <h5 class="card-title">{{ $contact->name }}</h5>
                                    <a href="{{ url("/contacts/delete/$contact->id") }}"
                                        class="btn btn-outline-danger btn-sm" data-bs-toggle="modal"
                                        data-bs-target="#confirmDeleteModal{{ $contact->id }}">
                                        <i class="fa-solid fa-trash-can"></i>
                                    </a>
                                </div>
                                <hr>
                                <p class="card-text"><strong>Email:</strong> {{ $contact->email }}</p>
                                <p class="card-text"><strong>Message:</strong> {{ $contact->message }}</p>
                                <p class="card-text text-muted">{{ $contact->created_at->diffForHumans() }}</p>
                            </div>
                        </div>
                    </div>

                    {{-- Delete Confirmation Modal --}}
                    <div class="modal fade" id="confirmDeleteModal{{ $contact->id }}" tabindex="-1"
                        aria-labelledby="confirmDeleteModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content p-3">
                                <div class="modal-header">
                                    <h3 class="modal-title mx-auto" id="confirmDeleteModalLabel">Confirm Delete</h3>
                                </div>
                                <div class="modal-body">
                                    <h5>Are you sure you want to delete this contact?</h5>
                                </div>
                                <div class="modal-footer text-center">
                                    <button type="button" class="btn btn-outline-dark"
                                        data-bs-dismiss="modal">Cancel</button>
                                    <a href="{{ url("/contacts/delete/$contact->id") }}"
                                        class="btn btn-outline-danger">Delete</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    {{-- Model End --}}
                @endforeach
        @endif
    </div>
    </div>
@endsection
