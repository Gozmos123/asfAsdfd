<?php
session_start();
if (!(isset($_SESSION['auth']))) {
    header('location: ../../login/');
    exit();
}
include('dewormings.function.php');
include('dewormings_page.php');
