<?php

class AuthUserNotFoundException extends Exception {}

class AuthUser
{
    public $database;

    public $id;
    public $name;
    public $username;
    public $email;
    public $password;
    public $birthdate;
    public $createdDate;
    public $type;
    public $signature;
    public $profilePicture;

    public function __construct(Database $database,
                                int $id,
                                string $name, 
                                string $username, 
                                string $email, 
                                string $password,
                                string $birthdate, 
                                string $createdDate,
                                string $type,
                                string $signature,
                                string $profilePicture) 
    {
        $this->database = $database;
        $this->id = $id;
        $this->name = $name;
        $this->username = $username;
        $this->email = $email;
        $this->password = $password;
        $this->birthdate = $birthdate;
        $this->createdDate = $createdDate;
        $this->type = $type;
        $this->signature = $signature;
        $this->profilePicture = $profilePicture;
    }

    public static function CreateFromRow($database, $row): AuthUser
    {
        return new AuthUser(
            $database,
            $row["uID"],
            $row["uName"],
            $row["uUsername"],
            $row["uEmail"],
            $row["uPassword"],
            $row["uBirthdate"],
            $row["uCreatedDate"],
            $row["uUserType"],
            $row["uSignature"],
            $row["uProfilePicture"]
        );
    }
}

class Auth
{
    public $database;

    public function __construct(Database $database) 
    {
        $this->database = $database;
    }

    // Creates a new user in the database (Register a user)
    public function CreateUser(string $name, 
                                string $username, 
                                string $email, 
                                string $password, 
                                string $birthdate)
    {

    }

    // Gets a user from the database by the id
    public function GetUserById(int $id): ?AuthUser
    {
        $query = "SELECT * FROM users WHERE uID=$id";
        try {
            $result = $this->database->Query($query);
            
            if($result->GetNumRows() === 1) 
            {
                $row = $result->GetRow(0);
                return AuthUser::CreateFromRow($this->database, $row);
            } 
            else 
            {
                throw new AuthUserNotFoundException("User not found with id '$id'");
            }
        } 
        catch(Exception $e) 
        {
            throw new AuthUserNotFoundException("User not found with id '$id'");
        }

        return null;
    }

    // Gets a user from the database by the username
    public function GetUserByUsername(string $username): ?AuthUser
    {
        $query = "SELECT * FROM users WHERE uUsername='$username'";
        try {
            $result = $this->database->Query($query);
            
            if($result->GetNumRows() === 1) 
            {
                $row = $result->GetRow(0);
                return AuthUser::CreateFromRow($this->database, $row);
            } 
            else 
            {
                throw new AuthUserNotFoundException("User not found with id '$id'");
            }
        } 
        catch(Exception $e) 
        {
            throw new AuthUserNotFoundException("User not found with id '$id'");
        }

        return null;
    }
    // Gets a user from the database by the email
    public function GetUserByEmail(string $email): ?AuthUser
    {
        $query = "SELECT * FROM users WHERE uEmail='$email'";
        try {
            $result = $this->database->Query($query);
            
            if($result->GetNumRows() === 1) 
            {
                $row = $result->GetRow(0);
                return AuthUser::CreateFromRow($this->database, $row);
            } 
            else 
            {
                throw new AuthUserNotFoundException("User not found with id '$id'");
            }
        } 
        catch(Exception $e) 
        {
            throw new AuthUserNotFoundException("User not found with id '$id'");
        }

        return null;
    }

    // Gets the current logged in user
    public function GetLoggedInUser(): ?AuthUser 
    {

    }

    // Log a user in
    public function Login(AuthUser $user) 
    {
        $_SESSION["valid_login"] = true;
        $_SESSION["user_id"] = $user->id;
    }

    // Logout the current user
    public function Logout() 
    {
        session_unset();
        session_destroy();
    }
}

?>