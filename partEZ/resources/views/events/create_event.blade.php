@extends('layouts.app')

@section('content')
    <div id="rootwizard" class="container">

        <script>
            $(document).ready(function() {
                $('#rootwizard').bootstrapWizard();
                $('.form-control.hidden').hide();
            });
        </script>
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <ul class="nav nav-tabs" id="myTabs">
                    <li><a name="details" href="#tab1" data-toggle="tab">Event Details</a></li>
                    <li><a name="polls" href="#tab2" data-toggle="tab">Date Proposals</a></li>
                    <li><a name="items" href="#tab3" data-toggle="tab">Item List</a></li>
                    <li><a name="invites" href="#tab4" data-toggle="tab">Invitations</a></li>
                </ul>
                {{Form::open(['url' => 'create_event']) }}
                <div class="tab-content">
                    <div class="tab-pane" id="tab1">
                        <div class="well">         


                            <legend>Create An Event</legend>
                            <fieldset>
                                <div class="form-group">
                                    <table>
                                        <tr>
                                            <td>{!! Form::label('name', 'Name:', ['class' => 'col-lg-2 control-label']) !!}</td>
                                            <td>{!! Form::text('name', null, ['required'], ['class' => 'form-control']) !!}</td>
                                        </tr>
                                        <tr>
                                            <td>{!! Form::label('location', 'Location:', ['class' => 'col-lg-2 control-label']) !!}</td>
                                            <td>{!! Form::text('location', null, ['required'], ['class' => 'form-control', 'id' => 'location']) !!}</td>
                                        </tr>
                                        <tr>
                                            <td>{!! Form::label('city', 'City:', ['class' => 'col-lg-2 control-label']) !!}</td>
                                            <td>{!! Form::text('city', null, ['required'], ['class' => 'form-control', 'id' => 'city']) !!}</td>
                                        </tr>
                                        <tr>
                                            <td>{!! Form::label('date', 'When:', ['class' => 'col-lg-2 control-label']) !!}</td>
                                            <td>{{ Form::text('date', null, array('id' => 'datepicker') ) }}</td>
                                        </tr>
                                        <tr>
                                            <td>{!! Form::label('time', 'Time:', ['class' => 'col-lg-2 control-label']) !!}</td>
                                            <td>{{ Form::text('stime', null, array('id' => 'timepicker') ) }}
                                            <b>To</b>
                                            {{ Form::text('etime', null, array('id' => 'timepicker1') ) }}</td>
                                        <tr>
                                        <tr>
                                            <td>{!! Form::label('publicText', 'Public:', ['class' => 'col-lg-2 control-label']) !!}</td>
                                            <td>{!! Form::checkbox('public') !!}</td>
                                        </tr>
                                        <tr>
                                            <td>{!! Form::label('tickets', 'Require Tickets:', ['class' => 'col-lg-2 control-label']) !!}</td>
                                            <td>{!! Form::checkbox('hastickets') !!}</td>
                                        </tr>

                                        <tr class="ticketoptions">
                                            <td>{!! Form::label('ticketcountlabel', 'Ticket Count:', ['class' => 'col-lg-2 control-label']) !!}</td>
                                            <td>{{ Form::text('ticketcount', null, array('id' => 'ticketcount') ) }}</td>
                                        </tr>
                                        <tr class="ticketoptions">
                                            <td>{!! Form::label('ticketpricelabel', 'Ticket Price:', ['class' => 'col-lg-2 control-label']) !!}</td>
                                            <td>$ {{ Form::text('ticketprice', null, array('id' => 'ticketprice') ) }}</td>
                                        </tr>

                                        <tr>
                                            <td>{!! Form::label('description', 'Description', ['class' => 'col-lg-2 control-label']) !!}</td>
                                            <td>
                                                {!! Form::textarea('description', null, ['class' => 'form-control']) !!}
                                                <span class="help-block">Anymore details you may want to add for the party.</span>
                                            </td>
                                        </tr>
                                    </table>
                                </div>
                            </fieldset>
                            <script>
                                document.getElementById("city").defaultValue = geoplugin_city();
                            </script>
                        </div>
                    </div>
                    <div class="tab-pane" id="tab2">
                        <div class="well">

                            <script>
                                var datePollOps = new Array();

                                function displayDatePoll() {

                                    $("ul#datepolllist").empty();
                                    for (var i in datePollOps) {
                                        var li = "<li>";
                                        $("ul#datepolllist").append( (li.concat( datePollOps[i] )).concat("</li>") )
                                    }
                                    document.getElementById('returndatepolls').value = datePollOps;
                                }

                                function addDatePoll(selected)
                                {
                                    datePollOps.push(selected);
                                    displayDatePoll(selected);
                                }

                            </script>
                            <fieldset>
                                <legend>Date Proposals</legend>
                                <p>Choose multiple dates</p>
                                <div class="form-group">

                                    <!-- Date -->
                                    {!! Form::label('addDatePoll', 'Possible Dates', ['class' => 'col-lg-5 control-label']) !!}
                                    <div id="dateCalendar"></div>
                                    <!-- Date -->

                                    <input type="hidden" name="returndatepolls" id="returndatepolls" value="">
 
                                    <h4>Selected Dates:</h4>
                                    <ul class="EventDatePollList" id="datepolllist" style="list-style: none;">

                                    </ul>
                                </div>
                            </fieldset>

                        </div>
                    </div>
                    <div class="tab-pane" id="tab3">
                        <div class="well">
                            <script>
                                var arr = new Array();

                                function displayList() {

                                    $("ul#itemlist").empty();
                                    for (var i in arr) {
                                        var li = "<li>";
                                        $("ul#itemlist").append( (li.concat( arr[i] )).concat("</li>") )
                                    }
                                    document.getElementById('returnlist').value = arr;
                                }

                                function addItem()
                                {
                                    arr.push(document.getElementById('addItemText').value);
                                    displayList();
                                }

                            </script>
                            <legend>Create An Event Item List</legend>
                            <fieldset>
                                <div class="panel-body">
                                    <div class="form-group">
                                        <table>
                                            <tr>
                                                <td>{!! Form::label('addItem', 'Item:', ['class' => 'col-lg-2 control-label']) !!}</td>
                                                <td>
                                                    {!! Form::text('addItemText', null, ['class' => 'form-control', 'id'=>'addItemText'] ) !!}
                                                    <input type="hidden" name="returnlist" id="returnlist" value=""></td>
                                                <td>{!! Form::button('Add', ['name' => 'addIte', 'class' => 'btn btn-lg btn-info pull-right','onclick'=>'addItem(this.form)', 'autofocus'] ) !!}</td>
                                            </tr>
                                        </table>

                                        <br>
                                        <h4>Selected Items:</h4>
                                        <ul class="EventItemList" id="itemlist"></ul>
                                    </div>
                                </div>
                            </fieldset>

                        </div>
                    </div>

                    <div class="tab-pane well" id="tab4">
                        <script>
                            var inviteeArray = new Array();
                            var email = "";

                            function addInvitee()
                            {
                                email = document.getElementById('emails').value.toLowerCase().trim();

                                if(validEmail(email)) 
                                {
                                    document.getElementById('email-error').style.display = "none";
                                    document.getElementById('emails').value = "";
                                    inviteeArray.push(email);
                                    displayInviteeList();
                                } 
                                else 
                                    document.getElementById('email-error').style.display = "block";
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

                                document.getElementById("email-error").innerHTML = errorMessage;
                                return isValid;
                            }

                            function displayInviteeList() 
                            {
                                $("ul#invitee-list").empty();
                                for (var i in inviteeArray) {
                                    var li = "<li>";
                                    $("ul#invitee-list").append( (li.concat( inviteeArray[i] )).concat("</li>") )
                                }
                                document.getElementById("email-list").value = inviteeArray;
                            }

                        </script>
                        <legend>Invite Guests</legend>
                        <fieldset>
                            <div class="panel-body">
                                <!-- Email Invitees -->
                                <div class="form-group">
                                    <table>
                                        <tr>
                                            <td>{!! Form::label('emails', 'Emails:', ['class' => 'col-lg-2 control-label']) !!}</td>
                                            <td>
                                                {!! Form::text('emails', null, ['class' => 'form-control', 'id' => 'emails']) !!}
                                                <input type="hidden" name="email-list" id="email-list" value="">
                                                <span id="email-error" style="color:red; display:none;"></span>
                                            </td>
                                            <td>{!! Form::button('Add', ['name' => 'addInv', 'class' => 'btn btn-lg btn-info pull-right','onclick'=>'addInvitee(this.form)', 'autofocus'] ) !!}</td>
                                        </tr>
                                        <tr>
                                            <td><span id="email-error" style="color:red; display:none;"></span></td>
                                        </tr>
                                    </table>
                                    
                                    <br>

                                    <h4>Selected Emails:</h4>
                                    <ul class="InviteeList" id="invitee-list"></ul>                            
                                </div>
                            </div>
                        </fieldset>
                    </div>

                </div>
                <div class="form-group">
                    <div class="col-lg-10 col-lg-offset-2">
                        {!! Form::submit('Create Event!', ['name' => 'creEvent', 'class' => 'btn btn-lg btn-info pull-right'] ) !!}
                    </div>
                </div>
                {!! Form::close() !!}

            </div>
        </div>
    </div>

@endsection
