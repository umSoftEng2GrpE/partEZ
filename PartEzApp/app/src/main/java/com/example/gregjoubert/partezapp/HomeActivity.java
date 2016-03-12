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
import android.widget.TextView;
import android.widget.Toast;
import com.loopj.android.http.JsonHttpResponseHandler;
import com.loopj.android.http.RequestParams;
import org.json.JSONArray;
import org.json.JSONException;
import org.json.JSONObject;

import java.util.Arrays;

import cz.msebera.android.httpclient.Header;

/**
 * Created by gregjoubert on 2016-03-08.
 */

public class HomeActivity extends Activity
{
    private static final String TAG = "HomeActivity";
    private View mProgressView;
    private View mHomeFormView;

    @Override
    public void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        // Set View to register.xml
        setContentView(R.layout.home);


        mHomeFormView = findViewById(R.id.home_form);
        mProgressView = findViewById(R.id.home_progress);

        String value = "Missing Token";
        Bundle extras = getIntent().getExtras();

        if (extras != null)
        {
            value = extras.getString("token");
        }

        getHomeInfo(value);

    }

    private void getHomeInfo(String token)
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
                Log.d(TAG, Integer.toString(statusCode) );
                Log.d(TAG,response.toString());
                Toast.makeText(getApplicationContext(), "Failure", Toast.LENGTH_SHORT).show();
            }
        });
    }

    @TargetApi(Build.VERSION_CODES.HONEYCOMB_MR2)
    private void showProgress(final boolean show)
    {
        // On Honeycomb MR2 we have the ViewPropertyAnimator APIs, which allow
        // for very easy animations. If available, use these APIs to fade-in
        // the progress spinner.
        if (Build.VERSION.SDK_INT >= Build.VERSION_CODES.HONEYCOMB_MR2)
        {
            int shortAnimTime = getResources().getInteger(android.R.integer.config_shortAnimTime);

            mHomeFormView.setVisibility(show ? View.GONE : View.VISIBLE);
            mHomeFormView.animate().setDuration(shortAnimTime).alpha(
                    show ? 0 : 1).setListener(new AnimatorListenerAdapter()
            {
                @Override
                public void onAnimationEnd(Animator animation)
                {
                    mHomeFormView.setVisibility(show ? View.GONE : View.VISIBLE);
                }
            });

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
            mHomeFormView.setVisibility(show ? View.GONE : View.VISIBLE);
        }
    }

}
