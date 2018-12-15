DROP DATABASE website;

CREATE DATABASE website;
USE website;

CREATE TABLE users(
    id INT(8) PRIMARY KEY AUTO_INCREMENT,
    user_name VARCHAR(15) NOT NULL UNIQUE,
    user_password VARCHAR(255) NOT NULL,
    user_email VARCHAR(32) NOT NULL UNIQUE,
    user_type ENUM("admin", "member") DEFAULT "member" NOT NULL,
    user_theme INT(2) NOT NULL DEFAULT 1
);

INSERT INTO users (user_name, user_password, user_email, user_type, user_theme) VALUES ("admin", "test", "admin@admin.com", "admin", 2);
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

CREATE TABLE themes(
    id INT(8) PRIMARY KEY AUTO_INCREMENT,
    theme_name VARCHAR(32) NOT NULL,
    theme_content MEDIUMTEXT NOT NULL
);

INSERT INTO themes(theme_name, theme_content) VALUES ("dark", '{"primary":{"color":{"normal":"#263238","light":"#4f5b62","dark":"#000a12"},"on":{"normal":"#ffffff","light":"#ffffff","dark":"#ffffff"}},"secondary":{"color":{"normal":"#0d47a1","light":"#5472d3","dark":"#002171"},"on":{"normal":"#ffffff","light":"#000000","dark":"#ffffff"}}}');
INSERT INTO themes(theme_name, theme_content) VALUES ("orange", '{"primary":{"color":{"normal":"#ffcc80","light":"#ffffb0","dark":"#ca9b52"},"on":{"normal":"#000000","light":"#000000","dark":"#ffffff"}},"secondary":{"color":{"normal":"#ff6e40","light":"#ffa06d","dark":"#c53d13"},"on":{"normal":"#000000","light":"#000000","dark":"#ffffff"}}}');