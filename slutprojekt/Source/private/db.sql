DROP DATABASE stackunderflow;
CREATE DATABASE stackunderflow;
USE stackunderflow;

CREATE TABLE users(
    ID int(8) PRIMARY KEY AUTO_INCREMENT,
    name varchar(32) NOT NULL,
    username varchar(64) NOT NULL,
    email varchar(64) NOT NULL,
    password varchar(64) NOT NULL,
    birthdate datetime NOT NULL,
    created_date datetime NOT NULL default CURRENT_TIMESTAMP,
    user_type ENUM('member', 'moderator', 'admin') NOT NULL DEFAULT 'member',
    signature varchar(32),
    profile_picture varchar(128) NOT NULL DEFAULT 'default_pic.png'
);

INSERT INTO users(name, username, email, password, birthdate, user_type) VALUES ("Patrik Millvik", "Nanoteck137", "patrik.millvik@gmail.com", "testpass", "2001-01-02", "admin");