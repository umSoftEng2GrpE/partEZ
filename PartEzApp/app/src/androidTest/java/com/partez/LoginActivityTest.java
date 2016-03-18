package com.partez;

import android.test.ActivityInstrumentationTestCase2;
import android.util.Log;

import com.loopj.android.http.AsyncHttpClient;
import com.loopj.android.http.JsonHttpResponseHandler;
import com.loopj.android.http.RequestParams;

import junit.framework.TestCase;

import org.json.JSONObject;

import java.util.concurrent.CountDownLatch;
import java.util.concurrent.TimeUnit;

import cz.msebera.android.httpclient.Header;

/**
 * Created by gregjoubert on 2016-03-17.
 */
public class LoginActivityTest extends ActivityInstrumentationTestCase2<LoginActivity>
{
    private static final String TAG = "LoginActivityTest";
    public LoginActivityTest()
    {
        super(LoginActivity.class);
    }


    public void setUp() throws Exception
    {
        super.setUp();

    }

    public void tearDown() throws Exception
    {

    }

    public void testOnCreate() throws Exception
    {

    }

    public void testPopulateAutoComplete() throws Exception
    {

    }

    public void testMayRequestContacts() throws Exception
    {

    }

    public void testOnRequestPermissionsResult() throws Exception
    {

    }

    public void testAttemptLogin() throws Exception
    {

    }

    public void testIsEmailValid() throws Exception
    {
        LoginActivity loginActivity = new LoginActivity();
        assertEquals(true, loginActivity.isEmailValid("user@test.com"));
    }

    public void testIsEmailValid2() throws Exception
    {
        LoginActivity loginActivity = new LoginActivity();
        assertEquals(false, loginActivity.isPasswordValid("a"));

    }

    public void testIsPasswordValid() throws Exception
    {
        LoginActivity loginActivity = new LoginActivity();
        assertEquals(false, loginActivity.isPasswordValid("a"));
    }

    public void testIsPasswordValid2() throws Exception
    {
        LoginActivity loginActivity = new LoginActivity();
        assertEquals(true, loginActivity.isPasswordValid("password"));
    }

    public void testShowProgress() throws Exception
    {

    }

    public void testOnCreateLoader() throws Exception
    {

    }

    public void testOnLoadFinished() throws Exception
    {

    }

    public void testOnLoaderReset() throws Exception
    {

    }

    public void testAddEmailsToAutoComplete() throws Exception
    {

    }
    public void testGetPublicTimeline() throws Throwable {
        final CountDownLatch signal = new CountDownLatch(1);
        final AsyncHttpClient httpClient = new AsyncHttpClient();
        final StringBuilder strBuilder = new StringBuilder();

        runTestOnUiThread(new Runnable()
        { // THIS IS THE KEY TO SUCCESS
            @Override
            public void run()
            {
                RequestParams params = new RequestParams();
                params.put("email", "user@test.com");
                params.put("password", "password");
                PartezRestClient.post("authenticate", params, new JsonHttpResponseHandler()
                {
                    @Override
                    public void onSuccess(int statusCode, Header[] headers, JSONObject response)
                    {
                        strBuilder.append(response);
                    }

                    public void onFinish()
                    {
                        signal.countDown();
                    }

                    @Override
                    public void onFailure(int statusCode, Header[] headers, Throwable e, JSONObject response)
                    {
                        // called when response HTTP status is "4XX" (eg. 401, 403, 404)
                        strBuilder.append(response);
                    }
                });


                try
                {
                    signal.await(30, TimeUnit.SECONDS); // wait for callback
                }
                catch (InterruptedException e)
                {
                    e.printStackTrace();
                }


                try
                {
                    JSONObject jsonRes = new JSONObject(strBuilder.toString());
                    // Test your jsonResult here
                    assertEquals(true, strBuilder.toString().contains("token"));
                    Log.d(TAG, strBuilder.toString());
                } catch (Exception e)
                {

                }
//                assertEquals(0, signal.getCount());
            }
        });
    }
}