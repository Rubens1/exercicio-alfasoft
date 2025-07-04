@extends('layouts.app')

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h2 class="mb-0">{{ isset($contact) ? 'Edit Contact' : 'Add New Contact' }}</h2>
                </div>
                <div class="card-body">
                    <form action="{{ isset($contact) ? route('contacts.update', $contact) : route('contacts.store') }}" method="POST">
                        @csrf
                        @if(isset($contact))
                            @method('PUT')
                        @endif

                        <div class="mb-3">
                            <label for="name" class="form-label">Name</label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror" 
                                   id="name" name="name" value="{{ old('name', $contact->name ?? '') }}" required>
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="contact" class="form-label">Contact (9 digits)</label>
                            <input type="text" class="form-control @error('contact') is-invalid @enderror" 
                                   id="contact" name="contact" value="{{ old('contact', $contact->contact ?? '') }}" 
                                   pattern="\d{9}" required>
                            @error('contact')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control @error('email') is-invalid @enderror" 
                                   id="email" name="email" value="{{ old('email', $contact->email ?? '') }}" required>
                            @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="d-flex justify-content-between">
                            <a href="{{ route('contacts.index') }}" class="btn btn-secondary">Cancel</a>
                            <button type="submit" class="btn btn-primary">
                                {{ isset($contact) ? 'Update Contact' : 'Create Contact' }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection 