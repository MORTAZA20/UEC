<?php

session_start();

if ($_SESSION["admin_user"] != "Admin" && $_SESSION["admin_user"] != "SubAdmin") {
    header("Location:login");
    exit();
}
?>