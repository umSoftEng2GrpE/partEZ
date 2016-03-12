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
                        @include('tab_detail_edit.event_details', $event)
                    </div>

                    <div class="tab-pane" id="tab2">
                        <div class="well">
                            <p>
                                Cannot be edited from this menu.
                            </p>
                        </div>
                    </div>

                    <div class="tab-pane" id="tab3">
                        @include('tab_detail_edit.item_list', $items_list)
                    </div>

                    <div class="tab-pane" id="tab4">
                        @include('tab_detail_edit.invitee_list', $invites)
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