<?php
if ($_SERVER['REQUEST_METHOD'] == 'GET' && realpath(__FILE__) == realpath($_SERVER['SCRIPT_FILENAME'])) {
    header("location: ../childrens/");
    exit();
}
require __DIR__ . '/../../model/residents/Mother.php';
require __DIR__ . '/../../model/residents/Children.php';
require __DIR__ . '/../../model/Secure.php';

if (isset($_SESSION['auth'])) {

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

    // request children info
    if (isset($_POST['request_children_details'])) {
        $children = new Children;

        $id = mysqli_real_escape_string($children->con, $_POST['id']);

        $result = $children->getChildren_ByID($id);

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

    // request update children
    if (isset($_POST['request_update_children'])) {
        $children = new Children;

        $request = mysqli_real_escape_string($children->con, $_POST['isRequestSpecific']);

        $id = mysqli_real_escape_string($children->con, $_POST['id']);
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
        if ($children->civil_status == "Other") {
            $children->other_status = mysqli_real_escape_string($children->con, $_POST['other_status']);
        } else {
            $children->other_status = "";
        }
        $children->birthplace = mysqli_real_escape_string($children->con, $_POST['birthplace']);
        $children->religion = mysqli_real_escape_string($children->con, $_POST['religion']);
        $children->email = mysqli_real_escape_string($children->con, $_POST['email']);
        $children->contact_no = mysqli_real_escape_string($children->con, $_POST['contact_no']);
        $children->purok_name = mysqli_real_escape_string($children->con, $_POST['purok_name']);
        $children->mother_id = mysqli_real_escape_string($children->con, $_POST['mother_id']);
        $children->last_user = mysqli_real_escape_string($children->con, $_SESSION['auth'][0]['username']);

        $result = $children->updateChildren($id);

        if (is_array($result) && array_key_exists('request_failed', (array)$result)) {
            $_SESSION['request_failed'] =  'Request Failed';
            if ($request == "child_list") {
                header("location: ../childrens/?q=" . Secure::encrypt($children->mother_id));
                exit();
            } elseif ($request == "child_profile") {
                header("location: ../childrens/?view=" . Secure::encrypt($id));
                exit();
            } else {
                header("location: ../childrens/");
                exit();
            }
        }

        if ($result) {
            $_SESSION['updated'] =  'Success';
            if ($request == "child_list") {
                header("location: ../childrens/?q=" . Secure::encrypt($children->mother_id));
                exit();
            } elseif ($request == "child_profile") {
                header("location: ../childrens/?view=" . Secure::encrypt($id));
                exit();
            } else {
                header("location: ../childrens/");
                exit();
            }
        } else {
            $_SESSION['request_failed'] =  'Failed';
            if ($request == "child_list") {
                header("location: ../childrens/?q=" . Secure::encrypt($children->mother_id));
                exit();
            } elseif ($request == "child_profile") {
                header("location: ../childrens/?view=" . Secure::encrypt($id));
                exit();
            } else {
                header("location: ../childrens/");
                exit();
            }
        }
    }
} else {
    header('location: ../../login/');
    exit();
}
