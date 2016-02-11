@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">

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
        </div>
    </div>
@endsection