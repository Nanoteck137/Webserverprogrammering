<?php

abstract class UserType
{
    const Normal = 0;
    const Mod = 1;
    const Admin = 2;
}

class User 
{
    public $name;
    public $username;
    public $email;
    public $password;
    public $birthdate;
    public $created_date;
    public $type;
    public $signature;
    public $profile_picture;

    public function __construct(string $name, 
                                string $username, 
                                string $email, 
                                string $password,
                                string $birthdate, 
                                string $created_date,
                                UserType $type,
                                string $signature,
                                string $profile_picture) 
    {
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

function get_current_user_id(): int 
{
    return 0;
}

function get_user(int $id) 
{
    return null;
}

function get_user_from_username(string $username) 
{

}

function current_user() 
{
    return get_user(get_current_user_id());
}

function signin(User $user) 
{

}

function signout() 
{

}

?>