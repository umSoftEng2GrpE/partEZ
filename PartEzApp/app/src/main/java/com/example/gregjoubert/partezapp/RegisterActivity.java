package com.example.gregjoubert.partezapp;

import android.animation.Animator;
import android.animation.AnimatorListenerAdapter;
import android.annotation.TargetApi;
import android.app.Activity;
import android.content.Intent;
import android.os.Build;
import android.os.Bundle;
import android.text.TextUtils;
import android.view.View;
import android.widget.AutoCompleteTextView;
import android.widget.Button;
import android.widget.EditText;
import android.widget.TextView;
import android.widget.Toast;

import com.loopj.android.http.JsonHttpResponseHandler;
import com.loopj.android.http.RequestParams;

import org.json.JSONArray;
import org.json.JSONException;
import org.json.JSONObject;

import cz.msebera.android.httpclient.Header;

/**
 * Created by gregjoubert on 2016-03-07.
 */


public class RegisterActivity extends Activity
{
    private static final String TAG = "RegisterActivity";

    // UI references.
    private AutoCompleteTextView mEmailView;
    private EditText mFirstNameView;
    private EditText mLastNameView;
    private EditText mPasswordView;
    private EditText mConfirmPasswordView;
    private View mProgressView;
    private View mRegisterFormView;

    @Override
    public void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        // Set View to register.xml
        setContentView(R.layout.register);

        mFirstNameView = (EditText) findViewById(R.id.reg_Firstname);
        mLastNameView = (EditText) findViewById(R.id.reg_Lastname);
        mEmailView = (AutoCompleteTextView) findViewById(R.id.reg_email);
        mPasswordView = (EditText) findViewById(R.id.reg_password);
        mConfirmPasswordView = (EditText) findViewById(R.id.confirm_password);

        TextView loginScreen = (TextView) findViewById(R.id.link_to_login);
        // Listening to Login Screen link
        loginScreen.setOnClickListener(new View.OnClickListener()
        {
            public void onClick(View arg0)
            {
                // Closing registration screen
                // Switching to Login Screen/closing register screen
                finish();
            }
        });

        Button mEmailSignInButton = (Button) findViewById(R.id.btnRegister);
        mEmailSignInButton.setOnClickListener(new View.OnClickListener()
        {
            @Override
            public void onClick(View view)
            {
                attemptRegister();
            }
        });

        mRegisterFormView = findViewById(R.id.register_form);
        mProgressView = findViewById(R.id.register_progress);

    }


    /**
     * Shows the progress UI and hides the register form.
     */
    @TargetApi(Build.VERSION_CODES.HONEYCOMB_MR2)
    private void showProgress(final boolean show)
    {
        // On Honeycomb MR2 we have the ViewPropertyAnimator APIs, which allow
        // for very easy animations. If available, use these APIs to fade-in
        // the progress spinner.
        if (Build.VERSION.SDK_INT >= Build.VERSION_CODES.HONEYCOMB_MR2)
        {
            int shortAnimTime = getResources().getInteger(android.R.integer.config_shortAnimTime);

            mRegisterFormView.setVisibility(show ? View.GONE : View.VISIBLE);
            mRegisterFormView.animate().setDuration(shortAnimTime).alpha(
                    show ? 0 : 1).setListener(new AnimatorListenerAdapter()
            {
                @Override
                public void onAnimationEnd(Animator animation)
                {
                    mRegisterFormView.setVisibility(show ? View.GONE : View.VISIBLE);
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
            mRegisterFormView.setVisibility(show ? View.GONE : View.VISIBLE);
        }
    }

    private void attemptRegister()
    {
        boolean proceed = checkForValidInput();

        if (proceed)
        {
            showProgress(true);

            RequestParams params = new RequestParams();
            params.put("firstname", mFirstNameView.getText().toString());
            params.put("lastname", mLastNameView.getText().toString());
            params.put("email", mEmailView.getText().toString());
            params.put("password", mPasswordView.getText().toString());

            try
            {
                getPublicTimeline(params);
            } catch (Exception e)
            {
                e.getStackTrace();
            }
        }
    }

    private boolean checkForValidInput()
    {
        // Reset errors.
        mFirstNameView.setError(null);
        mLastNameView.setError(null);
        mEmailView.setError(null);
        mPasswordView.setError(null);
        mPasswordView.setError(null);
        mConfirmPasswordView.setError(null);

        // Store values at the time of the register attempt.
        String firstName = mFirstNameView.getText().toString();
        String lastName = mLastNameView.getText().toString();
        String email = mEmailView.getText().toString();
        String password = mPasswordView.getText().toString();
        String confirmPassword = mConfirmPasswordView.getText().toString();

        boolean proceed = true;
        View focusView = null;

        // Check for a valid password, if the user entered one.
        if (!TextUtils.isEmpty(password) && !isPasswordValid(password))
        {
            mPasswordView.setError(getString(R.string.error_invalid_password));
            focusView = mPasswordView;
            proceed = false;
        }
        if (!TextUtils.isEmpty(confirmPassword) && !confirmPassword.equals(password))
        {
            mConfirmPasswordView.setError(getString(R.string.error_password_different));
            focusView = mConfirmPasswordView;
            proceed = false;
        }

        if (TextUtils.isEmpty(firstName))
        {
            mFirstNameView.setError(getString(R.string.error_field_required));
            focusView = mFirstNameView;
            proceed = false;
        }
        if (TextUtils.isEmpty(lastName))
        {
            mLastNameView.setError(getString(R.string.error_field_required));
            focusView = mLastNameView;
            proceed = false;
        }

        // Check for a valid email address.
        if (TextUtils.isEmpty(email))
        {
            mEmailView.setError(getString(R.string.error_field_required));
            focusView = mEmailView;
            proceed = false;
        } else if (!isEmailValid(email))
        {
            mEmailView.setError(getString(R.string.error_invalid_email));
            focusView = mEmailView;
            proceed = false;
        }

        if(!proceed)
        {
            focusView.requestFocus();
        }

        return proceed;
    }

    public void getPublicTimeline(RequestParams params) throws JSONException
    {
        PartezRestClient.post("register", params, new JsonHttpResponseHandler()
        {
            @Override
            public void onSuccess(int statusCode, Header[] headers, JSONObject response)
            {
                // If the response is JSONObject instead of expected JSONArray
                showProgress(false);
                Toast.makeText(getApplicationContext(), "Success", Toast.LENGTH_SHORT).show();

                try
                {
                    Intent intent = new Intent(getApplicationContext(), HomeActivity.class);
                    intent.putExtra("token", response.getString("token"));
                    startActivity(intent);
                } catch (JSONException error)
                {
                    error.getStackTrace();
                    Toast.makeText(getApplicationContext(), "Failure to login, Account Created", Toast.LENGTH_LONG).show();
                }
            }

            @Override
            public void onSuccess(int statusCode, Header[] headers, JSONArray timeline)
            {
                // Do something with the response
                showProgress(false);
                Toast.makeText(getApplicationContext(), "Success", Toast.LENGTH_SHORT).show();
            }

            @Override
            public void onFailure(int statusCode, Header[] headers, Throwable e, JSONObject response)
            {
                // called when response HTTP status is "4XX" (eg. 401, 403, 404)
                showProgress(false);
                Toast.makeText(getApplicationContext(), "Failure", Toast.LENGTH_SHORT).show();
            }
        });
    }

    private boolean isEmailValid(String email)
    {
        //TODO: Replace this with your own logic
        return email.contains("@");
    }

    private boolean isPasswordValid(String password)
    {
        //TODO: Replace this with your own logic
        return password.length() > 4;
    }
}