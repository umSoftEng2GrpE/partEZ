package com.partez;

import android.animation.Animator;
import android.animation.AnimatorListenerAdapter;
import android.annotation.TargetApi;
import android.app.Activity;
import android.content.Intent;
import android.os.Build;
import android.os.Bundle;
import android.util.Log;
import android.view.View;
import android.widget.Button;
import android.widget.ExpandableListView;
import android.widget.Toast;

import com.partez.DataWrapper.Result;
import com.partez.DataWrapper.SearchResponse;
import com.google.gson.Gson;
import com.loopj.android.http.JsonHttpResponseHandler;
import com.loopj.android.http.RequestParams;
import org.json.JSONArray;
import org.json.JSONException;
import org.json.JSONObject;

import java.util.ArrayList;
import java.util.Arrays;
import java.util.HashMap;
import java.util.List;

import cz.msebera.android.httpclient.Header;

/**
 * Created by gregjoubert on 2016-03-08.
 */

public class HomeActivity extends Activity
{
    private static final String TAG = "HomeActivity";
    private View mProgressView;
    private String token;
    private String userEmail;
    private SearchResponse searchResponse;

    ExpandableListAdapter listAdapter;
    ExpandableListView expListView;
    List<String> listDataHeader;
    HashMap<String, List<Result>> listDataChild;

    @Override
    public void onCreate(Bundle savedInstanceState)
    {
        super.onCreate(savedInstanceState);
        // Set View to register.xml
        setContentView(R.layout.home);
//        setContentView(R.layout.activity_main);

        mProgressView = findViewById(R.id.home_progress);

        token = "Missing Token";
        Bundle extras = getIntent().getExtras();

        if (extras != null)
        {
            token = extras.getString("token");
            userEmail = extras.getString("user_email");
            Log.d(TAG ,token);
            Log.d(TAG ,userEmail);
        }

        Button createEventButton = (Button) findViewById(R.id.create_event);
        createEventButton.setOnClickListener(new View.OnClickListener()
        {
            @Override
            public void onClick(View view)
            {
                createEvent();
            }
        });

        getUserInfo();


    }

    public void createEvent()
    {
//        Intent intent = new Intent(getApplicationContext(), EventDetailsActivity.class);
//        intent.putExtra("token", token);
//        startActivity(intent);
        Toast.makeText(getApplicationContext(), getBaseContext().getString(R.string.create_event), Toast.LENGTH_SHORT).show();

    }

    protected void getHomeInfo()
    {
        showProgress(true);
        RequestParams params = new RequestParams();
        try
        {
            getPublicTimeline(params, token);
        }
        catch (Exception e)
        {
            e.getStackTrace();
        }
    }

    public void getPublicTimeline(RequestParams params, String token) throws JSONException
    {
        PartezRestClient.postCred("api_home", params, token, new JsonHttpResponseHandler()
        {
            @Override
            public void onSuccess(int statusCode, Header[] headers, JSONObject response)
            {
                // If the response is JSONObject instead of expected JSONArray
                showProgress(false);
                Log.d(TAG, response.toString());
                Gson gson = new Gson();
                searchResponse = gson.fromJson(response.toString(), SearchResponse.class);

//                if (!searchResponse.array.isEmpty())
//                {
//                    for (Result result : searchResponse.array)
//                    {
//                        Log.d(TAG, result.toString());
//                    }
//                } else
//                {
//                    Log.d(TAG, "empty arraylist");
//                }

                createScreen(response);
            }

            @Override
            public void onSuccess(int statusCode, Header[] headers, JSONArray timeline)
            {
                // Do something with the response
                showProgress(false);
            }

            @Override
            public void onFailure(int statusCode, Header[] headers, Throwable e, JSONObject response)
            {
                // called when response HTTP status is "4XX" (eg. 401, 403, 404)
                showProgress(false);
                Log.d(TAG, Arrays.toString(headers));
                Log.d(TAG, Integer.toString(statusCode));
                Log.d(TAG, response.toString());
                Toast.makeText(getApplicationContext(), "Failure", Toast.LENGTH_SHORT).show();
            }
        });
    }

    public void getUserInfo()
    {
        RequestParams params = new RequestParams();
        try
        {
            getUserInfoRest(params);
        }
        catch (Exception e)
        {
            e.getStackTrace();
        }

    }

    protected void getUserInfoRest(RequestParams params) throws JSONException
    {
        PartezRestClient.getCred("authenticate", params, token, new JsonHttpResponseHandler()
        {
            @Override
            public void onSuccess(int statusCode, Header[] headers, JSONObject response)
            {
                // If the response is JSONObject instead of expected JSONArray
                Log.d(TAG, response.toString());
                showProgress(false);
            }

            @Override
            public void onSuccess(int statusCode, Header[] headers, JSONArray response)
            {
                // Do something with the response
                Log.d(TAG, response.toString());


                getHomeInfo();
            }

            @Override
            public void onFailure(int statusCode, Header[] headers, Throwable e, JSONObject response)
            {
                // called when response HTTP status is "4XX" (eg. 401, 403, 404)
                showProgress(false);
                Log.d(TAG, "GetonFailure JSONArray");
                Log.d(TAG, Arrays.toString(headers));
                Log.d(TAG, Integer.toString(statusCode));
                Log.d(TAG, response.toString());
                Toast.makeText(getApplicationContext(), "Failure", Toast.LENGTH_SHORT).show();
            }
        });
    }

    @TargetApi(Build.VERSION_CODES.HONEYCOMB_MR2)
    protected void showProgress(final boolean show)
    {
        // On Honeycomb MR2 we have the ViewPropertyAnimator APIs, which allow
        // for very easy animations. If available, use these APIs to fade-in
        // the progress spinner.
        if (Build.VERSION.SDK_INT >= Build.VERSION_CODES.HONEYCOMB_MR2)
        {
            int shortAnimTime = getResources().getInteger(android.R.integer.config_shortAnimTime);

            mProgressView.setVisibility(show ? View.VISIBLE : View.GONE);
            mProgressView.animate().setDuration(shortAnimTime).alpha(
                    show ? 1 : 0).setListener(new AnimatorListenerAdapter()
            {
                @Override
                public void onAnimationEnd(Animator animation)
                {
                    mProgressView.setVisibility(show ? View.VISIBLE : View.GONE);
                }
            });
        } else
        {
            // The ViewPropertyAnimator APIs are not available, so simply show
            // and hide the relevant UI components.
            mProgressView.setVisibility(show ? View.VISIBLE : View.GONE);
        }
    }

    protected void createScreen(JSONObject response)
    {
        // get the listview
        expListView = (ExpandableListView) findViewById(R.id.lvExp);

        // preparing list data
        setOnClickListeners();
        prepareListData(searchResponse);

        listAdapter = new ExpandableListAdapter(this, listDataHeader, listDataChild);

        // setting list adapter
        expListView.setAdapter(listAdapter);
    }

    protected int prepareListData(SearchResponse searchResponse)
    {
        listDataHeader = new ArrayList<String>();
        listDataChild = new HashMap<String, List<Result>>();

        // Adding child data
        listDataHeader.add("My Events");
        listDataHeader.add("Invited Events");
        listDataHeader.add("Public Events");

        // Adding child data
        List<Result> myEvents = new ArrayList<>();

        for (Result result : searchResponse.user_events)
        {
            myEvents.add(result);
        }

        List<Result> invitedEvents = new ArrayList<>();
        for (Result result : searchResponse.invited_events)
        {
            invitedEvents.add(result);
        }

        List<Result> publicEvents = new ArrayList<>();
        for (Result result : searchResponse.public_events)
        {
            publicEvents.add(result);
        }

        listDataChild.put(listDataHeader.get(0), myEvents); // Header, Child data
        listDataChild.put(listDataHeader.get(1), invitedEvents);
        listDataChild.put(listDataHeader.get(2), publicEvents);

        return myEvents.size();
    }

    protected void setOnClickListeners()
    {
        // Listview on child click listener
        expListView.setOnChildClickListener(new ExpandableListView.OnChildClickListener()
        {

            @Override
            public boolean onChildClick(ExpandableListView parent, View v,
                                        int groupPosition, int childPosition, long id)
            {
                Result eventToPass = listDataChild.get(listDataHeader.get(groupPosition)).get(childPosition);
                Intent intent = new Intent(getApplicationContext(), EventActivity.class);
                intent.putExtra("eventToPass",eventToPass);
                startActivity(intent);
                return false;
            }
        });
        // Listview Group expanded listener
        expListView.setOnGroupExpandListener(new ExpandableListView.OnGroupExpandListener()
        {

            @Override
            public void onGroupExpand(int groupPosition)
            {
                Toast.makeText(getApplicationContext(),
                        listDataHeader.get(groupPosition) + " Expanded",
                        Toast.LENGTH_SHORT).show();
            }
        });
        // Listview Group collasped listener
        expListView.setOnGroupCollapseListener(new ExpandableListView.OnGroupCollapseListener()
        {

            @Override
            public void onGroupCollapse(int groupPosition)
            {
                Toast.makeText(getApplicationContext(),
                        listDataHeader.get(groupPosition) + " Collapsed",
                        Toast.LENGTH_SHORT).show();

            }
        });
    }
}
