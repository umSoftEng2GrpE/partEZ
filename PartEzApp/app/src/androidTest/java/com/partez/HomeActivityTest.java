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
        ArrayList<Result> resultArray;
        Gson gson = new Gson();
        SearchResponse searchResponse = gson.fromJson(str, SearchResponse.class);
        HomeActivity homeActivity = new HomeActivity();
        int result = homeActivity.prepareListData(searchResponse);
        assertEquals(true, result == 0);
    }
}