<?php
if ($_SERVER['REQUEST_METHOD'] == 'GET' && realpath(__FILE__) == realpath($_SERVER['SCRIPT_FILENAME'])) {
    header("location: ../../index.php");
    exit();
}
require __DIR__ . '/../../model/ActivityLog.php';

session_start();
if (isset($_SESSION['auth'])) {
    $logs = new ActivityLog;

    $id = mysqli_real_escape_string($logs->con, $_POST['id']);

    $result = $logs->getActivityLog_ByID($id);

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
} else {
    header('location: ../../index.php');
}
