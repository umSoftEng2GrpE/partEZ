@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading">Sold Out</div>

                    <div class="panel-body">
                        Sorry, this event is sold out.

                        <br><br>
                        <a class="btn btn-lg btn-info" name="return_home" href='{{ url("/home") }}'>Return Home</a>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection