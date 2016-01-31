@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">

                <div class="well">

                    {{  Form::open(['url' => 'create_event']) }}
                    <fieldset>

                        <legend>Create an event</legend>

                        <!-- Name -->
                        <div class="form-group">
                            {!! Form::label('name', 'Name:', ['class' => 'col-lg-2 control-label']) !!}
                            <div class="col-lg-10">
                                {!! Form::text('name', null, ['required'], ['class' => 'form-control']) !!}
                            </div>
                        </div>

                        <!-- Where -->
                        <div class="form-group">
                            {!! Form::label('location', 'Location:', ['class' => 'col-lg-2 control-label']) !!}
                            <div class="col-lg-10">
                                {!! Form::text('location', null, ['required'], ['class' => 'form-control']) !!}
                            </div>
                        </div>

                        <!-- Date -->
                        <div class="form-group">
                            {!! Form::label('date', 'When:', ['class' => 'col-lg-2 control-label']) !!}
                            <div class="col-lg-10">
                                {!! Form::text('date', null, ['class' => 'form-control'] ) !!}
                            </div>
                        </div>

                        <!-- Time -->
                        <div class="form-group">
                            {!! Form::label('time', 'Time:', ['class' => 'col-lg-2 control-label']) !!}
                            <div class="col-lg-10">
                                {!! Form::text('stime', null ) !!}
                                To:
                                {!! Form::text('etime', null ) !!}
                            </div>
                        </div>

                        <!-- Details -->
                        <div class="form-group">
                            {!! Form::label('description', 'Description', ['class' => 'col-lg-2 control-label']) !!}
                            <div class="col-lg-10">
                                {!! Form::textarea('description', null, ['class' => 'form-control']) !!}
                                <span class="help-block">Anymore details you may want to add for the party.</span>
                            </div>
                        </div>

                        <!-- Submit Button -->
                        <div class="form-group">
                            <div class="col-lg-10 col-lg-offset-2">
                                {!! Form::submit('Submit', ['class' => 'btn btn-lg btn-info pull-right'] ) !!}
                            </div>
                        </div>

                    </fieldset>

                    {!! Form::close()  !!}

                </div>

            </div>
        </div>
    </div>
@endsection
