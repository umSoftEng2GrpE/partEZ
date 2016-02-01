@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading">Uhhh ohhh</div>

                    <div class="panel-body">
                        There has been an error while creating your event please try again later.

                        <br><br>
                        <button type="button" onclick="window.location='{{ url("/home") }}'">Return Home</button>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
