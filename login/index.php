<?php
session_start();
if (isset($_SESSION['auth'])) {
    header('location: ../dashboard/');
    exit();
}
include('authenticate_login.functions.php');
include('login_page.php');
