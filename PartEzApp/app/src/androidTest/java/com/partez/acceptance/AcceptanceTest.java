package com.partez.acceptance;
import android.test.ActivityInstrumentationTestCase2;
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

    public void testLogin()
    {
        EditText mEmailView;
        EditText mPasswordView;
        Button mEmailSignInButton;

        mEmailView = (AutoCompleteTextView) solo.getView(R.id.email);
        mPasswordView = (EditText) solo.getView(R.id.password);
        mEmailSignInButton = (Button) solo.getView(R.id.email_sign_in_button);

        solo.waitForActivity("LoginActivity");
        solo.assertCurrentActivity("Check on first Activity", LoginActivity.class);

        solo.enterText(mEmailView, String.valueOf("user@test.com"));
        solo.enterText(mPasswordView, String.valueOf("password"));

        solo.clickOnView(mEmailSignInButton);
        solo.waitForActivity("HomeActivity");
        solo.assertCurrentActivity("Expected activity HomeActivity", HomeActivity.class);
    }

    public void testEventCreate()
    {
        EditText eventName;
        EditText eventCity;
        Button createEventButton;
        Button submitButton;

        testLogin();

        createEventButton = (Button) solo.getView(R.id.create_event);
        solo.clickOnView(createEventButton);
        solo.waitForActivity("EventDetailsActivity");
        solo.assertCurrentActivity("Check on first EventDetailsActivity", EventDetailsActivity.class);

        eventName = (EditText) solo.getView(R.id.event_name);
        eventCity = (EditText) solo.getView(R.id.event_city);
        submitButton = (Button) solo.getView(R.id.submit_event);

        //Basic info
        solo.enterText(eventName, String.valueOf("Basic Event"));
        solo.enterText(eventCity, String.valueOf("Winnipeg"));

        solo.scrollUp();
        solo.scrollUp();
        solo.scrollUp();
        solo.clickOnView(submitButton);

        solo.waitForActivity("EventActivity");
        solo.assertCurrentActivity("Check on details for Activity", EventActivity.class);
        assertTrue(solo.searchText("Basic Event"));
    }

    public void testEventDetails()
    {
        EditText eventName;
        EditText eventCity;
        EditText eventDescription;
        EditText eventLocation;

        Button submitButton;
        Button createEventButton;

        DatePicker datePicker;
        TimePicker stimePicker;
        TimePicker etimePicker;

        testLogin();

        createEventButton = (Button) solo.getView(R.id.create_event);
        solo.clickOnView(createEventButton);
        solo.waitForActivity("EventDetailsActivity");
        solo.assertCurrentActivity("Check on first EventDetailsActivity", EventDetailsActivity.class);

        eventName = (EditText) solo.getView(R.id.event_name);
        eventCity = (EditText) solo.getView(R.id.event_city);
        eventDescription = (EditText) solo.getView(R.id.event_description);
        eventLocation = (EditText) solo.getView(R.id.event_location);
        datePicker = ((DatePicker)solo.getView(R.id.event_date));
        stimePicker = ((TimePicker)solo.getView(R.id.stime_picker));
        etimePicker = ((TimePicker)solo.getView(R.id.etime_picker));
        submitButton = (Button) solo.getView(R.id.submit_event);

        //Details
        solo.enterText(eventName, String.valueOf("Party Hardy"));
        solo.enterText(eventCity, String.valueOf("Winnipeg"));
        solo.enterText(eventLocation, String.valueOf("1234 Potato Lane"));
        solo.enterText(eventDescription, String.valueOf("This is a pretty cool event and you should come."));
        solo.setDatePicker(datePicker, 2016, 05, 01);
        solo.setTimePicker(stimePicker, 14, 0);
        solo.setTimePicker(etimePicker, 20, 0);

        solo.scrollUp();
        solo.scrollUp();
        solo.scrollUp();
        solo.clickOnView(submitButton);

        solo.waitForActivity("EventActivity");
        solo.assertCurrentActivity("Check on details for Activity", EventActivity.class);
        assertTrue(solo.searchText("Party Hardy"));
        assertTrue(solo.searchText("1234 Potato Lane"));
        assertTrue(solo.searchText("This is a pretty cool event and you should come."));
    }

    public void testEventInvite()
    {
        EditText eventName;
        EditText eventCity;
        EditText eventDescription;
        EditText addInvitee;

        Button createEventButton;
        Button submitButton;
        Button addInviteeButton;

        LinearLayout linearLayout;

        testLogin();

        createEventButton = (Button) solo.getView(R.id.create_event);
        solo.clickOnView(createEventButton);
        solo.waitForActivity("EventDetailsActivity");
        solo.assertCurrentActivity("Check on first EventDetailsActivity", EventDetailsActivity.class);

        eventName = (EditText) solo.getView(R.id.event_name);
        eventCity = (EditText) solo.getView(R.id.event_city);
        eventDescription = (EditText) solo.getView(R.id.event_description);
        submitButton = (Button) solo.getView(R.id.submit_event);

        solo.enterText(eventName, String.valueOf("Invite Event"));
        solo.enterText(eventCity, String.valueOf("Winnipeg"));
        solo.enterText(eventDescription, String.valueOf("Test for event inviting big user story."));

        solo.scrollDown();
        solo.scrollDown();
        solo.scrollDown();

        //Invite user
        addInviteeButton = (Button) solo.getView(R.id.add_email_edit);
        solo.clickOnView(addInviteeButton);
        linearLayout = (LinearLayout) solo.getView(R.id.inviteEditTextGroupLayout);
        addInvitee = (EditText) linearLayout.getChildAt(1);
        solo.enterText(addInvitee, String.valueOf("partezapp@gmail.com"));
        solo.waitForText("partezapp@gmail.com");

        solo.scrollUp();
        solo.scrollUp();
        solo.scrollUp();
        solo.clickOnView(submitButton);

        solo.waitForActivity("EventActivity");
        solo.assertCurrentActivity("Check on details for Activity", EventActivity.class);
        assertTrue(solo.searchText("Invite Event"));
        assertTrue(solo.searchText("Test for event inviting big user story."));
    }

    public void testInviteePoll()
    {
        EditText eventName;
        EditText eventCity;
        EditText eventDescription;
        EditText addInvitee;

        Button createEventButton;
        Button submitButton;
        Button addPollButton;

        LinearLayout linearLayout;

        testLogin();

        createEventButton = (Button) solo.getView(R.id.create_event);
        solo.clickOnView(createEventButton);
        solo.waitForActivity("EventDetailsActivity");
        solo.assertCurrentActivity("Check on first EventDetailsActivity", EventDetailsActivity.class);

        eventName = (EditText) solo.getView(R.id.event_name);
        eventCity = (EditText) solo.getView(R.id.event_city);
        eventDescription = (EditText) solo.getView(R.id.event_description);
        submitButton = (Button) solo.getView(R.id.submit_event);

        solo.enterText(eventName, String.valueOf("Invitee Poll Event"));
        solo.enterText(eventCity, String.valueOf("Winnipeg"));
        solo.enterText(eventDescription, String.valueOf("Test for event invitee date poll big user story."));

        solo.scrollDown();
        solo.scrollDown();
        solo.scrollDown();

        //Invitee poll
        addPollButton = (Button) solo.getView(R.id.add_poll_edit);
        solo.clickOnView(addPollButton);
        linearLayout = (LinearLayout) solo.getView(R.id.pollEditTextGroupLayout);
        addInvitee = (EditText) linearLayout.getChildAt(1);
        solo.enterText(addInvitee, String.valueOf("02/12/1994"));
        solo.waitForText("02/12/1994");

        solo.scrollUp();
        solo.scrollUp();
        solo.scrollUp();
        solo.clickOnView(submitButton);

        solo.waitForActivity("EventActivity");
        solo.assertCurrentActivity("Check on details for Activity", EventActivity.class);
        assertTrue(solo.searchText("Invitee Poll Event"));
        assertTrue(solo.searchText("Test for event invitee date poll big user story."));
    }

    public void testInviteeDetails()
    {
        EditText eventName;
        EditText eventCity;
        EditText eventDescription;
        EditText addItem;

        Button createEventButton;
        Button submitButton;
        Button addItemButton;

        LinearLayout linearLayout;

        testLogin();

        createEventButton = (Button) solo.getView(R.id.create_event);
        solo.clickOnView(createEventButton);
        solo.waitForActivity("EventDetailsActivity");
        solo.assertCurrentActivity("Check on first EventDetailsActivity", EventDetailsActivity.class);

        eventName = (EditText) solo.getView(R.id.event_name);
        eventCity = (EditText) solo.getView(R.id.event_city);
        eventDescription = (EditText) solo.getView(R.id.event_description);
        submitButton = (Button) solo.getView(R.id.submit_event);

        solo.enterText(eventName, String.valueOf("Invitee Details Event"));
        solo.enterText(eventCity, String.valueOf("Winnipeg"));
        solo.enterText(eventDescription, String.valueOf("Test for invitee details item adding big user story."));

        solo.scrollDown();
        solo.scrollDown();
        solo.scrollDown();

        //Add item
        addItemButton = (Button) solo.getView(R.id.add_item_edit);
        solo.clickOnView(addItemButton);
        linearLayout = (LinearLayout) solo.getView(R.id.itemEditTextGroupLayout);
        addItem = (EditText) linearLayout.getChildAt(1);
        solo.enterText(addItem, String.valueOf("Chips"));
        solo.waitForText("Chips");

        solo.scrollUp();
        solo.scrollUp();
        solo.scrollUp();
        solo.clickOnView(submitButton);

        solo.waitForActivity("EventActivity");
        solo.assertCurrentActivity("Check on details for Activity", EventActivity.class);
        assertTrue(solo.searchText("Invitee Details Event"));
        assertTrue(solo.searchText("Test for invitee details item adding big user story."));
    }

    public void testPublicEvent()
    {
        EditText eventName;
        EditText eventCity;
        EditText eventDescription;

        Button createEventButton;
        Button submitButton;
        RadioButton isPublic;

        testLogin();

        createEventButton = (Button) solo.getView(R.id.create_event);
        solo.clickOnView(createEventButton);
        solo.waitForActivity("EventDetailsActivity");
        solo.assertCurrentActivity("Check on first EventDetailsActivity", EventDetailsActivity.class);

        eventName = (EditText) solo.getView(R.id.event_name);
        eventCity = (EditText) solo.getView(R.id.event_city);
        eventDescription = (EditText) solo.getView(R.id.event_description);
        submitButton = (Button) solo.getView(R.id.submit_event);

        solo.enterText(eventName, String.valueOf("Public Event"));
        solo.enterText(eventCity, String.valueOf("Winnipeg"));
        solo.enterText(eventDescription, String.valueOf("Test for pub event big user story."));

        solo.scrollDown();
        solo.scrollDown();
        solo.scrollDown();

        isPublic = (RadioButton) solo.getView(R.id.public_event);
        solo.clickOnView(isPublic);

        solo.scrollUp();
        solo.scrollUp();
        solo.scrollUp();
        solo.clickOnView(submitButton);

        solo.waitForActivity("EventActivity");
        solo.assertCurrentActivity("Check on details for Activity", EventActivity.class);
        assertTrue(solo.searchText("Public Event"));
        assertTrue(solo.searchText("Test for pub event big user story."));
        assertTrue(solo.searchText("public"));
    }

    public void testEventsByLocation()
    {
        testLogin();

        solo.clickOnText("Public Events");
        solo.clickOnText("Comic Con");

        solo.waitForActivity("EventActivity");
        solo.assertCurrentActivity("Check on details for Activity", EventActivity.class);
        assertTrue(solo.searchText("Comic Con"));
        assertTrue((solo.searchText("Convention Center")));
    }

    @Override
    public void tearDown() throws Exception
    {
        solo.finishOpenedActivities();
    }
}
