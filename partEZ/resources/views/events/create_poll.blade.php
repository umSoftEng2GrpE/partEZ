@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">

                <div class="well">

                    {{  Form::open(['url' => 'create_poll']) }}
                    <fieldset>

                        <legend>Create A Poll</legend>

                        <!-- Date -->
                        <div class="form-group">
                            {!! Form::label('date1', 'Possible Date/Time:', ['class' => 'col-lg-2 control-label']) !!}

                            {!! Form::text('date1', null, ['class' => 'form-control'] ) !!}
                        <!-- Date -->
                            {!! Form::label('date2', 'Possible Date/Time:', ['class' => 'col-lg-2 control-label']) !!}
                            {!! Form::text('date2', null, ['class' => 'form-control'] ) !!}
                        <!-- Date -->
                            {!! Form::label('date3', 'Possible Date/Time:', ['class' => 'col-lg-2 control-label']) !!}
                            {!! Form::text('date3', null, ['class' => 'form-control'] ) !!}
                        <!-- Date -->
                            {!! Form::label('date4', 'Possible Date/Time:', ['class' => 'col-lg-2 control-label']) !!}
                            {!! Form::text('date4', null, ['class' => 'form-control'] ) !!}
                                <span class="help-block">Click next if you don't need help picking the date</span>
                        </div>

                        <!-- Next Button -->
                        <!-- Submits event info for event creation-->
                        <div class="form-group">
                            <div class="col-lg-10 col-lg-offset-2">
                                {!! Form::submit('Next', ['class' => 'btn btn-lg btn-info pull-right'] ) !!}
                            </div>
                        </div>

                    </fieldset>

                    {!! Form::close()  !!}

                </div>

            </div>
        </div>
    </div>
@endsection
