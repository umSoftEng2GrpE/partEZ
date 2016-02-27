<script>
    var inviteeArray = new Array();
    var email = "";
    var currInvitees = document.getElementsByClassName('person');
    var newInvitees = [];
    function addInvitee()
    {
        email = document.getElementById('emails').value.toLowerCase().trim();
        if(currInvitees.length > 0 && inviteeArray.length == 0)
            addCurrInvitees();
        if(validEmail(email))
        {
            document.getElementById('email-error').style.display = "none";
            document.getElementById('emails').value = "";
            inviteeArray.push(email);
            newInvitees.push(email);
            displayInviteeList();
        }
        else
            document.getElementById('email-error').style.display = "block";
    }
    function addCurrInvitees()
    {
        for(var i = 0; i < currInvitees.length; i++)
            inviteeArray.push(currInvitees[i].innerHTML);
    }
    function validEmail(email)
    {
        var isValid = true;
        var regex = /\S+@\S+\.\S+/;
        var userEmail = <?php echo json_encode($user_email); ?>;
        var errorMessage = "";
        isValid = regex.test(email);
        if(isValid)
        {
            if (inviteeArray.indexOf(email) >= 0)
            {
                isValid = false;
                errorMessage = "Cannot add duplicate emails!";
            }
            else if (email == userEmail)
            {
                isValid = false;
                errorMessage = "Cannot add event creator!";
            }
        }
        else
        {
            errorMessage = "Invalid email syntax!";
        }
        document.getElementById('email-error').innerHTML = errorMessage;
        return isValid;
    }
    function displayInviteeList()
    {
        $("ul#invitee-list").empty();
        for (var i in inviteeArray)
        {
            var li = "<li>";
            $("ul#invitee-list").append( (li.concat( inviteeArray[i] )).concat("</li>") )
        }
        document.getElementById('email-list').value = newInvitees;
    }
</script>
<legend>Invite Guests</legend>
<fieldset>
    <!-- Email Invitees -->
    <div class="form-group">

        <table>
            <tr>
                <td>{!! Form::label('emails', 'Emails:', ['class' => 'col-lg-2 control-label']) !!}</td>
                <td>
                    {!! Form::text('emails', null, ['class' => 'form-control', 'id' => 'emails']) !!}
                    <span id="email-error" style="color:red; display:none;"></span>
                    <input type="hidden" name="email-list" id="email-list" value="">
                </td>
                <td>{!! Form::button('Add', ['class' => 'btn btn-lg btn-info pull-right','onclick'=>'addInvitee(this.form)', 'autofocus'] ) !!}</td>
            </tr>
            <tr>
                <td><span id="email-error" style="color:red; display:none;"></span></td>
            </tr>
        </table>

        <br>

        <h4>Selected Emails:</h4>
        <ul class="InviteeList" id="invitee-list">
            @foreach($invites as $person)
                <li class="person">{{print_r($person, true)}}</li>
            @endforeach
        </ul>

    </div>
</fieldset>