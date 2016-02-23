@extends('layouts.app')

@section('content')

<div class="container">
	<div class="row">
		<div class="col-md-10 col-md-offset-1">
			<div class="panel panel-default">
				<div class="panel-heading">Dashboard</div>

				<div class="panel-body">
					<h3> Invited Event Name: {{ $event['name'] }} </h3>
					<br>
					<ul>
						<li> Date:{{ $event['date'] }} </li>
						<li> Start Time: {{ $event['stime']}} End Time: {{ $event['etime']}} </li>
						<li> Location: {{ $event['location'] }} </li>
						<li> Description: {{ $event['description'] }} </li>
					</ul>

					<h4>Polls</h4>
					@if (count($all_options))
						@foreach($all_options as $options)
							@include('polls.poll_vote', $options )
						@endforeach
					@else
						<p>This event has no polls.</p>
					@endif

					<h4>Invited</h4>
					<div>
						@if (count($invites))
							<ul>
								@foreach($invites as $person)
									<li>{{print_r($person, true)}}</li>
								@endforeach
							</ul>
						@else
							<p>This event has no invitees.</p>
						@endif
					</div>

					<h4>Chat</h4>
						@include('partials.chat_box',array('chat_message' => $chat_messages))
					
					<div class="form-group">
						<div class="col-lg-10">
						    
					    {{  Form::open(['url' => 'invite_chat']) }}
					    <div class="col-lg-10" style="display:inline-block;">
            				{!! Form::text('message', null, ['class' => 'form-control'] ) !!}
            				</div>
            				<div style="display:inline-block;">
					    		{!! Form::submit('Submit', ['class' => 'btn btn-lg btn-info pull-right'] ) !!}
					    	</div>
					    	{{ Form::hidden('eid', $event->eid) }}
            			{!! Form::close() !!}
						</div>
						
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection
