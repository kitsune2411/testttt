<?php
include_once "Admin.php";

$db = new Admin;

$id = $db->connect()->real_escape_string($_SESSION['id_user']);
$user = $db->query("SELECT * FROM user WHERE id = '$id'")->fetch_assoc();
// var_dump($user);
?>

<div class="form-group">
    <label for="nama">First Name</label>
    <input type="text" class="form-control" value="<?= $user['firstName'] ?>" disabled>
</div>
<div class="form-group">
    <label for="nama">Last Name</label>
    <input type="text" class="form-control" value="<?= $user['lastName'] ?>" disabled>
</div>
<div class="form-group">
    <label for="email">email</label>
    <input type="email" class="form-control" value="<?= $user['email'] ?>" disabled>
</div>
<div class="form-group">
    <label for="nama">Bio</label>
    <textarea rows="5" class="form-control" disabled><?= $user['bio'] ?></textarea>
</div>

<a class="btn btn-primary mt-3 float-right d-inline d-sm-inline " href="?p=logout" id="button-add">Logout</a>