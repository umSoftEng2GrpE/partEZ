package com.partez.acceptance;
import android.test.ActivityInstrumentationTestCase2;
import android.widget.AutoCompleteTextView;
import android.widget.*;

import junit.framework.Assert;

import com.partez.HomeActivity;
import com.partez.LoginActivity;
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
        solo.waitForActivity("LoginActivity");
        solo.assertCurrentActivity("Check on first Activity", LoginActivity.class);

        EditText mEmailView = (AutoCompleteTextView) solo.getView(R.id.email);
        solo.enterText(mEmailView, String.valueOf("user@test.com"));

        EditText mPasswordView = (EditText) solo.getView(R.id.password);
        solo.enterText(mPasswordView, String.valueOf("password"));

        Button mEmailSignInButton = (Button) solo.getView(R.id.email_sign_in_button);
        solo.clickOnView(mEmailSignInButton);

        solo.sleep(3000);
        solo.assertCurrentActivity("Expected activity HomeActivity", HomeActivity.class);
    }

    @Override
    public void tearDown() throws Exception
    {
        solo.finishOpenedActivities();
    }
}
