<div class="event-row container">
    <div class="event-title">
        <h5> {{ $invite['name'] }}</h5>
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