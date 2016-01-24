/*
 * Initialize partEz database
 * WARNING: THIS SCRIPT WILL WIPE ANY EXISTING DATA
 */

/*This is the magic*/
CREATE DATABASE IF NOT EXISTS partEz;
USE partEz;

DROP TABLE IF EXISTS userpollresponses;
DROP TABLE IF EXISTS polloptions;
DROP TABLE IF EXISTS polls;
DROP TABLE IF EXISTS userrsvps;
DROP TABLE IF EXISTS events;
DROP TABLE IF EXISTS users;

CREATE TABLE users ( uid int NOT NULL AUTO_INCREMENT,
	username varchar(30) NOT NULL,
	email varchar(30) NOT NULL,
	FBID varchar(30) NOT NULL,
	password varchar(30) NOT NULL,
	PRIMARY KEY ( uid ),
	UNIQUE ( username, email, FBID ) );

CREATE TABLE events ( eid int NOT NULL AUTO_INCREMENT,
	uid int NOT NULL,
	name varchar(30),
	description varchar(50),
	location varchar(30),
	eventdate date,
	PRIMARY KEY ( eid, uid),
	FOREIGN KEY ( uid ) REFERENCES users ( uid ) ON DELETE CASCADE );

CREATE TABLE userrsvps ( uid int NOT NULL,
	eid int NOT NULL,
	response int NOT NULL,
	PRIMARY KEY ( uid, eid),
	FOREIGN KEY ( uid ) REFERENCES users ( uid ) ON DELETE CASCADE,
	FOREIGN KEY ( eid ) REFERENCES events ( eid ) ON DELETE CASCADE );

CREATE TABLE polls ( pid int NOT NULL AUTO_INCREMENT,
	eid int NOT NULL,
	ptype varchar(15),
	PRIMARY KEY ( pid, eid ),
	FOREIGN KEY ( eid ) REFERENCES events ( eid ) ON DELETE CASCADE );

CREATE TABLE polloptions ( pid int NOT NULL,
	optionid int NOT NULL,
	optiondate date,
	starttime date,
	endtime date,
	optioncount int,
	optioncustom varchar(30),
	PRIMARY KEY ( pid, optionid ),
	FOREIGN KEY ( pid ) REFERENCES polls ( pid ) ON DELETE CASCADE );

CREATE TABLE userpollresponses ( uid int NOT NULL,
	pid int NOT NULL,
	optionid int NOT NULL,
	pollresponse int, /*Really just a yes/no, 1/0, but couldn't remember if bool was built in*/
	PRIMARY KEY ( uid, pid, optionid ),
	FOREIGN KEY ( uid ) REFERENCES users ( uid ) ON DELETE CASCADE,
	FOREIGN KEY ( pid ) REFERENCES polls ( pid ) ON DELETE CASCADE );

