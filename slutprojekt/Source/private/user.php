<?php

class UserNotFoundException extends Exception {
    public function __construct(string $username)
    {
        parent::__construct("Could not find user $username");
    }
}

abstract class UserType
{
    const Normal = "normal";
    const Mod = "mod";
    const Admin = "admin";
}

class User 
{
    public $id;
    public $name;
    public $username;
    public $email;
    public $password;
    public $birthdate;
    public $created_date;
    public $type;
    public $signature;
    public $profile_picture;

    public function __construct(int $id,
                                string $name, 
                                string $username, 
                                string $email, 
                                string $password,
                                string $birthdate, 
                                string $created_date,
                                string $type,
                                string $signature,
                                string $profile_picture) 
    {
        $this->id = $id;
        $this->name = $name;
        $this->username = $username;
        $this->email = $email;
        $this->password = $password;
        $this->birthdate = $birthdate;
        $this->created_date = $created_date;
        $this->type = $type;
        $this->signature = $signature;
        $this->profile_picture = $profile_picture;
    }
}

/*function get_current_user_id(): int 
{
    return 0;
}

function get_user(int $id): User
{
    return null;
}*/

function get_user_from_username(mysqli $database, string $username): User
{
    //TODO(patrik): Use prepared statements
    $query = "SELECT * FROM users WHERE username LIKE '%$username%'";

    $result = $database->query($query);

    if($result->num_rows <= 0) 
    {
        throw new UserNotFoundException($username);
    } 
    else if($result->num_rows === 1) 
    {
        $row = $result->fetch_array();

        if($row["signature"] === NULL) 
        {
            $signature = "";
        } 
        else 
        {
            $signature = $row["signature"];
        }

        $result = new User($row["ID"], 
                            $row["name"],
                            $row["username"],
                            $row["email"], 
                            $row["password"], 
                            $row["birthdate"], 
                            $row["created_date"], 
                            $row["user_type"],
                            $signature, 
                            $row["profile_picture"]);
        return $result;
    } 
    else 
    {
        //TODO(patrik): Send the user to an error page (500 Server Error)
    }
}

/*function current_user() 
{
    return get_user(get_current_user_id());
}*/

function signin(User $user) 
{
    $_SESSION["valid_login"] = true;
    $_SESSION["user_id"] = $user->id;
}

function signout() 
{
    session_unset();
    session_destroy();
}

?>