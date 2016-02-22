@extends('layouts.app')

@section('content')
<div class="container">
	<div class="row">
		<div class="col-md-10 col-md-offset-1">
			<div class="panel panel-default">
				<div class="panel-heading">Dashboard</div>

				<div class="panel-body">

                    {{  $is_public_message =
                        $event['public'] == 1 ? "This is a public event" : "This is a private event" }}

					<h3> Event Name: {{ $event['name'] }} </h3>
					<br>
					<ul>
						<li> {{ $is_public_message }} </li>
						<li> Date:{{ $event['date'] }} </li>
						<li> Start Time: {{ $event['stime']}} End Time: {{ $event['etime']}} </li>
						<li> Location: {{ $event['location'] }} </li>
						<li> Description: {{ $event['description'] }} </li>
					</ul>

					<h4>Polls</h4>
					@if (count($all_options))
                        @foreach($all_options as $options)
                        @include('polls.poll_display', $options )
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
					<div style="border : solid 2px #ffffff; background : #000000; color : #ffffff; padding : 4px; width : 100%; height : 500px; overflow : auto; " onload="/chat_log">
						@if (count($chat_messages))
							@foreach($chat_messages as $message)
							<p>{{print_r($message['msg'], true)}}</p>
							@endforeach
						@endif
					</div>
					<div class="form-group">
						<div class="col-xs-10">
						    {!! Form::text('message', null, ['class' => 'form-control'] ) !!}
						</div>
						<h4>Event Id {{print_r($event['eid'], true)}}</h4>
						<button type="button" name="submit_button" onclick="/chat_log">Submit</button>
					</div>


				</div>
			</div>
		</div>
	</div>
</div>
@endsection
