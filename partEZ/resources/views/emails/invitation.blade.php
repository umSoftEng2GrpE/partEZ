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

    <a href="{!! route('accept_invite', ['eid'=>$eid, 'uid'=>$uid]) !!}">Accept</a>

    <a href="{!! route('decline_invite', ['eid'=>$eid, 'uid'=>$uid]) !!}">Decline</a>
</div>

</body>
</html>