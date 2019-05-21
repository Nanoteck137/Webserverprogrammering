DROP DATABASE stackunderflow;
CREATE DATABASE stackunderflow;
USE stackunderflow;

CREATE TABLE users(
    uID int(8) PRIMARY KEY AUTO_INCREMENT,
    uName varchar (32) NOT NULL,
    uUsername varchar (64) NOT NULL,
    uEmail varchar (64) NOT NULL,
    uPassword varchar (64) NOT NULL,
    uBirthdate datetime NOT NULL,
    uCreatedDate datetime NOT NULL default CURRENT_TIMESTAMP,
    uUserType ENUM ('member', 'moderator', 'admin') NOT NULL DEFAULT 'member',
    uSignature varchar(32) DEFAULT "",
    uProfilePicture varchar(128) NOT NULL DEFAULT 'default_pic.png',
    uTheme ENUM('light', 'dark') NOT NULL DEFAULT 'light'
);

CREATE TABLE forum_posts (
    pID int(8) PRIMARY KEY AUTO_INCREMENT,
    pTitle varchar(64) NOT NULL,
    pContent mediumtext NOT NULL,
    
    pAuthor int(8),
    FOREIGN KEY(pAuthor) REFERENCES users(uID),

    pCreatedDate datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE forum_post_rate (
    upUser int(8),
    FOREIGN KEY(upUser) REFERENCES users(uID),

    upPost int(8),
    FOREIGN KEY(upPost) REFERENCES forum_posts(pID),

    upValue int(2)
);

CREATE TABLE forum_comments (
    cID int(8) PRIMARY KEY AUTO_INCREMENT,
    
    cPostID int(8),
    FOREIGN KEY(cPostID) REFERENCES forum_posts(pID),
    
    cContent mediumtext NOT NULL,
    
    cAuthor int(8),
    FOREIGN KEY(cAuthor) REFERENCES users(uID),

    cCreatedDate datetime NOT NULL default CURRENT_TIMESTAMP
);

INSERT INTO users (uName, uUsername, uEmail, uPassword, uBirthdate, uUserType) VALUES
    ("Patrik Millvik", "Nanoteck137", "patrik.millvik@gmail.com", "testpass", "2001-01-02", "admin"),
    ("Wooh", "Test", "test@gmail.com", "wooh", "2004-04-04", "member"),

    ("Jimmy Berglund", "BigHippo", "hippo@live.com", "testpass", STR_TO_DATE("2005-12-31", "%Y-%m-%d"), "admin"),
    ("Lars Strömberg", "kingminecraft", "mineking@yahoo.com", "testpass", STR_TO_DATE("1944-09-11", "%Y-%m-%d"), "admin"),
    ("Theodor Lindström", "lateMine", "latemine@elev.ga.ntig.se", "testpass", STR_TO_DATE("2016-06-08", "%Y-%m-%d"), "admin"),
    ("Frank Olsson", "finnanut", "nutting@hotmail.nu", "testpass", STR_TO_DATE("2007-04-20", "%Y-%m-%d"), "admin");

INSERT INTO forum_posts(pTitle, pContent, pAuthor) VALUES 
    ("Hello World", "This is a test", 1),
    ("Hello", "Test 2", 1),
    ("World", "Test 3", 2),
    ("Testing", "Test 4", 2);

INSERT INTO forum_comments(cPostID, cContent, cAuthor) VALUES 
    (1, "Test Comment", 2),
    (1, "Test Comment2", 2),
    (1, "Test Comment3", 1),
    (2, "Test Comment4", 1),
    (2, "Test Comment5", 1),
    (2, "Test Comment6", 2);