@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading">Dashboard</div>

                    <div class="panel-body">
                        <h3> Event Name: {{ $event['name'] }} </h3>
                        <br>
                        <ul>
                            <li> Date:{{ $event['date'] }} </li>
                            <li> Start Time: {{ $event['stime']}} End Time: {{ $event['etime']}} </li>
                            <li> Location: {{ $event['location'] }} </li>
                            <li> Description: {{ $event['description'] }} </li>
                        </ul>

                        @if (count($polls))
                            @foreach($polls as $poll)
                                @include('polls.poll_display', $poll)
                            @endforeach
                        @else
                            <p>This event has no polls.</p>
                        @endif

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection