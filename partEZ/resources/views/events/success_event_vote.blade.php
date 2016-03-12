@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading">Success</div>

                    <div class="panel-body">
                        Your vote has successfully been cast!

                        <br><br>
                        <button type="button" onclick="window.location='{{ url("/home") }}'">Return Home</button>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
