@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">Dashboard</div>

                <div class="panel-body">
                    You are logged in!

                    @if (count($events))
                        @foreach($events as $event)
                            @include('events.event_basic', $event)
                        @endforeach
                    @else
                        <p>You have no events.</p>
                    @endif

                    <br><br>
                    <button type="button" name="event_button" onclick="window.location='{{ url("/create_event") }}'">Create Event</button>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
