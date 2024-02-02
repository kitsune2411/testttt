<?php
include_once "Admin.php";

$db = new Admin;

$id = $db->connect()->real_escape_string($_GET['id']);
$user = $db->query("SELECT * FROM user WHERE id = '$id'")->fetch_assoc();
// var_dump($user);
?>
<br>
<h1 class="h3 mb-2 text-gray-800 d-inline">Detail User</h1>
<a href="?p=dashboard" class="d-inline d-sm-inline btn btn-sm btn-secondary text-white shadow-sm float-right">← Back</a>
<hr>
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