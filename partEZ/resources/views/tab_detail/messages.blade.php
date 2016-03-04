<div class="col-lg-10">

    {{  Form::open(['url' => 'details_chat']) }}
    <div class="col-lg-10" style="display:inline-block;">
        {!! Form::text('message', null, ['class' => 'form-control'] ) !!}
    </div>
    <div style="display:inline-block;">
        {!! Form::submit('Submit', ['class' => 'btn btn-lg btn-info pull-right'] ) !!}
    </div>
    {{ Form::hidden('eid', $event->eid) }}
    {!! Form::close() !!}
</div>