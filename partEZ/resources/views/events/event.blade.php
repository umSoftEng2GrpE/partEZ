

<div class="container">
    <br>
    <h3> Event Name: {{ $event['name'] }} </h3>
    <br>
    <ul>
        <li> Date:{{ $event['date'] }} </li>
        <li> Start Time: {{ $event['stime']}} End Time: {{ $event['etime']}} </li>
        <li> Location: {{ $event['location'] }} </li>
        <li> Description: {{ $event['description'] }} </li>
    </ul>
    <br>
</div>