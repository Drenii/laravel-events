@extends('layouts.app')
@section('content')
    <div class="row">
    @foreach($events as $event)
        <div class="col-md-4">
            <h4>{{ $event->title }}</h4>
            @if ($event->image)
            <div>
                <img src="/{{ $event->image }}" class="img-fluid">
            </div>
            @endif
            <div>{{ $event->description }}</div>
            <div>{{ $event->date }}</div>
        </div>
    @endforeach
    </div>
    @endsection
