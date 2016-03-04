@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">Welcome!</div>

                <div class="panel-body">

                    Welcome to partEz!

                    Public Events:

                    @if (count($public_events))
                        @foreach($public_events as $invite)
                            @include('events.event_basic_invite', $invite)
                        @endforeach
                    @else
                        <p>There are no public events.</p>
                    @endif

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
