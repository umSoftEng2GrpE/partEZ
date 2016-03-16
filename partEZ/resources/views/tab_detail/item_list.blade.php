<div class="event-details">
    <h4>Items</h4>
    @if( count($items_list))
        @foreach($items_list as $item)
            @if( $item->uid == 0 )
                <p>{{ $item->description }} <a class='btn btn-xs btn-info' href="{!! route('assign_user', [$item->iid, 'eid'=>$event['eid']]) !!}">Bring this!</a></p>
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