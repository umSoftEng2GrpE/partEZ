package com.example.gregjoubert.partezapp;

import android.animation.Animator;
import android.animation.AnimatorListenerAdapter;
import android.annotation.TargetApi;
import android.app.Activity;
import android.content.Intent;
import android.os.Build;
import android.os.Bundle;
import android.text.TextUtils;
import android.util.Log;
import android.view.View;
import android.widget.Button;
import android.widget.ExpandableListView;
import android.widget.TextView;
import android.widget.Toast;

import com.example.gregjoubert.partezapp.DataWrapper.Result;
import com.example.gregjoubert.partezapp.DataWrapper.SearchResponse;
import com.google.gson.Gson;
import com.google.gson.GsonBuilder;
import com.google.gson.reflect.TypeToken;
import com.loopj.android.http.JsonHttpResponseHandler;
import com.loopj.android.http.RequestParams;
import org.json.JSONArray;
import org.json.JSONException;
import org.json.JSONObject;
import org.json.JSONTokener;

import java.lang.reflect.Type;
import java.util.ArrayList;
import java.util.Arrays;
import java.util.Collection;
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
    private View mHomeFormView;
    private String token;

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

//        mHomeFormView = findViewById(R.id.home_form);
        mProgressView = findViewById(R.id.home_progress);

        token = "Missing Token";
        Bundle extras = getIntent().getExtras();

        if (extras != null)
        {
            token = extras.getString("token");
            Log.d(TAG ,token);

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

        getHomeInfo(token);

    }

    public void createEvent()
    {
//        Intent intent = new Intent(getApplicationContext(), EventDetailsActivity.class);
//        intent.putExtra("token", token);
//        startActivity(intent);
        Toast.makeText(getApplicationContext(), getBaseContext().getString(R.string.create_event), Toast.LENGTH_SHORT).show();

    }

    private void getHomeInfo(String token)
    {
//        showProgress(true);
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
//                showProgress(false);
                createScreen(response);
            }

            @Override
            public void onSuccess(int statusCode, Header[] headers, JSONArray timeline)
            {
                // Do something with the response
//                showProgress(false);
            }

            @Override
            public void onFailure(int statusCode, Header[] headers, Throwable e, JSONObject response)
            {
                // called when response HTTP status is "4XX" (eg. 401, 403, 404)
//                showProgress(false);
                Log.d(TAG, Arrays.toString(headers));
                Log.d(TAG, Integer.toString(statusCode));
                Log.d(TAG, response.toString());
                Toast.makeText(getApplicationContext(), "Failure", Toast.LENGTH_SHORT).show();
            }
        });
    }

//    @TargetApi(Build.VERSION_CODES.HONEYCOMB_MR2)
//    private void showProgress(final boolean show)
//    {
//        // On Honeycomb MR2 we have the ViewPropertyAnimator APIs, which allow
//        // for very easy animations. If available, use these APIs to fade-in
//        // the progress spinner.
//        if (Build.VERSION.SDK_INT >= Build.VERSION_CODES.HONEYCOMB_MR2)
//        {
//            int shortAnimTime = getResources().getInteger(android.R.integer.config_shortAnimTime);
//
//            mHomeFormView.setVisibility(show ? View.GONE : View.VISIBLE);
//            mHomeFormView.animate().setDuration(shortAnimTime).alpha(
//                    show ? 0 : 1).setListener(new AnimatorListenerAdapter()
//            {
//                @Override
//                public void onAnimationEnd(Animator animation)
//                {
//                    mHomeFormView.setVisibility(show ? View.GONE : View.VISIBLE);
//                }
//            });
//
//            mProgressView.setVisibility(show ? View.VISIBLE : View.GONE);
//            mProgressView.animate().setDuration(shortAnimTime).alpha(
//                    show ? 1 : 0).setListener(new AnimatorListenerAdapter()
//            {
//                @Override
//                public void onAnimationEnd(Animator animation)
//                {
//                    mProgressView.setVisibility(show ? View.VISIBLE : View.GONE);
//                }
//            });
//        } else
//        {
//            // The ViewPropertyAnimator APIs are not available, so simply show
//            // and hide the relevant UI components.
//            mProgressView.setVisibility(show ? View.VISIBLE : View.GONE);
//            mHomeFormView.setVisibility(show ? View.GONE : View.VISIBLE);
//        }
//    }

    private void createScreen(JSONObject response)
    {
        Log.d(TAG ,response.toString());

        Gson gson = new Gson();
        SearchResponse searchResponse = gson.fromJson(response.toString(), SearchResponse.class);

        if(!searchResponse.array.isEmpty())
        {
            for (Result result : searchResponse.array)
            {
                Log.d(TAG , result.toString());
            }
        }
        else
        {
            Log.d(TAG , "empty arraylist");
        }

        // get the listview
        expListView = (ExpandableListView) findViewById(R.id.lvExp);

        // preparing list data
        prepareListData(searchResponse.array);

        listAdapter = new ExpandableListAdapter(this, listDataHeader, listDataChild);

        // setting list adapter
        expListView.setAdapter(listAdapter);
    }

    /*
     * Preparing the list data
     */
    private void prepareListData(ArrayList<Result> resultArray)
    {
        setOnClickListeners();

        listDataHeader = new ArrayList<String>();
        listDataChild = new HashMap<String, List<Result>>();

        // Adding child data
        listDataHeader.add("My Events");
        listDataHeader.add("Invited Events");
        listDataHeader.add("Public Events");

        // Adding child data
        List<Result> myEvents = new ArrayList<>();

        for (Result result : resultArray)
        {
            myEvents.add(result);
        }

        List<Result> invitedEvents = new ArrayList<>();
//        for (Result result : resultArray)
//        {
//            Log.d(TAG , result.toString());
//            myEvents.add(result.name);
//        }

        List<Result> publicEvents = new ArrayList<>();
//        for (Result result : resultArray)
//        {
//            Log.d(TAG , result.toString());
//            myEvents.add(result.name);
//        }

        listDataChild.put(listDataHeader.get(0), myEvents); // Header, Child data
        listDataChild.put(listDataHeader.get(1), invitedEvents);
        listDataChild.put(listDataHeader.get(2), publicEvents);

    }

    private void setOnClickListeners()
    {
        // Listview on child click listener
        expListView.setOnChildClickListener(new ExpandableListView.OnChildClickListener()
        {

            @Override
            public boolean onChildClick(ExpandableListView parent, View v,
                                        int groupPosition, int childPosition, long id)
            {
                Toast.makeText(
                        getApplicationContext(),
                        listDataHeader.get(groupPosition)
                                + " : "
                                + (listDataChild.get(
                                listDataHeader.get(groupPosition)).get(
                                childPosition)).name
                                  , Toast.LENGTH_SHORT)
                        .show();
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
