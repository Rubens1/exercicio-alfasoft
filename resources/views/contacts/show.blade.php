@extends('layouts.app')

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h2 class="mb-0">Contact Details</h2>
                </div>
                <div class="card-body">
                    <div class="mb-3">
                        <h5>Name</h5>
                        <p>{{ $contact->name }}</p>
                    </div>

                    <div class="mb-3">
                        <h5>Contact</h5>
                        <p>{{ $contact->contact }}</p>
                    </div>

                    <div class="mb-3">
                        <h5>Email</h5>
                        <p>{{ $contact->email }}</p>
                    </div>

                    <div class="d-flex justify-content-between">
                        <a href="{{ route('contacts.index') }}" class="btn btn-secondary">Back to List</a>
                        <div>
                            <a href="{{ route('contacts.edit', $contact) }}" class="btn btn-warning">Edit</a>
                            <form action="{{ route('contacts.destroy', $contact) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure?')">Delete</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection 