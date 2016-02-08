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
                    <li  ><a href="#tab1" data-toggle="tab">Create Event</a></li>
                    <li><a href="#tab2" data-toggle="tab">Poll</a></li>
                    <li><a href="#tab3" data-toggle="tab">Item List</a></li>
                    <li><a href="#tab4" data-toggle="tab">Forth</a></li>
                    <li><a href="#tab5" data-toggle="tab">Fifth</a></li>
                    <li><a href="#tab6" data-toggle="tab">Sixth</a></li>
                    <li><a href="#tab7" data-toggle="tab">Seventh</a></li>
                </ul>

                <div class="tab-content">
                    <div class="tab-pane" id="tab1">
                        <div class="well">

                            {{  Form::open(['url' => 'create_event']) }}


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
                                        {!! Form::text('date', null, ['class' => 'form-control'] ) !!}
                                    </div>
                                </div>

                                <!-- Time -->
                                <div class="form-group">
                                    {!! Form::label('time', 'Time:', ['class' => 'col-lg-2 control-label']) !!}
                                    <div class="col-lg-10">
                                        {!! Form::text('stime', null ) !!}
                                        To:
                                        {!! Form::text('etime', null ) !!}
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

                                <!-- Next Button -->
                                <!-- Submits event info for event creation-->
                                <div class="form-group">
                                    <div class="col-lg-10 col-lg-offset-2">
                                        {!! Form::submit('Next', ['class' => 'btn btn-lg btn-info pull-right'] ) !!}
                                    </div>
                                </div>

                            </fieldset>

                            {!! Form::close()  !!}

                        </div>
                    </div>
                    <div class="tab-pane" id="tab2">
                        <div class="well">

                            {{  Form::open(['url' => 'create_poll']) }}
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
                                <!-- Next Button -->
                                <!-- Submits event info for event creation-->
                                <div class="form-group">
                                    <div class="col-lg-10 col-lg-offset-2">
                                        {!! Form::submit('Next', ['class' => 'btn btn-lg btn-info pull-right'] ) !!}
                                    </div>
                                </div>

                            </fieldset>

                            {!! Form::close()  !!}

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

                                    //$("ul#itemlist").empty().html(arr.join(""));
                                }

                                function addItem()
                                {
                                    arr.push(document.getElementById('addItemText').value);
                                    displayList();
                                }

                            </script>
                            {{Form::open(['url' => 'create_event_list']) }}
                            <fieldset>
                                <legend>Create an Event Item List</legend>
                                <div class="form-group">
                                    {!! Form::label('addItem', 'Add an item', ['class' => 'col-lg-5 control-label']) !!}
                                    {!! Form::text('addItemText', null, ['class' => 'form-control', 'id'=>'addItemText'] ) !!}
                                </div>
                                <div class="form-group">
                                    <div class="col-lg-10 col-lg-offset-2">
                                        {!! Form::button('Add item', ['class' => 'btn btn-lg btn-info pull-right','onclick'=>'addItem(this.form)', 'autofocus'] ) !!}
                                    </div>
                                </div>
                                <div class="form-group">
                                    <ul class="EventItemList" id="itemlist">
                                    </ul>
                                </div>
                            </fieldset>
                            {!! Form::close() !!}
                        </div>
                    </div>
                    <div class="tab-pane" id="tab4">
                        4
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

            </div>
        </div>
    </div>
@endsection
