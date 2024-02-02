<?php
include_once "Admin.php";

$db = new Admin;
?>


<div class="">
    <form class="user" action="" method="GET">
        <div class="input-group mb-3">
            <input type="text" class="form-control" name="search" placeholder="Masukan nama atau email" aria-label="Masukan nama atau email" aria-describedby="button-addon2">
            <div class="input-group-append">
                <button class="btn btn-secondary" type="submit" id="button-addon2">Search</button>
            </div>
        </div>

    </form>

    <h1 class="d-inline">User List</h1>
    <a class="btn btn-outline-primary mt-3 float-right d-inline d-sm-inline " href="?p=add_user" id="button-add">+ Add User</a>

    <table class="table table-bordered table-hover mt-4">
        <thead>
            <tr>
                <th scope="col">No</th>
                <th scope="col">Photo</th>
                <th scope="col">Full Name</th>
                <th scope="col">Email</th>
                <th scope="col">Action</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $no = 1;
            if (isset($_GET["search"])) {
                $search = $db->connect()->real_escape_string($_GET["search"]);
                $users = $db->getFilteredAllUsers($search);
            } else {
                $users = $db->getAllUsers();
            }

            foreach ($users as $user) :
                if ($user["email"] == $_SESSION["email"]) {
                    continue;
                }
            ?>
                <tr>
                    <th><?= $no++ ?></th>
                    <td>
                        <img src="images/<?= $user['firstName'] . " " .  $user['lastName'] . '.png' ?>" style="width: 100px;">

                    </td>
                    <td><?= $user['firstName'] . " " .  $user['lastName'] ?></td>
                    <td><?= $user['email'] ?></td>
                    <td>
                        <a href="?p=detail_user&id=<?= $user['id'] ?>" class="btn btn-primary">Detail</a>
                        <a href="?p=ubah_user&id=<?= $user['id'] ?>" class="btn btn-warning text-white">Update</a>
                        <a href="?p=delete_user&id=<?= $user['id'] ?>" class="btn btn-danger">Delete</a>
                    </td>
                </tr>


            <?php endforeach ?>
        </tbody>
    </table>

</div>