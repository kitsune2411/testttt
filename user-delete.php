<?php
include_once "Admin.php";

$db = new Admin;

$id = $db->connect()->real_escape_string($_GET['id']);
$user = $db->query("SELECT * FROM user WHERE id = '$id'")->fetch_assoc();
// var_dump($user);
if (isset($_POST["submit"])) {
    $res =  $db->delUser($id);
    if ($res) {
        header('location:index.php');
    } else {
        $_SESSION['error_message'] = 'Aksi gagal dilakukan';
    }
}
?>
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

<div class="">
    Apakah anda yakin untuk menghapus user atas nama <?= $user['firstName'] . " " . $user['lastName'] ?>
    <form action="" method="post">

        <a href="?p=dashboard" class="d-inline mx-2 btn btn-secondary float-right">Cancel</a>
        <button type="submit" name="submit" class="d-inline mx-2 btn btn-danger float-right">Delete User</button>
    </form>

</div>