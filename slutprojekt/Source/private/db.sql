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
    pTitle VARCHAR(64) NOT NULL,
    pContent mediumtext NOT NULL,
    
    pAuthor int(8),
    FOREIGN KEY(pAuthor) REFERENCES users(uID),

    pCreatedDate datetime NOT NULL default CURRENT_TIMESTAMP
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
    ("Wooh", "Test", "test@gmail.com", "wooh", "2004-04-04", "member");

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