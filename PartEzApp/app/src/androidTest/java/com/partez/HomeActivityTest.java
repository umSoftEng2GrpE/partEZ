package com.partez;

import android.test.ActivityInstrumentationTestCase2;
import android.util.Log;
import android.widget.Toast;

import com.google.gson.Gson;
import com.loopj.android.http.AsyncHttpClient;
import com.loopj.android.http.AsyncHttpResponseHandler;
import com.loopj.android.http.JsonHttpResponseHandler;
import com.loopj.android.http.RequestParams;
import com.partez.DataWrapper.Result;
import com.partez.DataWrapper.SearchResponse;
import com.partez.DataWrapper.User;
import junit.framework.TestCase;
import junit.framework.TestCase;

import org.json.JSONArray;
import org.json.JSONObject;

import java.util.ArrayList;
import java.util.Arrays;
import java.util.concurrent.CountDownLatch;
import java.util.concurrent.TimeUnit;

import cz.msebera.android.httpclient.Header;

/**
 * Created by gregjoubert on 2016-03-17.
 */
public class HomeActivityTest extends ActivityInstrumentationTestCase2<HomeActivity>
{
    private static final String TAG = "HomeActivityTest";
    public HomeActivityTest()
    {
        super(HomeActivity.class);
    }

    public void setUp() throws Exception
    {
        super.setUp();
    }

    public void tearDown() throws Exception
    {

    }

    public void testGetHomeInfo() throws Exception
    {
        HomeActivity homeActivity = new HomeActivity();
        assert(homeActivity.getHomeInfo());
    }

    public void testGetUserInfo() throws Exception
    {
        HomeActivity homeActivity = new HomeActivity();
        assert(homeActivity.getUserInfo());
    }

    public void testPrepareListData() throws Exception
    {
        String str = "{\n" +
                "  \"user_events\": [\n" +
                "    {\n" +
                "      \"eid\": 13,\n" +
                "      \"uid\": \"19\",\n" +
                "      \"name\": \"Event Private\",\n" +
                "      \"location\": \"Some location\",\n" +
                "      \"description\": \"\",\n" +
                "      \"date\": \"03/11/2016\",\n" +
                "      \"stime\": \"\",\n" +
                "      \"etime\": \"\",\n" +
                "      \"created_at\": \"2016-03-10 23:15:14\",\n" +
                "      \"updated_at\": \"2016-03-10 23:15:14\",\n" +
                "      \"public\": \"0\",\n" +
                "      \"city\": \"\"\n" +
                "    },\n" +
                "    {\n" +
                "      \"eid\": 21,\n" +
                "      \"uid\": \"19\",\n" +
                "      \"name\": \"another different event\",\n" +
                "      \"location\": \"house\",\n" +
                "      \"description\": \"Work party!!!\",\n" +
                "      \"date\": \"02/10/2016\",\n" +
                "      \"stime\": \"2:00am\",\n" +
                "      \"etime\": \"2:00am\",\n" +
                "      \"created_at\": \"2016-03-18 01:05:50\",\n" +
                "      \"updated_at\": \"2016-03-18 01:05:50\",\n" +
                "      \"public\": \"1\",\n" +
                "      \"city\": \"\"\n" +
                "    },\n" +
                "    {\n" +
                "      \"eid\": 33,\n" +
                "      \"uid\": \"19\",\n" +
                "      \"name\": \"Postmanevent\",\n" +
                "      \"location\": \"house\",\n" +
                "      \"description\": \"Work party!!!\",\n" +
                "      \"date\": \"02/10/2016\",\n" +
                "      \"stime\": \"2:00am\",\n" +
                "      \"etime\": \"2:00am\",\n" +
                "      \"created_at\": \"2016-03-18 04:28:20\",\n" +
                "      \"updated_at\": \"2016-03-18 04:28:20\",\n" +
                "      \"public\": \"1\",\n" +
                "      \"city\": \"\"\n" +
                "    },\n" +
                "    \"invited_events\": [],\n" +
                "  \"public_events\": [\n" +
                "    {\n" +
                "      \"eid\": 7,\n" +
                "      \"uid\": \"1\",\n" +
                "      \"name\": \"deploytest\",\n" +
                "      \"location\": \"amazon\",\n" +
                "      \"description\": \"test deploy\",\n" +
                "      \"date\": \"02/08/2016\",\n" +
                "      \"stime\": \"11:30pm\",\n" +
                "      \"etime\": \"12:00am\",\n" +
                "      \"created_at\": \"2016-02-27 04:46:31\",\n" +
                "      \"updated_at\": \"2016-02-27 04:46:42\",\n" +
                "      \"public\": \"1\",\n" +
                "      \"city\": \"\"\n" +
                "    }";
        ArrayList<Result> resultArray = new ArrayList<>();
        Gson gson = new Gson();
        SearchResponse searchResponse = new SearchResponse();//gson.fromJson(str, SearchResponse.class);
        searchResponse.user_events = resultArray;
        searchResponse.public_events = resultArray;
        searchResponse.invited_events = resultArray;
        HomeActivity homeActivity = new HomeActivity();
        int result = homeActivity.prepareListData(searchResponse);
        assertEquals(true, result == 0);
    }
    public void testGetPublicTimeline() throws Throwable {
        final CountDownLatch signal = new CountDownLatch(1);
        final AsyncHttpClient httpClient = new AsyncHttpClient();
        final StringBuilder strBuilder = new StringBuilder();

        runTestOnUiThread(new Runnable() { // THIS IS THE KEY TO SUCCESS
            @Override
            public void run() {
                RequestParams params = new RequestParams();
                String token = "eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJzdWIiOjEsImlzcyI6Imh0dHA6XC9cL2VjMi01NC04NC0xNzYtMjIuY29tcHV0ZS0xLmFtYXpvbmF3cy5jb21cL2FwaVwvYXV0aGVudGljYXRlIiwiaWF0IjoxNDU4Mjc1ODAxLCJleHAiOjE0NTgyNzk0MDEsIm5iZiI6MTQ1ODI3NTgwMSwianRpIjoiYTg5NWE3ZTc4MjU5NDg5ZWU0ZTQ2NDBkMTQ4YWY0ZTEifQ.kYKLRjh-kkhFSVDGU4KhwiHKbv3wm3Rf5V9RALVCIsk";
                PartezRestClient.postCred("api_home", params, token, new JsonHttpResponseHandler() {
                    @Override
                    public void onSuccess(int statusCode, Header[] headers, JSONObject response) {
                        strBuilder.append(response);
                    }

                    public void onFinish() {
                        signal.countDown();
                    }

                    @Override
                    public void onFailure(int statusCode, Header[] headers, Throwable e, JSONObject response) {
                        // called when response HTTP status is "4XX" (eg. 401, 403, 404)
                        strBuilder.append(response);
                    }
                });


                try {
                    signal.await(30, TimeUnit.SECONDS); // wait for callback
                } catch (InterruptedException e) {
                    e.printStackTrace();
                }


                try {
                    JSONObject jsonRes = new JSONObject(strBuilder.toString());
                    // Test your jsonResult here
                    assertEquals(true, strBuilder.toString().contains("token"));
                    Log.d(TAG, strBuilder.toString());
                } catch (Exception e) {

                }
//                assertEquals(0, signal.getCount());
            }
        });
    }

    public void testGetUserInfoRequest() throws Throwable
    {
        final CountDownLatch signal = new CountDownLatch(1);
        final AsyncHttpClient httpClient = new AsyncHttpClient();
        final StringBuilder strBuilder = new StringBuilder();

        runTestOnUiThread(new Runnable() { // THIS IS THE KEY TO SUCCESS
            @Override
            public void run() {
                RequestParams params = new RequestParams();
                String token =  "eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJzdWIiOjEsImlzcyI6Imh0dHA6XC9cL2VjMi01NC04NC0xNzYtMjIuY29tcHV0ZS0xLmFtYXpvbmF3cy5jb21cL2FwaVwvYXV0aGVudGljYXRlIiwiaWF0IjoxNDU4Mjc1ODAxLCJleHAiOjE0NTgyNzk0MDEsIm5iZiI6MTQ1ODI3NTgwMSwianRpIjoiYTg5NWE3ZTc4MjU5NDg5ZWU0ZTQ2NDBkMTQ4YWY0ZTEifQ.kYKLRjh-kkhFSVDGU4KhwiHKbv3wm3Rf5V9RALVCIsk";
                PartezRestClient.getCred("api_home", params, token, new JsonHttpResponseHandler() {
                    @Override
                    public void onSuccess(int statusCode, Header[] headers, JSONObject response) {
                        strBuilder.append(response);
                    }

                    public void onFinish() {
                        signal.countDown();
                    }

                    @Override
                    public void onFailure(int statusCode, Header[] headers, Throwable e, JSONObject response) {
                        // called when response HTTP status is "4XX" (eg. 401, 403, 404)
                        strBuilder.append(response);
                    }
                });


                try {
                    signal.await(30, TimeUnit.SECONDS); // wait for callback
                } catch (InterruptedException e) {
                    e.printStackTrace();
                }


                try {
                    JSONObject jsonRes = new JSONObject(strBuilder.toString());
                    // Test your jsonResult here
                    assertEquals(true, strBuilder.toString().contains("token"));
                    Log.d(TAG, strBuilder.toString());
                } catch (Exception e) {

                }
//                assertEquals(0, signal.getCount());
            }
        });
    }
}