<?php
if ($_SERVER['REQUEST_METHOD'] == 'GET' && realpath(__FILE__) == realpath($_SERVER['SCRIPT_FILENAME'])) {
    header("location: ../mothers/");
    exit();
}
require __DIR__ . '/../../model/residents/Mother.php';
require __DIR__ . '/../../model/residents/Children.php';

if (isset($_SESSION['auth'])) {
    // add new mother
    if (isset($_POST['request_add_mother'])) {
        $mother = new Mother;

        $mother->photo = 'uploads/undraw_profile_1.svg';
        $mother->first_name = mysqli_real_escape_string($mother->con, $_POST['first_name']);
        $mother->middle_name = mysqli_real_escape_string($mother->con, $_POST['middle_name']);
        $mother->last_name = mysqli_real_escape_string($mother->con, $_POST['last_name']);
        $mother->birthdate = mysqli_real_escape_string($mother->con, $_POST['birthdate']);

        $dob = $mother->birthdate;
        $today = date('Y-m-d');
        $age = date_diff(date_create($dob), date_create($today));
        $mother->age = $age->format('%y');

        $mother->sex = mysqli_real_escape_string($mother->con, $_POST['sex']);
        $mother->civil_status = mysqli_real_escape_string($mother->con, $_POST['civil_status']);
        $mother->highest_educ_attainment = mysqli_real_escape_string($mother->con, $_POST['highest_educ_attainment']);
        $mother->birthplace = mysqli_real_escape_string($mother->con, $_POST['birthplace']);
        $mother->religion = mysqli_real_escape_string($mother->con, $_POST['religion']);
        $mother->email = mysqli_real_escape_string($mother->con, $_POST['email']);
        $mother->contact_no = mysqli_real_escape_string($mother->con, $_POST['contact_no']);
        $mother->purok_name = mysqli_real_escape_string($mother->con, $_POST['purok_name']);
        $mother->last_user = mysqli_real_escape_string($mother->con, $_SESSION['auth'][0]['username']);

        $result = $mother->storeMother();

        if (is_array($result) && array_key_exists('request_failed', (array)$result)) {
            $_SESSION['request_failed'] =  'Request Failed';
            header("location: ../mothers/");
            exit();
        }

        if ($result) {
            $_SESSION['saved'] =  'Success';
            header("location: ../mothers/");
            exit();
        } else {
            $_SESSION['request_failed'] =  'Failed';
            header("location: ../mothers/");
            exit();
        }
    }

    // request mother info
    if (isset($_POST['request_mother_details'])) {
        $mother = new Mother;

        $id = mysqli_real_escape_string($mother->con, $_POST['id']);

        $result = $mother->getMother_ByID($id);

        if (array_key_exists('request_failed', (array) $result)) {
            echo json_encode('request_failed');
            exit();
        }

        if (!($result == null)) {
            echo json_encode($result);
            exit();
        } else {
            echo json_encode("false");
            exit();
        }
    }

    // update mother info
    if (isset($_POST['request_update_mother'])) {
        $mother = new Mother;

        $mother->photo = 'uploads/undraw_profile_1.svg';
        $id = mysqli_real_escape_string($mother->con, $_POST['id']);
        $mother->first_name = mysqli_real_escape_string($mother->con, $_POST['first_name']);
        $mother->middle_name = mysqli_real_escape_string($mother->con, $_POST['middle_name']);
        $mother->last_name = mysqli_real_escape_string($mother->con, $_POST['last_name']);
        $mother->birthdate = mysqli_real_escape_string($mother->con, $_POST['birthdate']);

        $dob = $mother->birthdate;
        $today = date('Y-m-d');
        $age = date_diff(date_create($dob), date_create($today));
        $mother->age = $age->format('%y');

        $mother->sex = mysqli_real_escape_string($mother->con, $_POST['sex']);
        $mother->civil_status = mysqli_real_escape_string($mother->con, $_POST['civil_status']);
        $mother->highest_educ_attainment = mysqli_real_escape_string($mother->con, $_POST['highest_educ_attainment']);
        $mother->birthplace = mysqli_real_escape_string($mother->con, $_POST['birthplace']);
        $mother->religion = mysqli_real_escape_string($mother->con, $_POST['religion']);
        $mother->email = mysqli_real_escape_string($mother->con, $_POST['email']);
        $mother->contact_no = mysqli_real_escape_string($mother->con, $_POST['contact_no']);
        $mother->purok_name = mysqli_real_escape_string($mother->con, $_POST['purok_name']);
        $mother->last_user = mysqli_real_escape_string($mother->con, $_SESSION['auth'][0]['username']);

        $result = $mother->updateMother($id);

        if (is_array($result) && array_key_exists('request_failed', (array)$result)) {
            $_SESSION['request_failed'] =  'Request Failed';
            header("location: ../mothers/");
            exit();
        }

        if ($result) {
            $_SESSION['updated'] =  'Success';
            header("location: ../mothers/");
            exit();
        } else {
            $_SESSION['request_failed'] =  'Failed';
            header("location: ../mothers/");
            exit();
        }
    }

    // add new children
    if (isset($_POST['request_add_children'])) {
        $children = new Children;

        if ($_POST['sex'] == "Male") {
            $children->photo = 'uploads/undraw_profile_2.svg';
        } else {
            $children->photo = 'uploads/undraw_profile_1.svg';
        }
        $children->first_name = mysqli_real_escape_string($children->con, $_POST['first_name']);
        $children->middle_name = mysqli_real_escape_string($children->con, $_POST['middle_name']);
        $children->last_name = mysqli_real_escape_string($children->con, $_POST['last_name']);
        $children->prefix = mysqli_real_escape_string($children->con, $_POST['prefix']);
        $children->birthdate = mysqli_real_escape_string($children->con, $_POST['birthdate']);

        $dob = $children->birthdate;
        $today = date('Y-m-d');
        $age = date_diff(date_create($dob), date_create($today));
        $children->age = $age->format('%y') . ' years old';
        if ($children->age < 1) {
            $children->age = $age->m . ' month/s';
        }

        $children->sex = mysqli_real_escape_string($children->con, $_POST['sex']);
        $children->civil_status = mysqli_real_escape_string($children->con, $_POST['civil_status']);
        $children->highest_educ_attainment = mysqli_real_escape_string($children->con, $_POST['highest_educ_attainment']);
        $children->birthplace = mysqli_real_escape_string($children->con, $_POST['birthplace']);
        $children->religion = mysqli_real_escape_string($children->con, $_POST['religion']);
        $children->email = mysqli_real_escape_string($children->con, $_POST['email']);
        $children->contact_no = mysqli_real_escape_string($children->con, $_POST['contact_no']);
        $children->disability = mysqli_real_escape_string($children->con, $_POST['disability']);
        $children->mother_id = mysqli_real_escape_string($children->con, $_POST['mother_id']);
        $children->last_user = mysqli_real_escape_string($children->con, $_SESSION['auth'][0]['username']);

        $result = $children->storeChildren();

        if (is_array($result) && array_key_exists('request_failed', (array)$result)) {
            $_SESSION['request_failed'] =  'Request Failed';
            header("location: ../mothers/");
            exit();
        }

        if ($result) {
            $_SESSION['saved_children'] =  'Success';
            header("location: ../mothers/");
            exit();
        } else {
            $_SESSION['request_failed'] =  'Failed';
            header("location: ../mothers/");
            exit();
        }
    }
} else {
    header('location: ../../login/');
    exit();
}
