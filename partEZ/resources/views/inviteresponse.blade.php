@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">Success!</div>

                <div class="panel-body">

                    @if($is_full)
                        Sorry, this event is full.
                    @else
                        You've successfully responded to this invitation!
                    @endif

                </div>
            </div>
        </div>
    </div>
</div>
@endsection