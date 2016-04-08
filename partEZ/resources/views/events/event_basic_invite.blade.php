<div class="event-row container">
    <div class="event-title">
        <h5> {{ $invite['name'] }} -
            @if ($invite['public'])
                <i title="This event is public" class="fa fa-unlock event-access-ico"></i>
            @else
                <i title="This event is private" class="fa fa-lock event-access-ico"></i>
            @endif

            @if ($invite['hastickets'])
                @if ($invite['numtickets'] != 0)
                    <i title="This event has {{ $invite['numtickets'] }} ticket(s) available!" class="fa fa-ticket"></i>
                @else
                    <i title="This event is sold out." class="fa fa-ticket" style="color:grey"></i>
                @endif
            @endif
        </h5>
    </div>
        
    <div class="event-btn-container">
        <div class="event-btn">
            <!-- Details Button -->
            <a title="Details" href="{{ URL::route('events.event_details', array($eid)) }}" class="btn-link">
                <i class="fa fa-info-circle"></i>
            </a>
        </div>
    </div>
</div>