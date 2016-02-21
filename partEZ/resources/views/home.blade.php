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

                    <div id="user-event-header">
                        <h2>
                            My Events
                        </h2>
                    </div>
                    <div id="user-events">
                        @if (count($events))
                            
                            @foreach($events as $event)
                                @include('events.event_basic', $event)
                            @endforeach
                        @else
                            <p>You have no events.</p>
                        @endif
                    </div>

                    <div id="invited-event-header">
                        <h2>
                            Invited Events
                        </h2>
                    </div>
                    <div id="invited-events">
                        @if (count($invites))
                            
                            @foreach($invites as $invite)
                                @include('events.event_basic_invite', $invite)
                            @endforeach
                        @else
                            <p>You have no invites.</p>
                        @endif
                    </div>

                    <div id="Public Events">
                        <h2>
                            Public Events
                        </h2>
                    </div>
                    <div>
                        <p>No public events.</p>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
