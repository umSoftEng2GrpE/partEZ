package com.partez;

import android.annotation.TargetApi;
import android.os.Build;
import android.os.Bundle;
import android.support.design.widget.FloatingActionButton;
import android.support.design.widget.Snackbar;
import android.support.v7.app.AppCompatActivity;
import android.support.v7.widget.Toolbar;
import android.util.Log;
import android.view.View;
import android.widget.DatePicker;
import android.widget.EditText;
import android.widget.RadioButton;
import android.widget.TimePicker;
import android.widget.Toast;

import com.google.gson.JsonObject;
import com.loopj.android.http.JsonHttpResponseHandler;
import com.loopj.android.http.RequestParams;

import org.json.JSONArray;
import org.json.JSONException;
import org.json.JSONObject;

import java.util.Arrays;

import cz.msebera.android.httpclient.Header;
import cz.msebera.android.httpclient.entity.ByteArrayEntity;

public class EventDetailsActivity extends AppCompatActivity {

    private static final String TAG = "EventActivity";

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_event_details);
    }

    @TargetApi(Build.VERSION_CODES.M)
    public void submitEvent(View view) throws JSONException {
        String token = "Missing Token";
        Bundle extras = getIntent().getExtras();

        if (extras != null)
        {
            token = extras.getString("token");
        }

        RequestParams params = new RequestParams();

        // LinkedHashMap event = new LinkedHashMap();
        JsonObject json = new JsonObject();

        JSONArray jsonArray = new JSONArray();
        JSONObject outerJson = new JSONObject();
        JSONObject event = new JSONObject();

        String name   = ((EditText)findViewById(R.id.event_name)).getText().toString();
        String location   = ((EditText)findViewById(R.id.event_location)).getText().toString();
        String description   = ((EditText)findViewById(R.id.event_description)).getText().toString();

        DatePicker datePicker = ((DatePicker)findViewById(R.id.event_date));
        String eventDate = datePicker.getDayOfMonth() + "/" + datePicker.getMonth() + "/" + datePicker.getYear();

        TimePicker stimePicker = ((TimePicker)findViewById(R.id.stime_picker));
        String stime = stimePicker.getHour() + ":" + stimePicker.getMinute();

        TimePicker etimePicker = ((TimePicker)findViewById(R.id.etime_picker));
        String etime = etimePicker.getHour() + ":" + etimePicker.getMinute();

        Boolean isPublic = ((RadioButton)findViewById(R.id.public_event)).isActivated();
        String publicEvent = isPublic ? "1" : "0";

        event.put("name", name);
        event.put("location", location);
        event.put("description", description);
        event.put("date", eventDate);
        event.put("stime", stime);
        event.put("etime", etime);
        event.put("public", publicEvent);

        jsonArray.put(event);
        outerJson.put("event", event);
        ByteArrayEntity entity = new ByteArrayEntity(outerJson.toString().getBytes());

        PartezRestClient.postEntity(getApplicationContext(), "api_submit_event", token, entity, new JsonHttpResponseHandler() {
            @Override
            public void onSuccess(int statusCode, Header[] headers, JSONObject response) {
                // If the response is JSONObject instead of expected JSONArray
                Log.d(TAG, Arrays.toString(headers));
                Log.d(TAG, Integer.toString(statusCode));

                Toast.makeText(getApplicationContext(), "Success Object", Toast.LENGTH_SHORT).show();
            }

            @Override
            public void onSuccess(int statusCode, Header[] headers, JSONArray timeline) {
                // Do something with the response
                Log.d(TAG, Arrays.toString(headers));
                Log.d(TAG, Integer.toString(statusCode));

                Toast.makeText(getApplicationContext(), "Success Array", Toast.LENGTH_SHORT).show();
            }

            @Override
            public void onFailure(int statusCode, Header[] headers, Throwable e, JSONObject response) {
                // called when response HTTP status is "4XX" (eg. 401, 403, 404)
                Log.d(TAG, Arrays.toString(headers));
                Log.d(TAG, Integer.toString(statusCode));
                Log.d(TAG, response.toString());
                Toast.makeText(getApplicationContext(), "Failure", Toast.LENGTH_SHORT).show();
            }

            @Override
            public void onFailure(int statusCode, Header[] headers, String someString, Throwable e) {
                // called when response HTTP status is "4XX" (eg. 401, 403, 404)
                Log.d(TAG, Arrays.toString(headers));
                Log.d(TAG, Integer.toString(statusCode));
                Toast.makeText(getApplicationContext(), "Created Event", Toast.LENGTH_SHORT).show();
            }
        });
    }
}
