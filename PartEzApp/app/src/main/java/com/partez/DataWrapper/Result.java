package com.partez.DataWrapper;
import android.os.Parcel;
import android.os.Parcelable;

import com.google.gson.annotations.SerializedName;
/**
 * Created by gregjoubert on 2016-03-16.
 */

public class Result implements Parcelable {

    public String uid;
    public String stime;
    public String etime;
    public String location;
    public String description;
    public String name;
    public String date;
    public String eid;
    @SerializedName("public")
    public String eventPublic;
    @SerializedName("created_at")
    public String createdAt;
    @SerializedName("updated_at")
    public String updatedAt;

    @Override
    public String toString()
    {
        return  name;
    }
    public Result(Parcel in){
        String[] data = new String[11];
        in.readStringArray(data);
        this.uid = data[0];
        this.stime = data[1];
        this.etime = data[2];
        this.location = data[3];
        this.description = data[4];
        this.name = data[5];
        this.date = data[6];
        this.eid = data[7];
        this.eventPublic = data[8];
        this.createdAt = data[9];
        this.updatedAt = data[10];
    }

    @Override
    public int describeContents(){
        return 0;
    }

    @Override
    public void writeToParcel(Parcel dest, int flags){
        dest.writeStringArray(new String[]{this.uid,
                this.stime, this.etime, this.location,
                this.description, this.name, this.date,
                this.eid, this.eventPublic, this.createdAt,
                this.updatedAt});
    }

    public static final Parcelable.Creator CREATOR = new Parcelable.Creator() {
        public Result createFromParcel(Parcel in) {
            return new Result(in);
        }
        public Result[] newArray(int size){
            return new Result[size];
        }
    };

}
