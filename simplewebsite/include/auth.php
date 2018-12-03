<?php
    abstract class UserType {
        const USER_TYPE_MEMBER = "member";
        const USER_TYPE_ADMIN = "admin";
    }

    class UserData {
        private $id = NULL;
        private $name = NULL;
        private $email = NULL;
        private $type = NULL;
        private $settings = NULL;

        public function __construct(string $id, string $name, string $email, string $type, $settings) {
            $this->id = $id;
            $this->name = $name;
            $this->email = $email;
            $this->type = $type;
            if($settings === null) {
                //TODO: Set this to a default value
                $this->settings = "";
            } else {
                $this->settings = $settings;
            }
        }

        public function get_id() {
            return $this->id;
        }

        public function get_user_name() {
            return $this->name;
        }

        public function get_email() {
            return $this->email;
        }

        public function get_type() {
            return $this->type;
        }

        public function get_settings() {
            return $this->settings;
        }
    }

    function is_logged_in() {
        return isset($_SESSION["valid_login"]) && $_SESSION["valid_login"] === true;
    }

    function get_user_id() {
        return $_SESSION["user_id"];
    }

    function get_user_data($dbc) {
        $user_id = get_user_id();

        $query = "SELECT * FROM users WHERE id=$user_id";
        $result = mysqli_query($dbc, $query);

        if (mysqli_num_rows($result) === 1) {
            $row = mysqli_fetch_array($result);
            
            $username = $row["user_name"];
            $email = $row["user_email"];
            $type = $row["user_type"];
            $settings = $row["user_settings"];
            
            return new UserData($user_id, $username, $email, $type, $settings);
        } else {
            return NULL;
        }
    }
?>