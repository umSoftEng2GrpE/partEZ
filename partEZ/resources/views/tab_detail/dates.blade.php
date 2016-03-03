<div class="event-details">
    <h4>Dates</h4>
        @if (count($all_options))
            @if ($event['uid'] == Auth::user()->uid)
                @foreach($all_options as $options)
                    @include('polls.poll_display', $options )
                @endforeach
            @else
                @foreach($all_options as $options)
                    @include('polls.poll_vote', $options )
                @endforeach
            @endif
        @else
            <p>This event has no polls.</p>
        @endif
</div>