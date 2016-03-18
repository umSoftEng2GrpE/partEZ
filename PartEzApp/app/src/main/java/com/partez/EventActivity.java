package com.partez;

import android.os.Bundle;
import android.support.v7.app.AppCompatActivity;
import android.widget.TextView;

import com.partez.DataWrapper.Result;
import com.partez.R;

public class EventActivity extends AppCompatActivity {


    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        Result event = getIntent().getExtras().getParcelable("eventToPass");
        setContentView(R.layout.activity_event);
        TextView eventName = (TextView) findViewById(R.id.event_name);
        eventName.setText(event.name);
        TextView eventDate = (TextView) findViewById(R.id.event_date);
        eventDate.setText(event.date);
        TextView eventStartTime = (TextView) findViewById(R.id.event_start_time);
        eventStartTime.setText(event.stime);
        TextView eventEndTime = (TextView) findViewById(R.id.event_end_time);
        eventEndTime.setText(event.etime);
        TextView eventDescription = (TextView) findViewById(R.id.event_description);
        eventDescription.setText(event.description);
        TextView eventLocation = (TextView) findViewById(R.id.event_location);
        eventLocation.setText(event.location);
        TextView eventPrivacy = (TextView) findViewById(R.id.event_privacy);
        String privacy = "public";
        if(event.eventPublic.equals("0")){
            privacy = "private";
        }
        eventPrivacy.setText(privacy);
    }
}
