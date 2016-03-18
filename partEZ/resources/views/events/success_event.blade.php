@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading">Success</div>

                    <div class="panel-body">
                        You have successfully created an event!

                        <br><br>
                        <a class="btn btn-lg btn-info" name="return_home" href='{{ url("/home") }}'>Return Home</a>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
