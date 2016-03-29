<div class="event-details">
    <h4>Details</h4>
        <ul>
            <li> {{ $event['public'] == 1 ? "This is a public event" : "This is a private event" }} </li>
            <li> Date:{{ $event['date'] }} </li>
            <li> Start Time: {{ $event['stime']}} End Time: {{ $event['etime']}} </li>
            <li> Location: {{ $event['location'] }} </li>
            <li> Description: {{ $event['description'] }} </li>
        </ul>

        @if ($event['hastickets'] && $event['numtickets'] > 0)
            <h4> Purchase Tickets </h4>
            <a class='btn btn-lg btn-info' href="{!! route('buy_ticket', ['eid'=>$event['eid']]) !!}">${{ $ticketcost }}</a>

        @endif

        @if ($event['uid'] != Auth::user()->uid)
            <h4> RSVP </h4>
            Your current status: {{ $rsvp_status }}
            <br>
            <a class='btn btn-lg btn-info' href="{!! route('accept_invite', ['eid'=>$event['eid'], 'uid'=>Auth::user()->uid]) !!}">Accept</a>
            <a class='btn btn-lg btn-info' href="{!! route('decline_invite', ['eid'=>$event['eid'], 'uid'=>Auth::user()->uid]) !!}">Decline</a>
        @endif
</div>