<html lang="en">
<body>
<p>Click on the Date you would like to have your event on</p>
<ol>
    @foreach($options as $option)
        <li>
            <p>
                {{Form::open(array('route' => array('declare_poll_winner', 'value' => $option->option)))}}
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <input type="hidden" name="eid" value="{{ $event->eid }}">
                {{ $option->option }}
                Votes:{{ $option->votes }}
                <button href="{{URL::route('declare_poll_winner')}}">Select</button>
                {{Form::close() }}
            </p>
        </li>
    @endforeach
</ol>
</body>
</html>






