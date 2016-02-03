<div class="container">
    {{ $poll->pid }}

    @if (count($options))
        @foreach($options as $poll_option)
            @include('polls.poll_option_display', $poll_option)
        @endforeach
    @else
        <p>This event has no polls.</p>
    @endif
</div>