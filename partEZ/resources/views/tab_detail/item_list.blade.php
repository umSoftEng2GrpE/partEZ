<div class="event-details">
    <h4>Items</h4>
    @if( count($items_list))
        @foreach($items_list as $item)
            <p> {{ $item->description }} </p>
        @endforeach
    @else
        <p>This event has no items.</p>
    @endif
</div>