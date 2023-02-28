<?php
session_start();
if (!(isset($_SESSION['auth']))) {
    header('location: ../login/');
    exit();
}
include('users.function.php');
include('users_page.php');
