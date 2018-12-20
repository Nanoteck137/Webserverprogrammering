<?php

abstract class ErrorType {
    const UNKNOWN = "UNKNOWN";

    //MySQL
    CONST MYSQL_QUERY_FAILED = "MYSQL_QUERY_FAILED";

    //change_password.php
    const CHPWD_OLD_PASSWORD_NOT_SET = "CHPWD_OLD_PASSWORD_NOT_SET";
    const CHPWD_NEW_PASSWORD_NOT_SET = "CHPWD_NEW_PASSWORD_NOT_SET";
    const CHPWD_CONFIRM_PASSWORD_NOT_SET = "CHPWD_CONFIRM_PASSWORD_NOT_SET";
    const CHPWD_PASSWORD_NOT_MATCH = "CHPWD_CONFIRM_PASSWORD_NOT_SET";
    const CHPWD_NEW_PASSWORD_NOT_MATCH = "CHPWD_NEW_PASSWORD_NOT_MATCH";

    //login.php
    const LOGIN_WRONG_PASSWORD = "LOGIN_WRONG_PASSWORD";
}


class MyError {
    private $type = NULL;

    public function __construct(string $type) {
        if($type !== NULL || strlen($type) > 0) {
            $this->type = $type;
        } else {
            $this->type = ErrorType::UNKNOWN;
        }
    }

    public function get_type() {
        return $this->type;
    }
}

?>