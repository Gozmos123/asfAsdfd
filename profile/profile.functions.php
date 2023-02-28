<?php
if ($_SERVER['REQUEST_METHOD'] == 'GET' && realpath(__FILE__) == realpath($_SERVER['SCRIPT_FILENAME'])) {
    header("location: ../profile/");
    exit();
}
require __DIR__ . '/../model/User.php';

if (isset($_SESSION['auth'])) {
    // update profile
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
            header("location: ../profile/");
            exit();
        }

        if ($result) {
            $_SESSION['update_success'] =  'Success';
            header("location: ../profile/");
            exit();
        } else {
            $_SESSION['request_failed'] =  'Failed';
            header("location: ../profile/");
            exit();
        }
    }

    // verify current password
    if (isset($_POST['verify_password'])) {
        $user = new User;

        $username = mysqli_real_escape_string($user->con, $_POST['username']);
        $password = mysqli_real_escape_string($user->con, $_POST['password']);

        $result = $user->authenticateLogin($username, $password);

        if (array_key_exists('request_error', (array) $result)) {
            echo json_encode('request_failed');
            exit();
        }

        if (!($result == null)) {
            echo json_encode("true");
            exit();
        } else {
            echo json_encode("false");
            exit();
        }
    }

    // change password
    if (isset($_POST['change_password'])) {
        $user = new User;

        $username = mysqli_real_escape_string($user->con, $_POST['username']);
        $password = mysqli_real_escape_string($user->con, $_POST['password']);

        $result = $user->updateUserPassword($username, $password);

        if (array_key_exists('request_error', (array) $result)) {
            echo json_encode('request_failed');
            exit();
        }

        if ($result) {
            echo json_encode("true");
            exit();
        } else {
            echo json_encode("false");
            exit();
        }
    }
} else {
    header("location: ../login/");
    exit();
}
