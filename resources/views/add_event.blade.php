@extends('layouts.app')
@section('content')

    <h1>Add an event</h1>
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <form method="post" action="{{ route('events.insert') }}" enctype="multipart/form-data">
        @csrf

        <label for="title">Title</label>
        <input type="text" class="form-control" name="title" id="title" value="{{ old('title') }}">
        <label for="description">Description</label>
        <textarea class="form-control" name="description" id="description" rows="10">{{ old('description') }}</textarea>
        <label for="date">Date/Time</label>
        <input type="datetime-local" name="date" id="date" class="form-control" value="{{ old('date') }}">
        <label for="image">Image</label>
        <input type="file" name="image" id="image" class="form-control">
        <input type="submit" value="Send" class="btn btn-primary">


    </form>
    @endsection
