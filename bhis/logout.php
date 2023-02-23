<?php
if ($_SERVER['REQUEST_METHOD'] == 'GET' && realpath(__FILE__) == realpath($_SERVER['SCRIPT_FILENAME'])) {
    header("location: ../index.php");
    exit();
}
session_start();
session_unset();
session_destroy();
header("location: ../index.php");
exit();
