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
                    <li  ><a href="#tab1" data-toggle="tab">Event Details</a></li>
                    <li><a href="#tab2" data-toggle="tab">Poll</a></li>
                    <li><a href="#tab3" data-toggle="tab">Item List</a></li>
                    <li><a href="#tab4" data-toggle="tab">Invitations</a></li>
                    <li><a href="#tab5" data-toggle="tab">Fifth</a></li>
                    <li><a href="#tab6" data-toggle="tab">Sixth</a></li>
                    <li><a href="#tab7" data-toggle="tab">Seventh</a></li>
                </ul>
                {{  Form::open(['url' => 'create_event']) }}
                <div class="tab-content">
                    <div class="tab-pane" id="tab1">
                        <div class="well">

                            <fieldset>

                                <legend>Create An Event</legend>

                                <!-- Name -->
                                <div class="form-group">
                                    {!! Form::label('name', 'Name:', ['class' => 'col-lg-2 control-label']) !!}
                                    <div class="col-lg-10">
                                        {!! Form::text('name', null, ['required'], ['class' => 'form-control']) !!}
                                    </div>
                                </div>

                                <!-- Where -->
                                <div class="form-group">
                                    {!! Form::label('location', 'Location:', ['class' => 'col-lg-2 control-label']) !!}
                                    <div class="col-lg-10">
                                        {!! Form::text('location', null, ['required'], ['class' => 'form-control']) !!}
                                    </div>
                                </div>

                                <!-- Date -->

                                <div class="form-group">
                                    {!! Form::label('date', 'When:', ['class' => 'col-lg-2 control-label']) !!}
                                    <div class="col-lg-10">
                                        {{ Form::text('date', null, array('id' => 'datepicker') ) }}
                                    </div>
                                </div>

                                <!-- Time -->
                                <div class="form-group">
                                    {!! Form::label('time', 'Time:', ['class' => 'col-lg-2 control-label']) !!}
                                    <div class="col-lg-10">
                                        {{ Form::text('stime', null, array('id' => 'timepicker') ) }}
                                        To:
                                        {{ Form::text('etime', null, array('id' => 'timepicker1') ) }}
                                    </div>
                                </div>

                                <!-- Details -->
                                <div class="form-group">
                                    {!! Form::label('description', 'Description', ['class' => 'col-lg-2 control-label']) !!}
                                    <div class="col-lg-10">
                                        {!! Form::textarea('description', null, ['class' => 'form-control']) !!}
                                        <span class="help-block">Anymore details you may want to add for the party.</span>
                                    </div>
                                </div>
                            </fieldset>


                        </div>
                    </div>
                    <div class="tab-pane" id="tab2">
                        <div class="well">

                            <fieldset>
                                <legend>Create A Poll</legend>
                                <div class="form-group">
                                    <!-- Date -->
                                    {!! Form::label('date1', 'Possible', ['class' => 'col-lg-5 control-label']) !!}
                                    {!! Form::select('type', array('time' => 'Time', 'date' => 'Date') ) !!}
                                    {!! Form::text('date1', null, ['class' => 'form-control'] ) !!}
                                    <!-- Date -->
                                    <br>
                                    {!! Form::text('date2', null, ['class' => 'form-control'] ) !!}
                                    <!-- Date -->
                                    <br>
                                    {!! Form::text('date3', null, ['class' => 'form-control'] ) !!}
                                    <!-- Date -->
                                    <br>
                                    {!! Form::text('date4', null, ['class' => 'form-control'] ) !!}
                                    <span class="help-block">Click next if you don't need help picking the date</span>
                                </div>
                            </fieldset>

                        </div>
                    </div>
                    <div class="tab-pane" id="tab3">
                        <div class="well">
                            <script>
                                var arr = new Array();

                                function displayList() {

                                    //var arr = ["list", "items", "here"];
                                    //$("displayList").append("<ul></ul>");
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
                            <fieldset>
                                <legend>Create an Event Item List</legend>
                                <div class="form-group">
                                    {!! Form::label('addItem', 'Add an item', ['class' => 'col-lg-5 control-label']) !!}
                                    {!! Form::text('addItemText', null, ['class' => 'form-control', 'id'=>'addItemText'] ) !!}
                                    <input type="hidden" name="returnlist" id="returnlist" value="">
                                </div>
                                <div class="form-group">
                                    <div class="col-lg-10 col-lg-offset-2">
                                        {!! Form::button('Add item', ['class' => 'btn btn-lg btn-info pull-right','onclick'=>'addItem(this.form)', 'autofocus'] ) !!}
                                    </div>
                                </div>
                                <div class="form-group">
                                    <ul class="EventItemList" id="itemlist" style="list-style: none;">
                                    </ul>
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

                                document.getElementById('email-error').innerHTML = errorMessage;
                                return isValid;
                            }

                            function displayInviteeList() 
                            {
                                $("ul#invitee-list").empty();
                                for (var i in inviteeArray) {
                                    var li = "<li>";
                                    $("ul#invitee-list").append( (li.concat( inviteeArray[i] )).concat("</li>") )
                                }
                                document.getElementById('email-list').value = inviteeArray;
                            }

                        </script>
                        <legend>Invite Guests</legend>
                        <fieldset>
                            <div class="panel-body">
                                <!-- Email Invitees -->
                                <div class="form-group">
                                    {!! Form::label('emails', 'Emails:', ['class' => 'col-lg-2 control-label']) !!}
                                    <div class="col-lg-10">
                                        {!! Form::text('emails', null, ['required'], ['class' => 'form-control', 'id' => 'emails']) !!}
                                        {!! Form::button('Add', ['class' => 'btn btn-lg btn-info pull-right','onclick'=>'addInvitee(this.form)', 'autofocus'] ) !!}
                                        <input type="hidden" name="email-list" id="email-list" value="">
                                        <span id="email-error" style="color:red; display:none;"></span>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <ul class="InviteeList" id="invitee-list">
                                    </ul>
                                </div>
                            </div>
                        </fieldset>
                    </div>

                    <div class="tab-pane" id="tab5">
                        5
                    </div>
                    <div class="tab-pane" id="tab6">
                        6
                    </div>
                    <div class="tab-pane" id="tab7">
                        7
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-lg-10 col-lg-offset-2">
                        {!! Form::submit('Create Event!', ['class' => 'btn btn-lg btn-info pull-right'] ) !!}
                    </div>
                </div>
                {!! Form::close() !!}

            </div>
        </div>
    </div>

@endsection
