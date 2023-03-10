DROP DATABASE IF EXISTS notPinterest;
CREATE DATABASE notPinterest;
USE notPinterest;a

CREATE TABLE AppUser(
	userid int auto_increment,
    googleid varchar(255),
    githubid varchar(255),
    avatarurl varchar(255),
    username varchar(255),
    displayname varchar(255),
    primary key (userid)
);
CREATE TABLE Pins (
    pinid INT AUTO_INCREMENT,
    pintitle VARCHAR(60),
    pindesc VARCHAR(100),
    creatorid INT NOT NULL,
    websiteurl VARCHAR(60),
    imgurl VARCHAR(255) NOT NULL,
    ispublic BOOLEAN DEFAULT TRUE,
    PRIMARY KEY (pinid),
    FOREIGN KEY (creatorid)
        REFERENCES appuser (userid)
        ON DELETE CASCADE
);
CREATE TABLE Comments (
    commentid INT AUTO_INCREMENT,
    creatorid INT NOT NULL,
    content TEXT,
    PRIMARY KEY (commentid),
    FOREIGN KEY (creatorid)
        REFERENCES appuser (userid)
        ON DELETE CASCADE
);
CREATE TABLE Replies (
    replyid INT AUTO_INCREMENT,
    commentid INT NOT NULL,
    creatorid INT NOT NULL,
    replyto INT,
    PRIMARY KEY (replyid),
    FOREIGN KEY (commentid)
        REFERENCES comments (commentid),
    FOREIGN KEY (creatorid)
        REFERENCES appuser (userid)
        ON DELETE CASCADE
    FOREIGN KEY (replytO)
        REFERENCES appuser (userid)
        ON DELETE CASCADE
);
CREATE TABLE Likes (
    commentid INT NOT NULL,
    creatorid INT NOT NULL,
    FOREIGN KEY (commentid)
        REFERENCES comments (commentid)
        ON DELETE CASCADE,
    FOREIGN KEY (creatorid)
        REFERENCES appuser (userid)
        ON DELETE CASCADE
);
CREATE TABLE UserFollow(
	userid int not null,
    followerid int not null,
    foreign key (userid) references appuser(userid),
    foreign key (followerid) references appuser(userid)
);
CREATE TABLE SavedPins (
    pinid INT NOT NULL,
    saverid INT NOT NULL,
    FOREIGN KEY (pinid)
        REFERENCES pins (pinid),
    FOREIGN KEY (saverid)
        REFERENCES appuser (userid)
);
