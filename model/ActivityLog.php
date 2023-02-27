<?php
if ($_SERVER['REQUEST_METHOD'] == 'GET' && realpath(__FILE__) == realpath($_SERVER['SCRIPT_FILENAME'])) {
    header('location: ../index.php');
    exit();
}
require_once __DIR__ . '/Database.php';

class ActivityLog extends Database
{

    function __construct()
    {
        parent::__construct();
    }

    function __destruct()
    {
        $this->con->close();
    }

    function getActivityLogsAll()
    {
        $result = array();

        $query = "select * from user_logs order by created_at desc";
        $stmt = $this->con->stmt_init();

        if ($stmt->prepare($query)) {
            $stmt->execute();
            $que_result = $stmt->get_result();
            if ($que_result->num_rows > 0) {
                $result = $que_result->fetch_all(MYSQLI_ASSOC);
            } else {
                $result = null;
            }
        } else {
            $result = ['request_error' => 'Failed to process request.'];
        }
        $stmt->close();
        return $result;
    }

    function getActivityLogs_ByUsername($username)
    {
        $result = array();

        $query = "select * from user_logs where username=? order by created_at desc";
        $stmt = $this->con->stmt_init();

        if ($stmt->prepare($query)) {
            $stmt->bind_param('s', $username);
            $stmt->execute();
            $que_result = $stmt->get_result();
            if ($que_result->num_rows > 0) {
                $result = $que_result->fetch_all(MYSQLI_ASSOC);
            } else {
                $result = null;
            }
        } else {
            $result = ['request_error' => 'Failed to process request.'];
        }
        $stmt->close();
        return $result;
    }

    function storeLog(array $log)
    {
        $query = "insert into user_logs (username, action, content, changes)values(?, ?, ?, ?)";
        $stmt = $this->con->stmt_init();

        $stmt->prepare($query);
        $stmt->bind_param('ssss', $log['username'], $log['action'], $log['content'], $log['changes']);
        $stmt->execute();
        $stmt->close();
    }

    function getActivityLog_ByID($id)
    {
        $result = array();

        $query = "select * from user_logs where id=?";
        $stmt = $this->con->stmt_init();

        if ($stmt->prepare($query)) {
            $stmt->bind_param('i', $id);
            $stmt->execute();
            $que_result = $stmt->get_result();
            if ($que_result->num_rows > 0) {
                $result = $que_result->fetch_all(MYSQLI_ASSOC);
            } else {
                $result = null;
            }
        } else {
            $result = ['request_failed' => 'Failed to process request.'];
        }
        $stmt->close();
        return $result;
    }
}
