# Forum

## NOTES

### CSS Background Variables
primary-background-color
primary-background-color-light
primary-background-color-dark

primary-background-color-on
primary-background-color-light-on
primary-background-color-dark-on

secondary-background-color
secondary-background-color-light
secondary-background-color-dark

secondary-background-color-on
secondary-background-color-light-on
secondary-background-color-dark-on

big-logo-container-color
light-placeholder-color

## TODO List

- [ ] Refactor all the code
    - [ ] CSS
    - [ ] HTML
    - [ ] PHP

- [ ] Refactor the theme settings
    - [ ] CSS Variables names
    - [ ] Fix background-color color on some elemnets (themes)

- [ ] forum.php: forum-search-bar margin on the sides
- [ ] forum.php: Search bar in desktop view
- [ ] Uniform text input style
- [ ] Uniform button style
- [ ] New post container needs a border

- [ ] view_profile.php: Sorting button not working

- [ ] Fix popups (Click on the side to close it)

- [ ] Tablet view

- [ ] Fix the logo

- [ ] Profile menu when theres one item

- [ ] common/forum.css: Change the error color to a variable
- [x] forum.php: Change the create new post icon to an font awesome icon 
- [ ] view_post.php: Modal for deleting the post

### Checklist

#### Client Side

- [x] Mobile View
    - [x] Structure
        - [x] Header
        - [x] Footer
        
- [ ] Tablet View
    - [ ] Structure
        - [ ] Header
        - [ ] Footer

- [x] Desktop View
    - [x] Structure
        - [x] Header
        - [x] Footer

- [ ] Pages
    - [ ] Home
        - [ ] View popular forum posts
    -  [x] Login and Register
        - [x] Form for Login
        - [x] Form for Register
    - [x] Forum (Posts)
        - [x] Create new post
        - [x] View all posts
        - [x] View a single post
    - [x] View Post
        - [x] View post content
        - [x] View all post comments and child comments
        - [x] Create new comments
        - [x] Click on profile name to get a users info
    - [x] View Profile
        - [x] View the user info (Username, Creation Date, Number of posts, Number of comments and more...) 
    - [x] Settings
        - [x] Change the theme (Light and Dark)
        - [x] If the user if logged they can change the password
    - [ ] About us
        - [ ] Just info

#### Server Side
- [x] Login System
- [x] View Forum Posts
- [x] Create Forum Post

- [ ] Special features for admin and mod users

- [ ] Pages
    - [ ] Home
        - [ ] View popular forum posts
    - [x] Login and Register
        - [x] Hook up to the database
        - [x] Form for Login
        - [x] Form for Register
    - [ ] Forum (Posts)
        - [x] Hook up to the database
        - [x] Create new post
        - [x] View all posts
        - [x] View a single post
    - [x] View Post
        - [x] Hook up to the database
        - [x] View post content
        - [x] View all post comments and child comments
        - [x] Create new comments
        - [x] Click on profile name to get a users info
    - [ ] View Profile
        - [ ] Hook up to the database
        - [ ] View the user info (Username, Creation Date, Number of posts, Number of comments and more...) 
    - [x] Settings
        - [x] Hook up to the database
        - [x] Change the theme (Light and Dark)
        - [x] If the user if logged they can change the password
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

### SQL Code

### 
```sql
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
// Auth API

$database = new Database();
// Regular Query -> DatabaseResult
$result = $database->Query("SELECT * FROM some_table");
// Prepared Statements Query -> DatabaseStatement
$stmt = $database->PrepareQuery("SELECT * FROM some_table");

$stmt->BindParamters();
$stmt->Execute();

$auth = new Auth($database);

// Create User -> AuthUser
$user = $auth->CreateUser(...);
$auth->GetUserById(1);
$auth->GetUserByUsername("Testuser");

$auth->RedirectNotLoggedIn("login.php");

$auth->Login($user);

$forum = new Forum();

$posts = $forum->GetAllPosts();
$post = $forum->GetPostById(1);

$post->GetComments();
$post->GetCommentsByUser($user);

$forum->GetAllCommentsByUser($user);

```
---