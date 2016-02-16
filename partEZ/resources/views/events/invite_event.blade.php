@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">


                <div class="panel panel-default">
                    <div class="panel-heading">Invite Guests</div>

                    <div class="panel-body">
                        {{  Form::open(['url' => 'invite_event']) }}
                        {{ Form::hidden('eid', $eventID) }}
                        <fieldset>

                            <!-- Email Invitees -->
                            <div class="form-group">
                                {!! Form::label('emails', 'Emails:', ['class' => 'col-lg-2 control-label']) !!}
                                <div class="col-lg-10">
                                    {!! Form::text('emails', null, ['required'], ['class' => 'form-control']) !!}
                                </div>
                            </div>

                            <!-- Submit Button -->
                            <div class="form-group">
                                <div class="col-lg-10 col-lg-offset-2">
                                    {!! Form::submit('Submit', ['class' => 'btn btn-lg btn-info pull-right'] ) !!}
                                    <span class="help-block">Separate each guest's email with a comma.</span>
                                </div>
                            </div>
                        </fieldset>
                        {!! Form::close()  !!}

                    </div>
                </div>


            </div>
        </div>
    </div>
@endsection
