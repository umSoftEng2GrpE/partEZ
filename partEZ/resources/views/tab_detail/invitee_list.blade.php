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

    @if( $event['public']==1)

            <script>
                var inviteeArray = new Array();
                var email = "";

                function addInvitee()
                {
                    email = document.getElementById('emails').value.toLowerCase().trim();

                    if(validEmail(email))
                    {
                        document.getElementById('email-error').style.display = "none";
                        document.getElementById('emails').value = "";
                        inviteeArray.push(email);
                        displayInviteeList();
                    }
                    else
                        document.getElementById('email-error').style.display = "block";
                }

                function validEmail(email)
                {
                    var isValid = true;
                    var regex = /\S+@\S+\.\S+/;
                    var errorMessage = "";

                    isValid = regex.test(email);

                    if(isValid)
                    {
                        if (inviteeArray.indexOf(email) >= 0)
                        {
                            isValid = false;
                            errorMessage = "Cannot add duplicate emails!";
                        }
                    }
                    else
                    {
                        errorMessage = "Invalid email syntax!";
                    }

                    document.getElementById("email-error").innerHTML = errorMessage;
                    return isValid;
                }

                function displayInviteeList()
                {
                    $("ul#invitee-list").empty();
                    for (var i in inviteeArray) {
                        var li = "<li>";
                        $("ul#invitee-list").append( (li.concat( inviteeArray[i] )).concat("</li>") )
                    }
                    document.getElementById("email-list").value = inviteeArray;
                }

            </script>
            <legend>Invite Guests</legend>
            {{  Form::open(['url' => 'public_invite']) }}
            <fieldset>
                <div class="panel-body">
                    <!-- Email Invitees -->
                    <div class="form-group">
                        <table>
                            <tr>
                                <td>{!! Form::label('emails', 'Emails:', ['class' => 'col-lg-2 control-label']) !!}</td>
                                <td>
                                    {!! Form::text('emails', null, ['class' => 'form-control', 'id' => 'emails']) !!}
                                    <input type="hidden" name="email-list" id="email-list" value="">
                                    {{ Form::hidden('eid', $event['eid']) }}
                                    <span id="email-error" style="color:red; display:none;"></span>
                                </td>
                                <td>{!! Form::button('Add', ['name' => 'addInv', 'class' => 'btn btn-lg btn-info pull-right','onclick'=>'addInvitee(this.form)', 'autofocus'] ) !!}</td>
                            </tr>
                            <tr>
                                <td><span id="email-error" style="color:red; display:none;"></span></td>
                            </tr>
                        </table>

                        <br>

                        <h4>Selected Emails:</h4>
                        <ul class="InviteeList" id="invitee-list"></ul>
                    </div>
                    <div class="form-group">
                        <div class="col-lg-10 col-lg-offset-2">
                            {!! Form::submit('Invite!', ['name' => 'creEvent', 'class' => 'btn btn-lg btn-info pull-right'] ) !!}
                        </div>
                    </div>
                </div>
            </fieldset>


            {!! Form::close() !!}

        @endif

</div>