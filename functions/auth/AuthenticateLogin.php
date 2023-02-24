<?php
if ($_SERVER['REQUEST_METHOD'] == 'GET' && realpath(__FILE__) == realpath($_SERVER['SCRIPT_FILENAME'])) {
    header("location: ../../index.php");
    exit();
}
require __DIR__ . '/../../model/User.php';

session_start();
if (!(isset($_SESSION['auth']))) {
    $user = new User;

    $username = mysqli_real_escape_string($user->con, $_POST['username']);
    $password = mysqli_real_escape_string($user->con, $_POST['password']);

    $result = $user->authenticateLogin($username, $password);

    if (array_key_exists('request_error', (array) $result)) {
        echo json_encode('request_failed');
        exit();
    }

    if (!($result == null)) {
        $_SESSION['auth'] = $result;
        echo json_encode("true");
        exit();
    } else {
        echo json_encode("false");
        exit();
    }
} else {
    header('location: ../../index.php');
}
