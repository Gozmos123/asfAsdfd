<?php
if ($_SERVER['REQUEST_METHOD'] == 'GET' && realpath(__FILE__) == realpath($_SERVER['SCRIPT_FILENAME'])) {
    header("location: ../immunizations/");
    exit();
}
require __DIR__ . '/../../model/residents/Children.php';
require __DIR__ . '/../../model/monitoring/Immunization.php';
require __DIR__ . '/../../model/Secure.php';

if (isset($_SESSION['auth'])) {

    if (isset($_POST['request_children_details'])) {
        $childrenObj = new Children;

        $children_id = mysqli_real_escape_string($childrenObj->con, $_POST['children_id']);

        $result = $childrenObj->getChildren_ByID($children_id);

        if (array_key_exists('request_failed', (array) $result)) {
            echo json_encode('request_failed');
            exit();
        }

        if (!($result == null)) {
            $children = array();
            foreach ($result as $row) {
                $temp = array();
                $temp = [
                    'name' => $row['first_name'] . ' ' . $row['middle_name'] . ' ' . $row['last_name'] . ' ' . $row['prefix']
                ];
                array_push($children, $temp);
                unset($temp);
            }
            echo json_encode($children);
            exit();
        } else {
            echo json_encode("false");
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
            echo json_encode('request_failed');
            exit();
        }

        if ($result) {
            echo json_encode('true');
            exit();
        } else {
            echo json_encode("false");
            exit();
        }
        exit();
    }
} else {
    header('location: ../../login/');
    exit();
}
