@extends('layouts.app')

@section('content')
    <div id="rootwizard" class="container">

        <script>
            $(document).ready(function() {
                $('#rootwizard').bootstrapWizard();
            });
        </script>
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <ul class="nav nav-tabs" id="myTabs">
                    <li><a href="#tab1" data-toggle="tab">Event Details</a></li>
                    <li><a href="#tab2" data-toggle="tab">Poll Options</a></li>
                    <li><a href="#tab3" data-toggle="tab">Item List</a></li>
                    <li><a href="#tab4" data-toggle="tab">Invitations</a></li>
                </ul>
                {{  Form::open(array('route' => array('event_details_edit', $event->eid))) }}
                <div class="tab-content">
                    <div class="tab-pane" id="tab1">
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
                    </div>

                    <div class="tab-pane" id="tab2">
                        <div class="well">

                            <script>
                                var datePollOps = new Array();
                                var currPollOps = document.getElementsByClassName('poll-op');
                                var newPollOps = [];

                                function addCurrPollOps()
                                {
                                	for(var i = 0; i < currPollOps.length; i++)
                                		datePollOps.push(currPollOps[i].innerHTML);
                                }

                                function displayDatePoll() 
                                {
                                    $("ul#datepolllist").empty();
                                    for (var i in datePollOps) 
                                    {
                                        var li = "<li>";
                                        $("ul#datepolllist").append( (li.concat( datePollOps[i] )).concat("</li>") )
                                    }
                                    document.getElementById('returndatepolls').value = newPollOps;
                                }

                                function addDatePoll(selected)
                                {
                                	if(currItems.length > 0 && datePollOps.length == 0) 
                                		addCurrPollOps();

                                    datePollOps.push(selected);
                                    newPollOps.push(selected);
                                    displayDatePoll(selected);
                                }

                            </script>
                            <fieldset>
                                <legend>Date Proposals</legend>
                                <p>Select Multiple Dates</p>
                                <div class="form-group">

                                    <!-- Date -->
                                    {!! Form::label('addDatePoll', 'Possible Dates', ['class' => 'col-lg-5 control-label']) !!}
                                    <div id="dateCalendar"></div>
                                    <!-- Date -->

                                    <input type="hidden" name="returndatepolls" id="returndatepolls" value="">

                                    <br>

                                    <ul class="EventDatePollList" id="datepolllist" style="list-style: none;">
                            			@foreach($all_options as $options)
											<li class="poll-op">@include('polls.poll_display', $options )</li>
										@endforeach
                                    </ul>
                                </div>
                            </fieldset>

                        </div>
                    </div>                    

                    <div class="tab-pane" id="tab3">
                        <div class="well">
                            <script>
                                var arr = new Array();
                                var currItems = document.getElementsByClassName('item');
                                var newItems = []; 

                                function addItem()
                                {
                                	if(currItems.length > 0 && arr.length == 0) 
                                		addCurrItems();

                                    arr.push(document.getElementById('addItemText').value);
                                    newItems.push(document.getElementById('addItemText').value)
                                    displayList();
                                }

                                function addCurrItems()
                                {
                                	for(var i = 0; i < currItems.length; i++)
                                		arr.push(currItems[i].innerHTML);
                                }

                                function displayList() {

                                    $("ul#itemlist").empty();
                                    for (var i in arr) 
                                    {
                                        var li = "<li>";
                                        $("ul#itemlist").append( (li.concat( arr[i] )).concat("</li>") )
                                    }
                                    document.getElementById('returnlist').value = newItems;
                                }

                            </script>

                            <legend>Edit An Event Item List</legend>
                            <fieldset>
                            	<div class="col-lg-10">
                            		<table>
                            			<tr>
		                                    <td>
		                                    	{!! Form::label('addItem', 'Item:', ['class' => 'col-lg-2 control-label']) !!}</td>
		                                    	<input type="hidden" name="returnlist" id="returnlist" value="">
		                                    <td>{!! Form::text('addItemText', null, ['class' => 'form-control', 'id'=>'addItemText'] ) !!}</td>
		                                    <td>{!! Form::button('Add', ['class' => 'btn btn-lg btn-info pull-right','onclick'=>'addItem(this.form)', 'autofocus'] ) !!}</td>
	                                   	</tr>
                                   	</table>

                                   	<br>

                                    <ul class="EventItemList" id="itemlist">
										@foreach($items_list as $item)
											<li class="item"> {{ $item->description }} </li>
										@endforeach
                                    </ul>
                                </div>
                            </fieldset>

                        </div>
                    </div>
                    <div class="tab-pane well" id="tab4">
                        <script>
                            var inviteeArray = new Array();             
                            var email = "";
                            var currInvitees = document.getElementsByClassName('person'); 
                            var newInvitees = [];

                            function addInvitee()
                            {
                                email = document.getElementById('emails').value.toLowerCase().trim();

                                if(currInvitees.length > 0 && inviteeArray.length == 0)
                                	addCurrInvitees();

                                if(validEmail(email)) 
                                {
                                    document.getElementById('email-error').style.display = "none";
                                    document.getElementById('emails').value = "";
                                    inviteeArray.push(email);
                                    newInvitees.push(email);
                                    displayInviteeList();
                                } 
                                else 
                                    document.getElementById('email-error').style.display = "block";
                            }

							function addCurrInvitees() 
                            {
                            	for(var i = 0; i < currInvitees.length; i++)
                            		inviteeArray.push(currInvitees[i].innerHTML);
                            }

                            function validEmail(email)
                            {
                                var isValid = true;
                                var regex = /\S+@\S+\.\S+/;
                                var userEmail = <?php echo json_encode($user_email); ?>;
                                var errorMessage = "";

                                isValid = regex.test(email);

                                if(isValid) 
                                {
                                    if (inviteeArray.indexOf(email) >= 0) 
                                    {
                                        isValid = false;
                                        errorMessage = "Cannot add duplicate emails!";
                                    }
                                    else if (email == userEmail)
                                    {
                                        isValid = false;
                                        errorMessage = "Cannot add event creator!";                                       
                                    }
                                }
                                else
                                {
                                    errorMessage = "Invalid email syntax!";
                                }

                                document.getElementById('email-error').innerHTML = errorMessage;
                                return isValid;
                            }

                            function displayInviteeList() 
                            {
                                $("ul#invitee-list").empty();
                                for (var i in inviteeArray) 
                                {
                                    var li = "<li>";
                                    $("ul#invitee-list").append( (li.concat( inviteeArray[i] )).concat("</li>") )
                                }
                                document.getElementById('email-list').value = newInvitees;
                            }

                        </script>
                        <legend>Invite Guests</legend>
                        <fieldset>
                            <!-- Email Invitees -->
                            <div class="form-group">

                                <table>
                                    <tr>
                                        <td>{!! Form::label('emails', 'Emails:', ['class' => 'col-lg-2 control-label']) !!}</td>
                                        <td>
                                            {!! Form::text('emails', null, ['class' => 'form-control', 'id' => 'emails']) !!}
                                            <span id="email-error" style="color:red; display:none;"></span>
                                            <input type="hidden" name="email-list" id="email-list" value="">
                                        </td>
                                        <td>{!! Form::button('Add', ['class' => 'btn btn-lg btn-info pull-right','onclick'=>'addInvitee(this.form)', 'autofocus'] ) !!}</td>
                                    </tr>
                                    <tr>
                                        <td><span id="email-error" style="color:red; display:none;"></span></td>
                                    </tr>
                                </table>

                                <br>

                                <ul class="InviteeList" id="invitee-list">
									@foreach($invites as $person)
										<li class="person">{{print_r($person, true)}}</li>
									@endforeach
                                </ul>

                            </div>
                        </fieldset>
                    </div>

                </div>
                <div class="form-group">
                    <div class="col-lg-10 col-lg-offset-2">
                        {!! Form::submit('Save Event!', ['class' => 'btn btn-lg btn-info pull-right'] ) !!}
                    </div>
                </div>
                {!! Form::close() !!}

            </div>
        </div>
    </div>

@endsection
