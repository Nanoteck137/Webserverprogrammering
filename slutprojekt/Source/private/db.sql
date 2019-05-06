DROP DATABASE stackunderflow;
CREATE DATABASE stackunderflow;
USE stackunderflow;

CREATE TABLE users(
    ID int(8) PRIMARY KEY AUTO_INCREMENT,
    name varchar (32) NOT NULL,
    username varchar (64) NOT NULL,
    email varchar (64) NOT NULL,
    password varchar (64) NOT NULL,
    birthdate datetime NOT NULL,
    created_date datetime NOT NULL default CURRENT_TIMESTAMP,
    user_type ENUM ('member', 'moderator', 'admin') NOT NULL DEFAULT 'member',
    signature varchar (32),
    profile_picture varchar(128) NOT NULL DEFAULT 'default_pic.png'
);

CREATE TABLE forum_posts (
    ID int(8) PRIMARY KEY AUTO_INCREMENT,
    title VARCHAR(64) NOT NULL,
    content mediumtext NOT NULL,
    author int(8),
    FOREIGN KEY(author) REFERENCES users(ID),
    created_date datetime NOT NULL default CURRENT_TIMESTAMP,
    upvotes INT(4) DEFAULT 0,
    downvotes INT(4) DEFAULT 0
);

INSERT INTO users (name, username, email, password, birthdate, user_type) VALUES
    ("Patrik Millvik", "Nanoteck137", "patrik.millvik@gmail.com", "testpass", "2001-01-02", "admin"),
    ("Wooh", "Test", "test@gmail.com", "wooh", "2004-04-04", "normal");

INSERT INTO forum_posts(title, content, author) VALUES 
    ("Hello World", "This is a test", 1),
    ("Hello", "Test 2", 1),
    ("World", "Test 3", 2),
    ("Testing", "Test 4", 2);