@extends('layouts.app')

@section('content')
<div class="container">
	<div class="row">
		<div class="col-md-10 col-md-offset-1">
			<div class="panel panel-default">
				<div class="panel-heading"><h3> {{ $event['name'] }} </h3></div>

				<ul class="nav nav-tabs" id="myTabs">
                    <li  ><a href="#tab1" data-toggle="tab">Event Description</a></li>
                    <li><a href="#tab2" data-toggle="tab">Event Poll</a></li>
                    <li><a href="#tab3" data-toggle="tab">Items List</a></li>
                    <li><a href="#tab4" data-toggle="tab">People</a></li>
                </ul>

                <div class="tab-content">
                	<div class="tab-pane" id="tab1">
                		<div class="event-details">
                		<h4>Details</h4>
							<ul>
								<li> {{ $event['public'] == 1 ? "This is a public event" : "This is a private event" }} </li>
								<li> Date:{{ $event['date'] }} </li>
								<li> Start Time: {{ $event['stime']}} End Time: {{ $event['etime']}} </li>
								<li> Location: {{ $event['location'] }} </li>
								<li> Description: {{ $event['description'] }} </li>
							</ul>

							@if ($event['uid'] != Auth::user()->uid)			
								<h4> RSVP: </h4>
								Your current status: {{ $rsvp_status }}
								<br>
								<a class='btn btn-lg btn-info' href="{!! route('accept_invite', ['eid'=>$event['eid'], 'uid'=>Auth::user()->uid]) !!}">Accept</a>
								<a class='btn btn-lg btn-info' href="{!! route('decline_invite', ['eid'=>$event['eid'], 'uid'=>Auth::user()->uid]) !!}">Decline</a>			
							@endif
						</div>
						
			
						
                	</div>
                	<div class="tab-pane" id="tab2">
                		<div class="event-details">
                            <h4>Dates</h4>
                            @if (count($all_options))
                                @if ($event['uid'] == Auth::user()->uid)
                                    @foreach($all_options as $options)
                                        @include('polls.poll_display', $options )
                                    @endforeach
                                @else
                                    @foreach($all_options as $options)
                                        @include('polls.poll_vote', $options )
                                    @endforeach
                                @endif
                            @else
                                <p>This event has no polls.</p>
                            @endif
						</div>
                	</div>
                	<div class="tab-pane" id="tab3">
                		<div class="event-details">

                		<h4>Items</h4>
							@if( count($items_list))
								@foreach($items_list as $item)
									@if( $item->uid == 0 )
										<p>{{ $item->description }} <a class='btn btn-xs btn-info' href="{!! route('assign_user', [$item->iid, 'eid'=>$event['eid']]) !!}">Testing</a></p>
									@else
										<!--TODO:Optimize this process-->
										@foreach($item_users as $tmp_user)
											@if($tmp_user->uid == $item->uid)
												<p>{{ $item->description }} {{$tmp_user->firstname}} {{$tmp_user->lastname}}</p>
												@break<!--Break because there may be duplicates in the list-->
											@endif
										@endforeach
									@endif
								@endforeach
							@else
								<p>This event has no items.</p>
							@endif
						</div>
                	</div>
                	<div class="tab-pane" id="tab4">
                		<div class="event-details">
                		<h4>Invited</h4>
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

				<h4>Messages</h4>

				@include('partials.chat_box',array('chat_message' => $chat_messages))
				<div class="form-group" >
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
				</div>
			</div>
		</div>
	</div>
@endsection
