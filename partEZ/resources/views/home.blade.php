@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">Dashboard</div>

                <div class="panel-body">
                    You are logged in!
                    <br><br>
                    <button type="button" name="event_button" onclick="window.location='{{ url("/create_event") }}'">Create Event</button>
                    <br><br>

                    @if (count($events))
                        @foreach($events as $event)
                            @include('events.event_basic', $event)
                        @endforeach
                    @else
                        <p>You have no events.</p>
                    @endif

                    @if (count($invites))
                        @foreach($invites as $invite)
                            @include('events.event_basic_invite', $invite)
                        @endforeach
                    @else
                        <p>You have no invites.</p>
                    @endif


                </div>
            </div>
        </div>
    </div>
</div>
@endsection
