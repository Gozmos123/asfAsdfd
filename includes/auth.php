<?php
if ($_SERVER['REQUEST_METHOD'] == 'GET' && realpath(__FILE__) == realpath($_SERVER['SCRIPT_FILENAME'])) {
    header('location: ../index.php');
    exit();
}

session_start();
if (!(isset($_SESSION['auth']))) {
    header('location: ../index.php');
    exit();
}
