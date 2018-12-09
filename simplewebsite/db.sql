DROP DATABASE website;

CREATE DATABASE website;
USE website;

CREATE TABLE users(
    id INT(8) PRIMARY KEY AUTO_INCREMENT,
    user_name VARCHAR(15) NOT NULL UNIQUE,
    user_password VARCHAR(255) NOT NULL,
    user_email VARCHAR(32) NOT NULL UNIQUE,
    user_type ENUM("admin", "member") DEFAULT "member" NOT NULL,
    user_theme_setting INT(2) DEFAULT 0 NOT NULL
);

INSERT INTO users (user_name, user_password, user_email, user_settings, user_type) VALUES ("admin", "test", "admin@admin.com", '{ "header": { "backgroundColor": "#FF00FF" }}', "admin");
INSERT INTO users (user_name, user_password, user_email) VALUES ("Nanoteck137", "wow", "nanoteck137@user.com");
INSERT INTO users (user_name, user_password, user_email) VALUES ("Wow", "lol", "wow@lol.com");

CREATE TABLE posts(
    id INT(8) PRIMARY KEY AUTO_INCREMENT,
    post_name VARCHAR(200) NOT NULL,
    post_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP NOT NULL,
    post_user_id INT(8),
    post_content MEDIUMTEXT NOT NULL,
    FOREIGN KEY (post_user_id) REFERENCES users(id)
);

INSERT INTO posts(post_name, post_content, post_user_id) VALUES ("Hello", "This is my post and this is <b>veri</b> good", 1);
INSERT INTO posts(post_name, post_content, post_user_id) VALUES ("Hell1o", "This is my <span style='color: green;'>post</span> and this is <b>veri</b> good", 2);
INSERT INTO posts(post_name, post_content, post_user_id) VALUES ("Hello123", "This is my post and this is <b>veri</b> good", 3);