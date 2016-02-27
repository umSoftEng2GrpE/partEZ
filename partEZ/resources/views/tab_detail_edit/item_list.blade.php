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

            <h4>Selected Items:</h4>
            <ul class="EventItemList" id="itemlist">
                @foreach($items_list as $item)
                    <li class="item"> {{ $item->description }} </li>
                @endforeach
            </ul>
        </div>
    </fieldset>

</div>