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
                    <a class="btn btn-lg btn-info" name="event_button" href='{{ url("/create_event") }}'>Create Event</a>
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
                            @if(!$local_events_only)
                                {{Form::open(array('route' => array('show_local_events', 'show_local_events' => true)))}}
                                    <button class="public-filter" href="{{URL::route('show_local_events', true)}}">Local Events Only</button>
                                    {{ Form::text('city', null, ['class' => 'form-control', 'id'=>'city']) }}
                                    {{ Form::submit('Change City!', ['city' => 'creEvent', 'class' => 'creEvent btn btn-lg btn-info pull-right'] ) }}
                                {{Form::close() }}
                            @else
                                {{Form::open(array('route' => array('home')))}}
                                    <button class="public-filter" href="{{ URL::route('home') }}">All Public Events</button>
                                {{Form::close() }}
                            @endif

                            @if (count($public_events))
                                @foreach($public_events as $invite)
                                    @if($local_events_only && $event['city']==$city || !$local_events_only)
                                        @include('events.event_basic_invite', $invite)
                                    @endif

                                @endforeach
                            @else
                                <p>There are no public events.</p>
                            @endif

                            <script>
                                document.getElementById("city").defaultValue = geoplugin_city();
                            </script>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
