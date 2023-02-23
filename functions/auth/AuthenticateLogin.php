<?php
if ($_SERVER['REQUEST_METHOD'] == 'GET' && realpath(__FILE__) == realpath($_SERVER['SCRIPT_FILENAME'])) {
    header("location: ../../index.php");
    exit();
}
require __DIR__ . '/../../model/User.php';

session_start();
if (!(isset($_SESSION['auth']))) {
    if (isset($_POST['login_request'])) {

        $user = new User;

        $username = mysqli_real_escape_string($user->con, $_POST['username']);
        $password = mysqli_real_escape_string($user->con, $_POST['password']);

        $result = $user->authenticateLogin($username, $password);
        if (!($result == null)) {
            $_SESSION['auth'] = $result;
            header('location: ../../bhis/dashboard.php');
            exit();
        } elseif ($result['request_error']) {
            $_SESSION['request_failed'] = "Something went wrong, failed to process request. Please try again.";
            header('location: ../../index.php');
            exit();
        } else {
            $_SESSION['invalid_auth'] = "Your username or password is incorrect.";
            header('location: ../../index.php');
            exit();
        }
    }
} else {
    header('location: ../../index.php');
}
