DROP DATABASE website;

CREATE DATABASE website;
USE website;

CREATE TABLE users(
    id INT(8) PRIMARY KEY AUTO_INCREMENT,
    user_name VARCHAR(15) NOT NULL UNIQUE,
    user_password VARCHAR(255) NOT NULL,
    user_email VARCHAR(32) NOT NULL UNIQUE,
    user_type ENUM("admin", "member") DEFAULT "member" NOT NULL
);

INSERT INTO users(user_name, user_password, user_email, user_type) VALUES ("admin", "test", "admin@admin.com", "admin");