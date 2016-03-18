package com.partez.acceptance;
import android.test.ActivityInstrumentationTestCase2;
import android.view.View;
import android.widget.AutoCompleteTextView;
import android.widget.*;

import com.partez.EventActivity;
import com.partez.HomeActivity;
import com.partez.LoginActivity;
import com.partez.EventDetailsActivity;
import com.partez.R;
import com.robotium.solo.Solo;

/**
 * Created by Brianna on 2016-03-17.
 */
public class AcceptanceTest extends ActivityInstrumentationTestCase2<LoginActivity>
{

    private Solo solo;

    public AcceptanceTest()
    {
        super(LoginActivity.class);
    }

    public void setUp() throws Exception
    {
        super.setUp();
        solo = new Solo(getInstrumentation(), getActivity());
    }

    public void testEndToEnd()
    {
        EditText mEmailView;
        EditText mPasswordView;
        EditText eventName;
        EditText eventCity;
        EditText eventDescription;
        EditText eventLocation;
        EditText addInvitee;

        Button mEmailSignInButton;
        Button createEventButton;
        Button submitButton;
        Button addInviteeButton;
        Button addItemButton;
        Button addPollButton;

        DatePicker datePicker;
        TimePicker stimePicker;
        TimePicker etimePicker;

        LinearLayout linearLayout;

        mEmailView = (AutoCompleteTextView) solo.getView(R.id.email);
        mPasswordView = (EditText) solo.getView(R.id.password);
        mEmailSignInButton = (Button) solo.getView(R.id.email_sign_in_button);

        //*** LOGIN ***
        solo.waitForActivity("LoginActivity");
        solo.assertCurrentActivity("Check on first Activity", LoginActivity.class);

        solo.enterText(mEmailView, String.valueOf("user@test.com"));
        solo.enterText(mPasswordView, String.valueOf("password"));

        solo.clickOnView(mEmailSignInButton);
        solo.assertCurrentActivity("Expected activity HomeActivity", HomeActivity.class);

        //*** CREATE EVENT ***
        createEventButton = (Button) solo.getView(R.id.create_event);
        solo.clickOnView(createEventButton);
        solo.assertCurrentActivity("Check on first EventDetailsActivity", EventDetailsActivity.class);

        eventName = (EditText) solo.getView(R.id.event_name);
        eventCity = (EditText) solo.getView(R.id.event_city);
        eventDescription = (EditText) solo.getView(R.id.event_description);
        eventLocation = (EditText) solo.getView(R.id.event_location);
        datePicker = ((DatePicker)solo.getView(R.id.event_date));
        stimePicker = ((TimePicker)solo.getView(R.id.stime_picker));
        etimePicker = ((TimePicker)solo.getView(R.id.etime_picker));
        addInviteeButton = (Button) solo.getView(R.id.add_email_edit);
        addItemButton = (Button) solo.getView(R.id.add_item_edit);
        addPollButton = (Button) solo.getView(R.id.add_poll_edit);
        submitButton = (Button) solo.getView(R.id.submit_event);

        //Details
        solo.enterText(eventName, String.valueOf("Party Hardy"));
        solo.enterText(eventCity, String.valueOf("Winnipeg"));
        solo.enterText(eventLocation, String.valueOf("1234 Potato Lane"));
        solo.enterText(eventDescription, String.valueOf("This is a pretty cool event and you should come."));

        //Date and Time
        solo.setDatePicker(datePicker, 2016, 04, 01);
        solo.setTimePicker(stimePicker, 14, 0);
        solo.setTimePicker(etimePicker, 20, 0);

        //Add poll
        solo.clickOnView(addPollButton);
        linearLayout = (LinearLayout) solo.getView(R.id.pollEditTextGroupLayout);
        addInvitee = (EditText) linearLayout.getChildAt(1);
        solo.enterText(addInvitee, String.valueOf("Test Poll"));
        solo.waitForText("Test Poll");

        //Add item
        solo.clickOnView(addItemButton);
        linearLayout = (LinearLayout) solo.getView(R.id.itemEditTextGroupLayout);
        addInvitee = (EditText) linearLayout.getChildAt(1);
        solo.enterText(addInvitee, String.valueOf("Chips"));
        solo.waitForText("Chips");

        //Invite user
        solo.clickOnView(addInviteeButton);
        linearLayout = (LinearLayout) solo.getView(R.id.inviteEditTextGroupLayout);
        addInvitee = (EditText) linearLayout.getChildAt(1);
        solo.enterText(addInvitee, String.valueOf("partezapp@gmail.com"));
        solo.waitForText("partezapp@gmail.com");
        solo.waitForActivity("EventDetailsActivity");

        //Submit creation
        solo.scrollUp();
        solo.scrollUp();
        solo.scrollUp();
        solo.clickOnView(submitButton);

        //Check the details page
        solo.waitForActivity("EventActivity");
        solo.assertCurrentActivity("Check on details for Activity", EventActivity.class);
        assertTrue(solo.searchText("Party Hardy"));
        assertTrue(solo.searchText("1234 Potato Lane"));
        assertTrue(solo.searchText("This is a pretty cool event and you should come."));
    }

    @Override
    public void tearDown() throws Exception
    {
        solo.finishOpenedActivities();
    }
}
