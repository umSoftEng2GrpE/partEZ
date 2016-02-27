<html>
	<head>
	</head>
	<body>
		<div id="chat_box" style="border : solid 2px #ffffff; background : #000000; color : #ffffff; padding : 4px; width : 100%; height : 500px; overflow : auto;  border-radius:10px;" >
			@if (count($chat_messages))
				@foreach($chat_messages as $message)
				<p><font color="#4CC417">{{print_r($message['created'], true)}} {{print_r($message['firstname'], true)}} {{print_r($message['lastname'], true)}}:</font><font color="#59E817"> {{print_r($message['msg'], true)}}</font></p>
				@endforeach
			@endif
		</div>
	</body>
</html>