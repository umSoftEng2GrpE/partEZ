<div class="well">

    <script>
        var datePollOps = new Array();
        var currPollOps = document.getElementsByClassName('poll-op');
        var newPollOps = [];
        function addCurrPollOps()
        {
            for(var i = 0; i < currPollOps.length; i++)
                datePollOps.push(currPollOps[i].innerHTML);
        }
        function displayDatePoll()
        {
            $("ul#datepolllist").empty();
            for (var i in datePollOps)
            {
                var li = "<li>";
                $("ul#datepolllist").append( (li.concat( datePollOps[i] )).concat("</li>") )
            }
            document.getElementById('returndatepolls').value = newPollOps;
        }
        function addDatePoll(selected)
        {
            if(currItems.length > 0 && datePollOps.length == 0)
                addCurrPollOps();
            datePollOps.push(selected);
            newPollOps.push(selected);
            displayDatePoll(selected);
        }
    </script>
    <fieldset>
        <legend>Date Proposals</legend>
        <p>Choose multiple dates</p>
        <div class="form-group">

            <!-- Date -->
            {!! Form::label('addDatePoll', 'Possible Dates', ['class' => 'col-lg-5 control-label']) !!}
            <div id="dateCalendar"></div>
            <!-- Date -->

            <input type="hidden" name="returndatepolls" id="returndatepolls" value="">

            <br>

            <h4>Selected Dates:</h4>
            <ul class="EventDatePollList" id="datepolllist" style="list-style: none;">
                @if ($event['uid'] == Auth::user()->uid)
                    @foreach($all_options as $options)
                        <li class="poll-op">@include('polls.poll_display', $options )</li>
                    @endforeach
                @else
                    @foreach($all_options as $options)
                        <li class="poll-op">@include('polls.poll_vote', $options )</li>
                    @endforeach
                @endif
            </ul>
        </div>
    </fieldset>

</div>