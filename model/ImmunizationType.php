<?php
if ($_SERVER['REQUEST_METHOD'] == 'GET' && realpath(__FILE__) == realpath($_SERVER['SCRIPT_FILENAME'])) {
    header('location: ../');
    exit();
}
require_once __DIR__ . '/Database.php';

class ImmunizationType extends Database
{
    function __construct()
    {
        parent::__construct();
    }

    function __destruct()
    {
        $this->con->close();
    }

    function getImmunizationsTypeAll()
    {
        $result = array();

        $query = "select * from immunizations_type";
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

    function getImmunizationsType_ByID($id)
    {
        $result = array();

        $query = "select * from immunizations_type where id=?";
        $stmt = $this->con->stmt_init();

        if ($stmt->prepare($query)) {
            $stmt->bind_param('s', $id);
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

    function immunizationType_Exist($value)
    {
        $result = array();

        $query = "select * from immunizations_type where immunization_type=?";
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

    function store($value)
    {
        $query = "insert into immunizations_type (immunization_type, last_user)values(?, ?)";
        $stmt = $this->con->stmt_init();

        if ($stmt->prepare($query)) {
            $stmt->bind_param('ss', $value, $_SESSION['auth'][0]['username']);
            $stmt->execute();
            if ($stmt->affected_rows == 1) {
                $stmt->close();

                $activity_log = new ActivityLog;
                $log = array(
                    'username' => $_SESSION['auth'][0]['username'],
                    'action' => 'Add New Immunization Type',
                    'content' => 'Immunization Type: ' . $value,
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

    function update(array $values)
    {
        $query = "update immunizations_type set immunization_type=?, updated_at=now(), last_user=? where id=?";
        $stmt = $this->con->stmt_init();

        $current_data = $this->getImmunizationsType_ByID($values['id']);

        if ($stmt->prepare($query)) {
            $stmt->bind_param('ssi', $values['immunization_type'], $_SESSION['auth'][0]['username'], $values['id']);
            $stmt->execute();
            if ($stmt->affected_rows == 1) {
                $stmt->close();

                $activity_log = new ActivityLog;
                $log = array(
                    'username' => $_SESSION['auth'][0]['username'],
                    'action' => 'Updated Immunizations Type',
                    'content' => 'Immunization Type: ' . $current_data[0]['immunization_type'],
                    'changes' => 'Immunization Type: ' . $values['immunization_type']
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
