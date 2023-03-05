<?php
if ($_SERVER['REQUEST_METHOD'] == 'GET' && realpath(__FILE__) == realpath($_SERVER['SCRIPT_FILENAME'])) {
    header('location: ../');
    exit();
}
require_once __DIR__ . '/Database.php';
require_once __DIR__ . '/ActivityLog.php';

class CivilStatus extends Database
{
    function __construct()
    {
        parent::__construct();
    }

    function __destruct()
    {
        $this->con->close();
    }

    function getCivilStatusAll()
    {
        $result = array();

        $query = "select * from civil_status";
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
            $result = ['request_failed' => 'Failed to process request.'];
        }
        $stmt->close();
        return $result;
    }

    function getCivilStatus_ByID($id)
    {
        $result = array();

        $query = "select * from civil_status where id=?";
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

    function civilStatus_Exist($value)
    {
        $result = array();

        $query = "select * from civil_status where civil_status=?";
        $stmt = $this->con->stmt_init();

        if ($stmt->prepare($query)) {
            $stmt->bind_param('s', $value);
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


    function storeCivilStatus($civil_status)
    {
        $query = "insert into civil_status (civil_status, last_user)values(?, ?)";
        $stmt = $this->con->stmt_init();

        if ($stmt->prepare($query)) {
            $stmt->bind_param('ss', $civil_status, $_SESSION['auth'][0]['username']);
            $stmt->execute();
            if ($stmt->affected_rows == 1) {
                $stmt->close();

                $activity_log = new ActivityLog;
                $log = array(
                    'username' => $_SESSION['auth'][0]['username'],
                    'action' => 'Add New Civil Status',
                    'content' => 'Civil Status: ' . $civil_status,
                    'changes' => ''
                );
                $activity_log->storeLog($log);
                return true;
            } else {
                $stmt->close();
                return false;
            }
        } else {
            $stmt->close();
            $result = array('request_failed' => 'Failed to process request.');
            return $result;
            exit();
        }
    }

    function updateCivilStatus(array $values)
    {
        $query = "update civil_status set civil_status=?, updated_at=now(), last_user=? where id=?";
        $stmt = $this->con->stmt_init();

        $status = $this->getCivilStatus_ByID($values['id']);

        if ($stmt->prepare($query)) {
            $stmt->bind_param('ssi', $values['civil_status'], $_SESSION['auth'][0]['username'], $values['id']);
            $stmt->execute();
            if ($stmt->affected_rows == 1) {
                $stmt->close();

                $activity_log = new ActivityLog;
                $log = array(
                    'username' => $_SESSION['auth'][0]['username'],
                    'action' => 'Updated Civil Status',
                    'content' => 'Civil Status: ' . $status[0]['civil_status'],
                    'changes' => 'Civil Status: ' . $values['civil_status']
                );
                $activity_log->storeLog($log);
                return true;
            } else {
                $stmt->close();
                return false;
            }
        } else {
            $stmt->close();
            $result = array('request_failed' => 'Failed to process request.');
            return $result;
            exit();
        }
    }
}
