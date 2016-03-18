package com.partez;

import junit.framework.Test;
import junit.framework.TestCase;
import junit.framework.TestSuite;

/**
 * Created by nick on 3/18/2016.
 */
public class RunUnitTests extends TestCase {

    public static TestSuite suite;

    public static Test suite()
    {
        suite = new TestSuite("Unit tests");
        suite.addTestSuite(HomeActivityTest.class);
        suite.addTestSuite(LoginActivityTest.class);
        suite.addTestSuite(RegisterActivityTest.class);

        return suite;
    }
}
