<?php
session_start();
if (!(isset($_SESSION['auth']))) {
    header('location: ../login/');
    exit();
}
include('activity_logs.function.php');
include('activity_logs_page.php');
