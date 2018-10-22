CREATE DATABASE uppgift;

USE uppgift;

CREATE TABLE users (
    user_id INT(8) PRIMARY KEY AUTO_INCREMENT, 
    username VARCHAR(32) UNIQUE NOT NULL, 
    mail VARCHAR(32) UNIQUE NOT NULL,
    password VARCHAR(32) NOT NULL
    );