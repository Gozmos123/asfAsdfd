<?php
session_start();
if (!(isset($_SESSION['auth']))) {
    header('location: ../login/');
    exit();
}
include('profile.functions.php');
include('profile_page.php');
