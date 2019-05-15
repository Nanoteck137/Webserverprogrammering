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
    uProfilePicture varchar(128) NOT NULL DEFAULT 'default_pic.png'
);

CREATE TABLE forum_posts (
    ID int(8) PRIMARY KEY AUTO_INCREMENT,
    title VARCHAR(64) NOT NULL,
    content mediumtext NOT NULL,
    author int(8),
    FOREIGN KEY(author) REFERENCES users(uID),
    created_date datetime NOT NULL default CURRENT_TIMESTAMP,
    upvotes INT(4) DEFAULT 0,
    downvotes INT(4) DEFAULT 0
);

CREATE TABLE forum_comments (
    ID int(8) PRIMARY KEY AUTO_INCREMENT,
    forum_id int(8),
    FOREIGN KEY(forum_id) REFERENCES forum_posts(ID),
    content mediumtext NOT NULL,
    author int(8),
    FOREIGN KEY(author) REFERENCES users(uID),
    created_date datetime NOT NULL default CURRENT_TIMESTAMP,
    upvotes int(4),
    downvotes int(4)
);

INSERT INTO users (uName, uUsername, uEmail, uPassword, uBirthdate, uUserType) VALUES
    ("Patrik Millvik", "Nanoteck137", "patrik.millvik@gmail.com", "testpass", "2001-01-02", "admin"),
    ("Wooh", "Test", "test@gmail.com", "wooh", "2004-04-04", "member");

INSERT INTO forum_posts(title, content, author) VALUES 
    ("Hello World", "This is a test", 1),
    ("Hello", "Test 2", 1),
    ("World", "Test 3", 2),
    ("Testing", "Test 4", 2);

INSERT INTO forum_comments(forum_id, content, author) VALUES 
    (1, "Test Comment", 2),
    (1, "Test Comment2", 2),
    (1, "Test Comment3", 1),
    (2, "Test Comment4", 1),
    (2, "Test Comment5", 1),
    (2, "Test Comment6", 2);