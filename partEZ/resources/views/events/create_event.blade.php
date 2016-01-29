@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">

                <div class="well">
                    {{ Form::open(array('action' => 'PostEventController@index()')) }}
                    <fieldset>

                        <legend>Create an event</legend>

                        <!-- Where -->
                        <div class="form-group">
                            {!! Form::label('where', 'Where:', ['class' => 'col-lg-2 control-label']) !!}
                            <div class="col-lg-10">
                                {!! Form::text('Location', $value = null, ['required'], ['class' => 'form-control', 'placeholder' => 'email']) !!}
                            </div>
                        </div>

                        <!-- Date -->
                        <div class="form-group">
                            {!! Form::label('date', 'When:', ['class' => 'col-lg-2 control-label']) !!}
                            <div class="col-lg-10">
                                {!! Form::input('date', 'startDate') !!}
                            </div>
                        </div>

                        <!-- Time -->
                        <div class="form-group">
                            {!! Form::label('date', 'Time:', ['class' => 'col-lg-2 control-label']) !!}
                            <div class="col-lg-10">
                                {!! Form::input('time', 'startDate') !!}
                                To:
                                {!! Form::input('time', 'endDate') !!}
                            </div>
                        </div>

                        <!-- Details -->
                        <div class="form-group">
                            {!! Form::label('details', 'Details', ['class' => 'col-lg-2 control-label']) !!}
                            <div class="col-lg-10">
                                {!! Form::textarea('textarea', $value = null, ['class' => 'form-control', 'rows' => 3]) !!}
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
