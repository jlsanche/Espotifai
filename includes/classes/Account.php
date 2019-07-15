<?php

class Account
{
    private $con;
    private $errorArray;

    public function __construct($con)
    {
        $this->con = $con;
        $this->errorArray = array();
    }

    public function login($un, $pwd)
    {
        $pwd = md5($pwd);

        $query = mysqli_query($this->con, "SELECT * FROM users WHERE username='$un' AND password='$pwd'");
        if (mysqli_num_rows($query) == 1) {
            return true;
        } else {
            array_push($this->errorArray, Constants::$loginFailed);
            return false;
        }
    }

    public function register($un, $ln, $fn, $em, $em2, $pwd, $pwd2)
    {
        $this->validateUsername($un);
        $this->validateLastname($ln);
        $this->validateFirstname($fn);
        $this->validateEmails($em, $em2);
        $this->validatePasswords($pwd, $pwd2);

        if (empty($this->errorArray)) {
            //insert into db
            return $this->insertUserDetails($un, $ln, $fn, $em, $pwd);
        } else {
            return false;
        }
    }

    public function getError($error)
    {
        if (!in_array($error, $this->errorArray)) {
            $error = "";
        }
        return "<span class='errorMessage'>$error</span>";
    }

    private function insertUserDetails($un, $ln, $fn, $em, $pwd)
    {
        $encryptedPd = md5($pwd);
        $profilePic = "assets/images/profile-pics/head_emerald.png";
        $date = date("Y-m-d");

        $result = mysqli_query($this->con, "INSERT INTO users VALUES (NULL, '$un', '$ln', '$fn','$em','$encryptedPd', '$date', '$profilePic')");
        return $result;
    }

    private function validateUsername($un)
    {
        if (strlen($un) > 18 || strlen($un) < 5) {
            array_push($this->errorArray, Constants::$usernameCharacters);
            return;
        }

        //check if username exists
        $checkUsernameQuery = mysqli_query($this->con, "SELECT username FROM users WHERE username='$un'");
        if (mysqli_num_rows($checkUsernameQuery) != 0) {
            array_push($this->errorArray, Constants::$usernameTaken);
            return;
        }
    }

    private function validateFirstname($fn)
    {
        if (strlen($fn) > 25 || strlen($fn) < 2) {
            array_push($this->errorArray, Constants::$firstNameCharacters);
            return;
        }
    }

    private function validateLastname($ln)
    {
        if (strlen($ln) > 25 || strlen($ln) < 2) {
            array_push($this->errorArray, Constants::$lastNameCharacters);
            return;
        }
    }

    private function validateEmails($em, $em2)
    {
        if ($em != $em2) {
            array_push($this->errorArray, Constants::$emailsDontMatch);
            return;
        }

        if (!filter_var($em, FILTER_VALIDATE_EMAIL)) {
            array_push($this->errorArray, Constants::$emailIsInvalid);
            return;
        }

        //check that email is not already in use
        $checkEmailQuery = mysqli_query($this->con, "SELECT email FROM users WHERE email='$em'");
        if (mysqli_num_rows($checkEmailQuery) != 0) {
            array_push($this->errorArray, Constants::$emailTaken);
            return;
        }
    }

    private function validatePasswords($pw, $pw2)
    {
        if ($pw != $pw2) {
            array_push($this->errorArray, Constants::$passwordsDoNotMatch);
            return;
        }

        if (preg_match('/[^A-Za-z0-9]/', $pw)) {
            array_push($this->errorArray, Constants::$passwordNotAlphaNumeric);
            return;
        }

        if (strlen($pw) > 30 || strlen($pw) < 7) {
            array_push($this->errorArray, Constants::$passwordCharacters);
            return;
        }
    }
}
