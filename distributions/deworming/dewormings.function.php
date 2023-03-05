<?php
if ($_SERVER['REQUEST_METHOD'] == 'GET' && realpath(__FILE__) == realpath($_SERVER['SCRIPT_FILENAME'])) {
    header("location: ../deworming/");
    exit();
}
require __DIR__ . '/../../model/distributions/Deworming.php';
require __DIR__ . '/../../model/Secure.php';

if (isset($_SESSION['auth'])) {

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

        $result = $dewormingObj->storeDeworming($selected_childrens, $place_given, $date_given, $given_by);

        if (array_key_exists('request_failed', (array) $result)) {
            echo json_encode('request_failed');
            exit();
        }

        if (!($result == null)) {
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
