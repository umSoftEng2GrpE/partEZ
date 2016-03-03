<div class="event-details">
    <h4>Invited</h4>
    @if (count($invites))
    <ul>
        @foreach($invites as $person)
        <li>{{print_r($person, true)}}</li>
        @endforeach
    </ul>
    @else
    <p>This event has no invitees.</p>
    @endif
</div>