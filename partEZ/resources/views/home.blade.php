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

                    <div id="user-event-header" class="panel panel-default event-header">
                        <div class="panel-heading header-content">
                            My Events <i class="header-icon fa fa-chevron-down"></i>
                        </div>

                        <div id="user-events" class="panel-body">
                            @if (count($events))            
                                @foreach($events as $event)
                                    @include('events.event_basic', $event)
                                @endforeach
                            @else
                                <p>You have no events.</p>
                            @endif
                        </div>
                    </div>
                    

                    <div id="invited-event-header" class="panel panel-default event-header">
                        <div class="panel-heading header-content">
                            Invited Events <i class="header-icon fa fa-chevron-down"></i>
                        </div>

                        <div id="invited-events" class="panel-body">
                            @if (count($invites))
                                
                                @foreach($invites as $invite)
                                    @include('events.event_basic_invite', $invite)
                                @endforeach
                            @else
                                <p>You have no invites.</p>
                            @endif
                        </div>
                    </div>
                    

                    <div id="public-event-header" class="panel panel-default event-header">
                        <div class="panel-heading header-content">
                            Public Events <i class="header-icon fa fa-chevron-down"></i>
                        </div>

                        <div id="public-events" class="panel-body">        
                            <p>No public events.</p>
                        </div>
                    </div>    

                </div>
            </div>
        </div>
    </div>
</div>

@endsection
