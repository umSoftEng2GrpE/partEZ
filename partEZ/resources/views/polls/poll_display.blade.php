
@if (count($options))
    @foreach($options as $option)
        <p> {{ $option['option'] }} </p>
    @endforeach
@else
    <p>This event has no polls.</p>
@endif