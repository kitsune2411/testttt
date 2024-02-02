<?php
include_once "DB.php";
class Admin extends DB
{
    public function getAllUsers()
    {
        return $this->fetchAll("SELECT * FROM user");
    }
    public function getFilteredAllUsers($str)
    {
        return $this->fetchAll("SELECT * FROM user WHERE firstName like '%$str%' OR lastName like '%$str%' OR email like '%$str%'");
    }

    public function getUser($id)
    {
        return $this->fetchAll("SELECT * FROM user WHERE id = '$id'");
    }
    public function addUser($fname, $lname, $email, $bio, $pass)
    {
        if (isset($_SESSION["error"])) {
            if ($_SESSION["error"] == true) return false;
        }
        $lastId = $this->query("SELECT id FROM `user` WHERE id not like 'UD%' order by id DESC limit 1")->fetch_assoc();

        if ($lastId['id'] == null) {
            $id = 'U01';
        } else {
            $id =  ++$lastId['id'];
        }
        return $this->query("INSERT INTO user VALUES ('$id', '$fname', '$lname', '$email' , '$pass', '$bio')");
    }

    public function editUser($id, $fname, $lname, $bio,  $email)
    {
        return $this->query("UPDATE user SET firstName = '$fname', lastName = '$lname', email = '$email', bio = '$bio' WHERE id = '$id'");
    }
    public function delUser($id)
    {
        return $this->query("DELETE FROM user WHERE id = '$id'");
    }

    public function validateInput($photo, $fName, $lName, $email)
    {
        $_SESSION['error_message']  = '';
        if (empty($photo)) {
            $_SESSION['error'] = true;
            $_SESSION['error_message'] .= "<li>Foto tidak boleh kosong </li>";
        }
        if (empty($fName)) {
            $_SESSION['error'] = true;
            $_SESSION['error_message'] .= "<li>First Name tidak boleh kosong </li>";
        }
        if (empty($lName)) {
            $_SESSION['error'] = true;
            $_SESSION['error_message'] .= "<li>Last Name tidak boleh kosong </li>";
        }
        if (empty($email)) {
            $_SESSION['error'] = true;
            $_SESSION['error_message'] .= "<li>Email tidak boleh kosong </li>";
        }

        // $isEmailFormatValid = explode("@", $email);
        // if ($isEmailFormatValid[1] != "gmail.com" && $isEmailFormatValid[1] != "binus.ac.id") {
        // }
        $isEmailUnique = $this->query("SELECT * FROM user WHERE email = '$email' ");
        if ($isEmailUnique->num_rows > 0) {
            $_SESSION["error"] = true;
            $_SESSION["error_message"] .= "<li>Email telah terdaftar </li>";
        }
    }
    public function validateInputUpdate($photo, $fName, $lName, $email, $id)
    {
        $_SESSION['error_message']  = '';
        if (empty($photo)) {
            $_SESSION['error'] = true;
            $_SESSION['error_message'] .= "<li>Foto tidak boleh kosong </li>";
        }
        if (empty($fName)) {
            $_SESSION['error'] = true;
            $_SESSION['error_message'] .= "<li>First Name tidak boleh kosong </li>";
        }
        if (empty($lName)) {
            $_SESSION['error'] = true;
            $_SESSION['error_message'] .= "<li>Last Name tidak boleh kosong </li>";
        }
        if (empty($email)) {
            $_SESSION['error'] = true;
            $_SESSION['error_message'] .= "<li>Email tidak boleh kosong </li>";
        }

        // $isEmailFormatValid = explode("@", $email);
        // if ($isEmailFormatValid[1] != "gmail.com" && $isEmailFormatValid[1] != "binus.ac.id") {
        // }

        $isEmailUnique = $this->query("SELECT * FROM user WHERE email = '$email' AND id != '$id'");
        if ($isEmailUnique->num_rows > 0) {
            $_SESSION["error"] = true;
            $_SESSION["error_message"] .= "<li>Email telah terdaftar </li>";
        }
    }
}
