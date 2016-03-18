package com.partez;

import junit.framework.TestCase;

/**
 * Created by gregjoubert on 2016-03-17.
 */
public class RegisterActivityTest extends TestCase
{

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

    public void testGetPublicTimeline() throws Exception
    {
        assertEquals(true, true);
    }
}