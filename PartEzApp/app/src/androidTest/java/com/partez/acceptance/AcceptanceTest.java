package com.partez.acceptance;
import android.test.ActivityInstrumentationTestCase2;
import android.widget.AutoCompleteTextView;
import android.widget.*;

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

    public void testAppUse()
    {
        EditText mEmailView;
        EditText mPasswordView;
        EditText eventName;
        EditText eventCity;
        EditText eventDescription;
        EditText eventLocation;

        Button mEmailSignInButton;
        Button createEventButton;
        Button submitButton;

        mEmailView = (AutoCompleteTextView) solo.getView(R.id.email);
        mPasswordView = (EditText) solo.getView(R.id.password);
        mEmailSignInButton = (Button) solo.getView(R.id.email_sign_in_button);

        //Login
        solo.waitForActivity("LoginActivity");
        solo.assertCurrentActivity("Check on first Activity", LoginActivity.class);

        solo.enterText(mEmailView, String.valueOf("user@test.com"));
        solo.enterText(mPasswordView, String.valueOf("password"));

        solo.clickOnView(mEmailSignInButton);
        solo.assertCurrentActivity("Expected activity HomeActivity", HomeActivity.class);

        //Create event
        createEventButton = (Button) solo.getView(R.id.create_event);
        solo.clickOnView(createEventButton);
        solo.assertCurrentActivity("Check on first EventDetailsActivity", EventDetailsActivity.class);

        eventName = (EditText) solo.getView(R.id.event_name);
        eventCity = (EditText) solo.getView(R.id.event_city);
        eventDescription = (EditText) solo.getView(R.id.event_description);
        eventLocation = (EditText) solo.getView(R.id.event_location);

        solo.enterText(eventName, String.valueOf("Party Hardy"));
        solo.enterText(eventCity, String.valueOf("Winnipeg"));
        solo.enterText(eventLocation, String.valueOf("1234 Potato Lane"));
        solo.enterText(eventDescription, String.valueOf("This is a pretty cool event and you should come."));

        submitButton = (Button) solo.getView(R.id.submit_event);
        solo.clickOnView(submitButton);

        solo.assertCurrentActivity("Expected activity EventDetailsActivity", EventDetailsActivity.class);
    }

    @Override
    public void tearDown() throws Exception
    {
        solo.finishOpenedActivities();
    }
}
