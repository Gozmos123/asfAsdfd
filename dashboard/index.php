<?php
session_start();
if (!(isset($_SESSION['auth']))) {
    header('location: ../login/');
    exit();
}
// include('authenticate_login.functions.php');
include('dashboard_page.php');
