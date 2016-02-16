<div class="container">
    <br>
    <h3> Event Name: {{ $event['name'] }} </h3>
    <br>
    <ul>
        <li> Date:{{ $event['date'] }} </li>
        <li> Start Time: {{ $event['stime']}} End Time: {{ $event['etime']}} </li>
        <li> Location: {{ $event['location'] }} </li>
        <li> Description: {{ $event['description'] }} </li>

        <!-- Details Button -->
        {{ Form::open(array('route' => array('events.event_details', $eid))) }}
            <button type="submit" href="{{ URL::route('events.event_details', array($eid))     }}"
                    class="btn btn-mini">Details</button>
        {{ Form::close() }}
    </ul>
    <br>
</div>