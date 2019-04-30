# Forum

## TODO List

- [ ] Refactor all the code
    - [ ] CSS
    - [ ] HTML
    - [ ] PHP

### Checklist

#### Client Side

- [ ] Mobile View
    - [x] Structure
        - [x] Header
        - [x] Main
        - [x] Footer
        
- [ ] Tablet View
    - [ ] Structure
        - [ ] Header
        - [ ] Main
        - [ ] Footer

- [ ] Desktop View
    - [ ] Structure
        - [ ] Header
        - [ ] Main
        - [ ] Footer

- [ ] Pages
    - [ ] Home
        - [ ] View popular forum posts
    - [ ] Login and Register
        - [ ] Form for Login
        - [ ] Form for Register
    - [ ] Forum (Posts)
        - [ ] Create new post
        - [ ] View all posts
        - [ ] View a single post
    - [ ] View Post
        - [ ] View post content
        - [ ] View all post comments and child comments
        - [ ] Create new comments
        - [ ] Click on profile name to get a users info
    - [ ] View Profile
        - [ ] View the user info (Username, Creation Date, Number of posts, Number of comments and more...) 
    - [ ] Settings
        - [ ] Change the theme (Light and Dark)
        - [ ] If the user if logged they can change the password
    - [ ] About us
        - [ ] Just info

#### Server Side
- [ ] Login System
- [ ] View Forum Posts
- [ ] Create Forum Post
- [ ] Pages
    - [ ] Home
        - [ ] View popular forum posts
    - [ ] Login and Register
        - [ ] Hook up to the database
        - [ ] Form for Login
        - [ ] Form for Register
    - [ ] Forum (Posts)
        - [ ] Hook up to the database
        - [ ] Create new post
        - [ ] View all posts
        - [ ] View a single post
    - [ ] View Post
        - [ ] Hook up to the database
        - [ ] View post content
        - [ ] View all post comments and child comments
        - [ ] Create new comments
        - [ ] Click on profile name to get a users info
    - [ ] View Profile
        - [ ] Hook up to the database
        - [ ] View the user info (Username, Creation Date, Number of posts, Number of comments and more...) 
    - [ ] Settings
        - [ ] Hook up to the database
        - [ ] Change the theme (Light and Dark)
        - [ ] If the user if logged they can change the password
    - [ ] About us (No Server side??)

## Tables

Database Design:
![alt text](Design/pngs/Database.png "Database Design")

p = Primary Key<br>
f = Foreign Key<br>
a = Auto Increment<br>
c = Current Date

### User

| Col Name       | Type     | Enums              |
|----------------|----------|--------------------|
| Id             | Int(p,a) |                    |
| Name           | Varchar  |                    |
| Username       | Varchar  |                    |
| Email          | Varchar  |                    |
| Birthdate      | Datetime |                    |
| CreatedDate    | Datetime |                    |
| Type           | Enum     | Normal, Mod, Admin |
| Signature      | Datetime |                    |
| ProfilePicture | Varchar  |                    |



### Forum Post

| Col Name    | Type        | Foreign Key |
|-------------|-------------|-------------|
| Id          | Int(p,a)    |             |
| Title       | Varchar     |             |
| Content     | MediumText  |             |
| Author      | Int(f)      | Users       |
| CreatedDate | Datetime(c) |             |
| Upvotes     | Int         |             |
| Downvotes   | Int         |             |

### Forum Comment

| Col Name    | Type        | Foreign Key   |
|-------------|-------------|---------------|
| Id          | Int(p,a)    |               |
| ForumID     | Int(f)      | Forum Post    |
| Content     | Varchar     |               |
| Author      | Varchar     | Users         |
| CreatedDate | Datetime(c) |               |
| Upvotes     | Int         |               |
| Downvotes   | Int         |               |
| Parent      | Int(f)      | Forum Comment |

### SQL Code

### 
```sql
DROP DATABASE forum;
CREATE DATABASE forum;
USE forum;

CREATE TABLE user(
    ID int(8) PRIMARY KEY AUTO_INCREMENT,
    name varchar(32) NOT NULL,
    username varchar(64) NOT NULL,
    email varchar(64) NOT NULL,
    birthdate datetime NOT NULL,
    created_date datetime NOT NULL default CURRENT_TIMESTAMP,
    user_type ENUM('member', 'moderator', 'admin') NOT NULL DEFAULT 'member',
    signature varchar(32),
    profile_picture varchar(64) NOT NULL DEFAULT 'default_pic.png'
);

CREATE TABLE forum_post (
    ID int(8) PRIMARY KEY AUTO_INCREMENT,
    title VARCHAR(64) NOT NULL,
    content mediumtext NOT NULL,
    author int(8),
    FOREIGN KEY(author) REFERENCES user(ID),
    created_date datetime NOT NULL default CURRENT_TIMESTAMP,
    upvotes INT(4),
    downvotes INT(4)
);

CREATE TABLE forum_comments (
    ID int(8) PRIMARY KEY AUTO_INCREMENT,
    forum_id int(8),
    FOREIGN KEY(forum_id) REFERENCES forum_post(ID),
    content mediumtext NOT NULL,
    author int(8),
    FOREIGN KEY(author) REFERENCES user(ID),
    created_date datetime NOT NULL default CURRENT_TIMESTAMP,
    upvotes int(4),
    downvotes int(4),
    parent int(8)
);

ALTER TABLE forum_comments ADD FOREIGN KEY(parent) REFERENCES forum_comments(ID);
```
---

### Design (HTML/CSS)

#### Notes
Responsive (Mobile First)<br>
CSS Grid



#### Header
<blockquote>
Navigation<br>
<br>
More
</blockquote>

#### Content

#### Footer

```html
<h1>Wow</h1>
```
---

### Functionality (PHP)
```php
$wow = "Woow"
echo $wow;
```
---