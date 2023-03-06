<?php
if ($_SERVER['REQUEST_METHOD'] == 'GET' && realpath(__FILE__) == realpath($_SERVER['SCRIPT_FILENAME'])) {
    header("location: ../childrens/");
    exit();
}
require __DIR__ . '/../../model/residents/Mother.php';
require __DIR__ . '/../../model/residents/Children.php';
require __DIR__ . '/../../model/Secure.php';
require __DIR__ . '/../../model/monitoring/Immunization.php';
require __DIR__ . '/../../model/monitoring/Weight.php';
require __DIR__ . '/../../model/distributions/Vitamin.php';
require __DIR__ . '/../../model/distributions/Deworming.php';

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
        $children->highest_educ_attainment = mysqli_real_escape_string($children->con, $_POST['highest_educ_attainment']);
        $children->birthplace = mysqli_real_escape_string($children->con, $_POST['birthplace']);
        $children->religion = mysqli_real_escape_string($children->con, $_POST['religion']);
        $children->email = mysqli_real_escape_string($children->con, $_POST['email']);
        $children->contact_no = mysqli_real_escape_string($children->con, $_POST['contact_no']);
        $children->disability = mysqli_real_escape_string($children->con, $_POST['disability']);
        $children->mother_id = mysqli_real_escape_string($children->con, $_POST['mother_id']);
        $children->last_user = mysqli_real_escape_string($children->con, $_SESSION['auth'][0]['username']);

        $result = $children->updateChildren($id);

        if (is_array($result) && array_key_exists('request_failed', (array)$result)) {
            $_SESSION['request_failed'] =  'Request Failed';
            if ($request == "child_list") {
                header("location: ../childrens/?q=" . Secure::encrypt($children->mother_id));
                exit();
            } elseif ($request == "child_profile") {
                header("location: ../childrens/?view=" . Secure::encrypt($id) . '&monitoring=all');
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
                header("location: ../childrens/?view=" . Secure::encrypt($id) . '&monitoring=all');
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
                header("location: ../childrens/?view=" . Secure::encrypt($id) . '&monitoring=all');
                exit();
            } else {
                header("location: ../childrens/");
                exit();
            }
        }
    }

    if (isset($_POST['request_save_vitamin'])) {
        if (!(isset($_POST['selected']))) {
            echo json_encode('no_selected');
            exit();
        }
        $vitamin = new Vitamin;

        $selected_childrens = $_POST['selected'];
        $date_given = mysqli_real_escape_string($vitamin->con, $_POST['date_given']);
        $given_by = mysqli_real_escape_string($vitamin->con, $_POST['given_by']);

        $children[] = array(
            'value' => $selected_childrens[0]
        );

        $result = $vitamin->storeVitamin($children, $date_given, $given_by);

        if (array_key_exists('request_failed', (array) $result)) {
            $_SESSION['request_failed'] =  'Request Failed';
            header("location: ../childrens/?view=" . Secure::encrypt($selected_childrens[0]) . '&monitoring=vitamins');
            exit();
        }

        if ($result) {
            $_SESSION['saved-vitamin'] =  'Saved';
            header("location: ../childrens/?view=" . Secure::encrypt($selected_childrens[0]) . '&monitoring=vitamins');
            exit();
        } else {
            $_SESSION['request_failed'] =  'Request Failed';
            header("location: ../childrens/?view=" . Secure::encrypt($selected_childrens[0]) . '&monitoring=vitamins');
            exit();
        }
    }

    if (isset($_POST['request_save_deworming'])) {
        if (!(isset($_POST['selected']))) {
            echo json_encode('no_selected');
            exit();
        }
        $dewormingObj = new Deworming;

        $selected_childrens = $_POST['selected'];
        $place_given = mysqli_real_escape_string($dewormingObj->con, $_POST['place_given']);
        $date_given = mysqli_real_escape_string($dewormingObj->con, $_POST['date_given']);
        $given_by = mysqli_real_escape_string($dewormingObj->con, $_POST['given_by']);

        $children[] = array(
            'value' => $selected_childrens[0]
        );

        $result = $dewormingObj->storeDeworming($children, $place_given, $date_given, $given_by);

        if (array_key_exists('request_failed', (array) $result)) {
            $_SESSION['request_failed'] =  'Request Failed';
            header("location: ../childrens/?view=" . Secure::encrypt($selected_childrens[0]) . '&monitoring=deworming');
            exit();
        }

        if ($result) {
            $_SESSION['saved-deworming'] =  'Saved';
            header("location: ../childrens/?view=" . Secure::encrypt($selected_childrens[0]) . '&monitoring=deworming');
            exit();
        } else {
            $_SESSION['request_failed'] =  'Request Failed';
            header("location: ../childrens/?view=" . Secure::encrypt($selected_childrens[0]) . '&monitoring=deworming');
            exit();
        }
    }

    if (isset($_POST['request_save_weight'])) {
        $weightObj = new Weight;

        $children_id = mysqli_real_escape_string($weightObj->con, $_POST['children_id']);
        $weight = mysqli_real_escape_string($weightObj->con, $_POST['weight']);
        $height = mysqli_real_escape_string($weightObj->con, $_POST['height']);
        $checked_by = mysqli_real_escape_string($weightObj->con, $_POST['checked_by']);
        $date_checked = mysqli_real_escape_string($weightObj->con, $_POST['date_checked']);

        $values = array(
            'children_id' => $children_id,
            'weight' => $weight,
            'height' => $height,
            'checked_by' => $checked_by,
            'date_checked' => $date_checked
        );

        $result = $weightObj->storeWeight($values);

        if (array_key_exists('request_failed', (array) $result)) {
            $_SESSION['request_failed'] =  'Request Failed';
            header("location: ../childrens/?view=" . Secure::encrypt($children_id) . '&monitoring=weights');
            exit();
        }

        if ($result) {
            $_SESSION['saved-weights'] =  'Saved';
            header("location: ../childrens/?view=" . Secure::encrypt($children_id) . '&monitoring=weights');
            exit();
        } else {
            $_SESSION['request_failed'] =  'Request Failed';
            header("location: ../childrens/?view=" . Secure::encrypt($children_id) . '&monitoring=weights');
            exit();
        }
    }

    if (isset($_POST['request_save_immunization'])) {
        $immunizationObj = new Immunization;

        $children_id = mysqli_real_escape_string($immunizationObj->con, $_POST['children_id']);
        $vaccine_name = mysqli_real_escape_string($immunizationObj->con, $_POST['vaccine_name']);
        $dose = mysqli_real_escape_string($immunizationObj->con, $_POST['dose']);
        $date_given = mysqli_real_escape_string($immunizationObj->con, $_POST['date_given']);
        $immunization_type = mysqli_real_escape_string($immunizationObj->con, $_POST['immunization_type']);
        $administered_by = mysqli_real_escape_string($immunizationObj->con, $_POST['administered_by']);


        $values = array(
            'children_id' => $children_id,
            'vaccine_name' => $vaccine_name,
            'dose' => $dose,
            'date_given' => $date_given,
            'immunization_type' => $immunization_type,
            'administered_by' => $administered_by
        );

        $result = $immunizationObj->storeImmunization($values);

        if (array_key_exists('request_failed', (array) $result)) {
            $_SESSION['request_failed'] =  'Request Failed';
            header("location: ../childrens/?view=" . Secure::encrypt($children_id) . '&monitoring=immunization');
            exit();
        }

        if ($result) {
            $_SESSION['saved-immunization'] =  'Saved';
            header("location: ../childrens/?view=" . Secure::encrypt($children_id) . '&monitoring=immunization');
            exit();
        } else {
            $_SESSION['request_failed'] =  'Request Failed';
            header("location: ../childrens/?view=" . Secure::encrypt($children_id) . '&monitoring=immunization');
            exit();
        }
    }
} else {
    header('location: ../../login/');
    exit();
}
