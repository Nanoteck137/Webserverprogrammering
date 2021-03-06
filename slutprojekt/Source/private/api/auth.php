<?php

class AuthUserNotFoundException extends Exception {}
class AuthUserNotLoggedInException extends Exception {}

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
    public $theme;

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
                                string $profilePicture,
                                string $theme) 
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
        $this->theme = $theme;
    }

    public function ChangePassword(string $oldPassword, string $newPassword): bool
    {
        $user_id = $this->id;

        $query = "SELECT * FROM users WHERE uID=$user_id AND uPassword='$oldPassword'";
        $result = $this->database->Query($query);

        if($result->GetNumRows() === 1)
        {
            $query = "UPDATE users SET uPassword='$newPassword' WHERE uID=$user_id";
            //TODO(patrik): Check for errors
            $this->database->Query($query);

            return true;
        }
        else 
        {
            return false;
        }
    }

    public function ChangeEmail(string $oldEmail, string $newEmail): bool
    {
        $user_id = $this->id;

        $query = "SELECT * FROM users WHERE uID=$user_id AND uEmail='$oldEmail'";
        $result = $this->database->Query($query);

        if($result->GetNumRows() === 1)
        {
            $query = "UPDATE users SET uEmail='$newEmail' WHERE uID=$user_id";
            //TODO(patrik): Check for errors
            $this->database->Query($query);

            return true;
        }
        else 
        {
            return false;
        }
    }

    public function ChangeTheme(string $theme) 
    {
        $userID = $this->id;
        $query = "UPDATE users SET uTheme='$theme' WHERE uID=$userID";
        $this->database->Query($query);
    }

    public function ChangeProfilePicture(string $fileName) 
    {
        $userID = $this->id;
        $query = "UPDATE users SET uProfilePicture='$fileName' WHERE uID=$userID";
        $this->database->Query($query);
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
            $row["uProfilePicture"],
            $row["uTheme"]
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
                throw new AuthUserNotFoundException("User not found with id '$username'");
            }
        } 
        catch(Exception $e) 
        {
            throw new AuthUserNotFoundException("User not found with id '$username'");
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
                throw new AuthUserNotFoundException("User not found with id '$email'");
            }
        } 
        catch(Exception $e) 
        {
            throw new AuthUserNotFoundException("User not found with id '$email'");
        }

        return null;
    }

    public function GetLoggedInUserId(): int
    {
        return $_SESSION["user_id"];
    }

    // Gets the current logged in user
    public function GetLoggedInUser(): ?AuthUser 
    {
        if($this->IsUserLoggedIn()) 
        {
            return $this->GetUserById($this->GetLoggedInUserId());
        } 
        else 
        {
            throw new AuthUserNotLoggedInException("The user is not logged in");
        }

        return null;
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

    public function IsUserLoggedIn()
    {
        return isset($_SESSION["valid_login"]) && $_SESSION["valid_login"] === true;
    }

    public function RedirectNotLoggedin(string $page = "login.php") 
    {
        if(!$this->IsUserLoggedIn())
        {
            header("location: $page");
            exit();
        }
    }
}

?>