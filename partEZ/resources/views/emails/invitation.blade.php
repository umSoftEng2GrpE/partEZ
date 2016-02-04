<!DOCTYPE html>
<html lang="en-US">
<head>
    <meta charset="utf-8">
</head>
<body>
<h2>It's a party!</h2>

<div>
	<p>
    You've been invited to {!! $eventname !!}!
    </p>
    <p>
    On: {!! $date !!} from {!! $stime !!} to {!! $etime !!}
    </p>
    <p>
    Location: {!! $location !!}
    </p>
    <p>
    {!! $description !!}
    </p>

    <a href="{!! route('events.accept', ['eid'=>$eid, 'uid'=>$uid]) !!}">Accept</a>

    <a href="">Decline</a>
</div>

</body>
</html>