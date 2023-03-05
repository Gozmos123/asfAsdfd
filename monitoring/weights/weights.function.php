<?php
if ($_SERVER['REQUEST_METHOD'] == 'GET' && realpath(__FILE__) == realpath($_SERVER['SCRIPT_FILENAME'])) {
    header("location: ../weights/");
    exit();
}
require __DIR__ . '/../../model/residents/Children.php';
require __DIR__ . '/../../model/monitoring/Weight.php';
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
