<?php
session_start();
if (!(isset($_SESSION['auth']))) {
    header('location: ../../login/');
    exit();
}
include('weights.function.php');
include('weights_page.php');
