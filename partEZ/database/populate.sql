/*
 * Populate partEz database with test data
 */

USE partEz IF EXISTS partEz;


/*Insert some users*/
INSERT INTO users ( username, email, FBID, password )
VALUES ( 'delroyh', 'delroyh@email.com', 'myfacebookid', '1234' );

INSERT INTO users ( username, email, FBID, password )
VALUES ( 'bob', 'bob@email.com', 'bobfacebookid', '1234' );

INSERT INTO users ( username, email, FBID, password )
VALUES ( 'joe', 'joe@email.com', 'joefacebookid', '1234' );

INSERT INTO users ( username, email, FBID, password )
VALUES ( 'mary', 'mary@email.com', 'maryfacebookid', '1234' );

INSERT INTO users ( username, email, FBID, password )
VALUES ( 'alana', 'alana@email.com', 'alanafacebookid', '1234' );

/*Insert an event*/
INSERT INTO events ( uid, name, location, eventdate )
VALUES ( 1, 'Kick ass party', 'Yo mommas house', NOW() );

/*Insert some rsvps
 * 0 = invited, 1 = attending, 2 = not attending
*/
INSERT INTO userrsvps ( uid, eid, response )
VALUES ( 2, 1, 0);

INSERT INTO userrsvps ( uid, eid, response )
VALUES ( 3, 1, 1);

INSERT INTO userrsvps ( uid, eid, response )
VALUES ( 4, 1, 2);

INSERT INTO userrsvps ( uid, eid, response )
VALUES ( 5, 1, 1);