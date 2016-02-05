<div class="container">
    <br>
    <h3> Invited Event Name: {{ $invite['name'] }} </h3>
    <br>
    <ul>
        <li> Date:{{ $invite['date'] }} </li>
        <li> Start Time: {{ $invite['stime']}} End Time: {{ $invite['etime']}} </li>
        <li> Location: {{ $invite['location'] }} </li>
        <li> Description: {{ $invite['description'] }} </li>

        <!-- Details Button -->
        {{ Form::open(array('route' => array('events.event_details_invite', $eid))) }}
            <button type="submit" href="{{ URL::route('events.event_details_invite', array($eid))     }}"
                    class="btn btn-mini">Details</button>
        {{ Form::close() }}
    </ul>
    <br>
</div>