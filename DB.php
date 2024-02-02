<?php
session_start();
class DB
{
    var $host = "localhost";
    var $user = "root";
    var $pass = "";
    var $dbs = "attendance_system";
    public function connect()
    {
        $conn = new mysqli($this->host, $this->user, $this->pass, $this->dbs) or die(mysqli_connect_error());
        return $conn;
    }

    public function doLogout()
    {
        $_SESSION["status"] = "logout";
        if ($_SESSION["remember"] == false) {
            session_reset();
            session_destroy();
        }
        header("location: index.php");
    }

    public function isLogin()
    {
        if (isset($_SESSION['status'])) {
            if ($_SESSION['status'] != 'login') {
                header("location: login.php");
            }
        } else {
            header("location: login.php");
        }
    }

    public function query($sql)
    {
        $conn = $this->connect();

        return mysqli_query($conn, $sql);
    }

    public function fetchAll($sql)
    {
        $queryRun = $this->query($sql);

        return $queryRun->fetch_all(MYSQLI_ASSOC);
    }
}
