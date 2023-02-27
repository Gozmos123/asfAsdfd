<?php
if ($_SERVER['REQUEST_METHOD'] == 'GET' && realpath(__FILE__) == realpath($_SERVER['SCRIPT_FILENAME'])) {
    header("location: ../index.php");
    exit();
}
require_once('../model/User.php');
session_start();

$user = new User;
$user->updateLoginDate($_SESSION['auth'][0]['username'], 'System Logout');

session_unset();
session_destroy();
header("location: ../index.php");
exit();
