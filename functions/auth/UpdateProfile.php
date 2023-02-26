<?php
if ($_SERVER['REQUEST_METHOD'] == 'GET' && realpath(__FILE__) == realpath($_SERVER['SCRIPT_FILENAME'])) {
    header("location: ../../index.php");
    exit();
}
require __DIR__ . '/../../model/User.php';

session_start();
if (isset($_SESSION['auth'])) {
    if (isset($_POST['request_update_profile'])) {
        $user = new User;
        $user->username = mysqli_real_escape_string($user->con, $_POST['username']);
        $user->first_name = mysqli_real_escape_string($user->con, $_POST['first_name']);
        $user->middle_name = mysqli_real_escape_string($user->con, $_POST['middle_name']);
        $user->last_name = mysqli_real_escape_string($user->con, $_POST['last_name']);
        $user->prefix = mysqli_real_escape_string($user->con, $_POST['prefix']);
        $user->birthdate = mysqli_real_escape_string($user->con, $_POST['birthdate']);

        $dob = $user->birthdate;
        $today = date('Y-m-d');
        $age = date_diff(date_create($dob), date_create($today));
        $user->age = $age->format('%y');

        $user->sex = mysqli_real_escape_string($user->con, $_POST['sex']);
        $user->civil_status = mysqli_real_escape_string($user->con, $_POST['civil_status']);
        if ($user->civil_status == "Other") {
            $user->other_status = mysqli_real_escape_string($user->con, $_POST['other_status']);
        } else {
            $user->other_status = "";
        }
        $user->birthplace = mysqli_real_escape_string($user->con, $_POST['birthplace']);
        $user->religion = mysqli_real_escape_string($user->con, $_POST['religion']);
        $user->email = mysqli_real_escape_string($user->con, $_POST['email']);
        $user->contact_no = mysqli_real_escape_string($user->con, $_POST['contact_no']);
        $user->purok_name = mysqli_real_escape_string($user->con, $_POST['purok_name']);

        $result = $user->updateUserProfile();

        if (is_array($result) && array_key_exists('request_failed', (array)$result)) {
            $_SESSION['request_failed'] =  'Request Failed';
            header('location: ../../bhis/profile.php');
            exit();
        }

        if ($result) {
            $_SESSION['update_success'] =  'Success';
            header('location: ../../bhis/profile.php');
            exit();
        } else {
            $_SESSION['request_failed'] =  'Failed';
            header('location: ../../bhis/profile.php');
            exit();
        }
    }
} else {
    header('location: ../../index.php');
    exit();
}
