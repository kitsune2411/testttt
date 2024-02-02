<?php
include_once "DB.php";
class Auth extends DB
{
    public function doLogin($email, $password, $remember_me = false)
    {
        $usrmail = $this->connect()->real_escape_string($email); //sanitize
        $passwd = md5($this->connect()->real_escape_string($password)); //sanitize
        $remember = $remember_me;
        $user = $this->query("SELECT * from user WHERE email = '$usrmail' AND password = '$passwd'");

        if ($user->num_rows <= 0) return $_SESSION['error'] = "email/password salah";
        $user_data = $user->fetch_assoc();

        $_SESSION['status'] = "login";
        $_SESSION["id_user"] = $user_data['id'];
        $_SESSION["email"] = $email;
        if ($remember == "1" || $remember == "on") {
            $_SESSION["remember"] = true;
        }

        unset($_SESSION["error"]);

        header("location: index.php");
    }
}
