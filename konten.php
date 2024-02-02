<?php


if (empty($_GET["p"])) {
    include "dashboard.php";
}

if (isset($_GET["p"])) {

    switch ($_GET["p"]) {
        case "logout":
            include "logout.php";
            break;
        case "dashboard":
            include "dashboard.php";
            break;
        case "profile":
            include "profile.php";
            break;
        case "add_user":
            include "user-create.php";
            break;
        case "ubah_user":
            include "user-update.php";
            break;
        case "detail_user":
            include "user-detail.php";
            break;
        case "delete_user":
            include "user-delete.php";
            break;
        default:
            include "404.php";
    }
}
