package com.partez.acceptance;

import junit.framework.Test;
import junit.framework.TestCase;
import junit.framework.TestSuite;

/**
 * Created by nick on 3/18/2016.
 */
public class RunAcceptanceTests extends TestCase {

    public static TestSuite suite;

    public static Test suite()
    {
        suite = new TestSuite("Unit tests");
        suite.addTestSuite(AcceptanceTest.class);

        return suite;
    }
}
