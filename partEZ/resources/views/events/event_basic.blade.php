<div class="event-row container">
    <div class="event-title">
        <h5> {{ $event['name'] }} - 

            @if ($event['public'])
                <i title="This event is public" class="fa fa-unlock event-access-ico"></i>
            @else
                <i title="This event is private" class="fa fa-lock event-access-ico"></i>
            @endif
        </h5>
    </div>
        
    <div class="event-btn-container">
        <div class="event-btn">
            <!-- Details Button -->
            <a name="details_btn" title="Details" href="{{ URL::route('events.event_details', array($eid)) }}" class="btn-link">
                <i class="fa fa-info-circle"></i>
            </a>
        </div>

        <div class="event-btn">
            <!-- Edit Button -->
            <a name="edit_btn" title="Edit" href="{{ URL::route('events.event_details_edit', array($eid)) }}" class="btn-link">
                <i class="fa fa-pencil-square"></i>
            </a>
        </div>

        <div class="event-btn">
            <!-- Edit Button -->
            <a name="delete_btn" title="Delete" href="{{ URL::route('events.event_delete', array($eid)) }}" class="btn-link">
                <i class="fa fa-trash"></i>
            </a>
        </div>
    </div>
</div>