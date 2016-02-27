<div class="well">
    <legend>Edit An Event</legend>
    <fieldset>
        <div class="form-group">
            <table>
                <tr>
                    <td>{!! Form::label('name', 'Name:', ['class' => 'col-lg-2 control-label']) !!}</td>
                    <td>{!! Form::text('name', $event->name, ['required'], ['class' => 'form-control']) !!}</td>
                </tr>
                <tr>
                    <td>{!! Form::label('location', 'Location:', ['class' => 'col-lg-2 control-label']) !!}</td>
                    <td>{!! Form::text('location', $event->location, ['required'], ['class' => 'form-control']) !!}</td>
                </tr>
                <tr>
                    <td>{!! Form::label('date', 'When:', ['class' => 'col-lg-2 control-label']) !!}</td>
                    <td>{{ Form::text('date', $event->date, array('id' => 'datepicker') ) }}</td>
                </tr>

                <tr>
                    <td>{!! Form::label('time', 'Time:', ['class' => 'col-lg-2 control-label']) !!}</td>
                    <td>{{ Form::text('stime', $event->stime, array('id' => 'timepicker') ) }}
                        <b>To</b>
                        {{ Form::text('etime', $event->etime, array('id' => 'timepicker1') ) }}</td>
                <tr>
                <tr>
                    <td>{!! Form::label('publicText', 'Public:', ['class' => 'col-lg-2 control-label']) !!}</td>
                    <td>{!! Form::checkbox('public') !!}</td>
                </tr>
                <tr>
                    <td>{!! Form::label('description', 'Description', ['class' => 'col-lg-2 control-label']) !!}</td>
                    <td>
                        {!! Form::textarea('description', $event->description, ['class' => 'form-control']) !!}
                        <span class="help-block">Anymore details you may want to add for the party.</span>
                    </td>
                </tr>
            </table>
        </div>
    </fieldset>
</div>