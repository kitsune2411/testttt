<?php
include_once "Admin.php";

$db = new Admin;

if (isset($_POST["submit"])) {
    $filename = $_FILES['foto']['name'];
    $fname = $db->connect()->real_escape_string($_POST["fname"]);
    $lname = $db->connect()->real_escape_string($_POST["lname"]);
    $email = $db->connect()->real_escape_string($_POST["email"]);
    $bio = $db->connect()->real_escape_string($_POST["bio"]);
    $db->validateInput($_FILES['foto'], $fname, $lname, $email);
    if (!isset($_SESSION["error"])) {
        $passwd = md5(rand());

        $res = $db->addUser($fname, $lname, $email, $bio, $passwd);

        if ($res) {
            $dirUpload = "images/";

            $up = move_uploaded_file($_FILES['foto']['tmp_name'], $dirUpload . $filename);

            if ($up) {
                header('location:index.php');
            } else {
                $_SESSION['error_message'] = 'Gambar gagal diupload';
            }
        } else {
            $_SESSION['error_message'] = 'Aksi gagal dilakukan';
        }
    }
}

?>
<!-- Begin Page Content -->
<div class="container-fluid">
    <h1 class="h3 mb-2 text-gray-800 d-inline">Add User</h1>
    <a href="?p=dashboard" class="d-inline d-sm-inline btn btn-sm btn-secondary text-white shadow-sm float-right">← Back</a>
    <hr>
    <?php if (isset($_SESSION['error'])) : ?>
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                <span class="sr-only">Close</span>
            </button>
            <?php if (isset($_SESSION['error_message'])) echo $_SESSION["error_message"] ?>
        </div>

    <?php
        unset($_SESSION['error']);
        unset($_SESSION['error_message']);
    endif;
    ?>
    <form action="" method="POST" enctype="multipart/form-data">

        <div class="form-group">
            <input type="file" class="" name="foto" id="foto" placeholder="foto" accept="image/png" required>
        </div>
        <div class="form-group">
            <label for="fname">First Name</label>
            <input type="text" class="form-control" name="fname" id="fname" placeholder="First name" required>
        </div>
        <div class="form-group">
            <label for="lname">Last Name</label>
            <input type="text" class="form-control" name="lname" id="lname" placeholder="Last name" required>
        </div>
        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" class="form-control" name="email" id="email" placeholder="Email" required>
        </div>
        <div class="form-group">
            <label for="bio">Bio</label>
            <textarea rows="5" class="form-control" name="bio" id="bio" placeholder="Bio"></textarea>
        </div>



        <button type="submit" name="submit" class="btn btn-primary float-right">Add User</button>
    </form>
</div>