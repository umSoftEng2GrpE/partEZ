@extends('layouts.app')

@section('content')
<div class="container">
	<div class="row">
		<div class="col-md-10 col-md-offset-1">
			<div class="panel panel-default">
				<div class="panel-heading">Dashboard</div>

				<div class="panel-body">
					<h3> Event Name: {{ $event['name'] }} </h3>
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

				</div>
			</div>
		</div>
	</div>
</div>
@endsection
