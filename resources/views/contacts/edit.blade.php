@extends('layout')

@section('content')
    <div class="card" style="max-width: 600px; margin: 0 auto; padding: 20px; box-shadow: 0 4px 8px rgba(0,0,0,0.1);">
        <h2>Edit Contact</h2>
        <div class="card-body">
            <form action="{{ route('contacts.update', $contact->id) }}" method="POST">
                @csrf
                @method('PUT') <!-- Ensure this method is PUT for updating -->

                <div class="form-group">
                    <label for="name">Name:</label>
                    <input type="text" id="name" name="name" class="form-control" value="{{ $contact->name }}">
                </div>

                <div class="form-group">
                    <label for="email">Email:</label>
                    <input type="email" id="email" name="email" class="form-control" value="{{ $contact->email }}">
                </div>

                <div class="form-group">
                    <label for="phone">Phone:</label>
                    <input type="text" id="phone" name="phone" class="form-control" value="{{ $contact->phone }}">
                </div>

                <div class="form-group">
                    <label for="address">Address:</label>
                    <input type="text" id="address" name="address" class="form-control" value="{{ $contact->address }}">
                </div>

                <button type="submit" class="btn btn-success">Update Contact</button>
            </form>
        </div>
        <a href="{{ url()->previous() }}" class="btn btn-back">Back</a>
    </div>
@endsection
