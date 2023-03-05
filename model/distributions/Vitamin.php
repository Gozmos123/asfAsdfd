<?php
if ($_SERVER['REQUEST_METHOD'] == 'GET' && realpath(__FILE__) == realpath($_SERVER['SCRIPT_FILENAME'])) {
    header('location: ../../');
    exit();
}
require_once __DIR__ . '/../Database.php';
require_once __DIR__ . '/../ActivityLog.php';
require_once __DIR__ . '/../residents/Children.php';

class Vitamin extends Database
{
    function __construct()
    {
        parent::__construct();
    }

    function __destruct()
    {
        $this->con->close();
    }

    function getVitaminsAll()
    {
        $result = array();

        $query = "select childrens.id as cID, childrens.photo, childrens.first_name, childrens.middle_name, childrens.last_name, childrens.prefix, childrens.age, childrens.sex, mothers.first_name as mFirstName, mothers.middle_name as mMiddleName, mothers.last_name as mLastName, vitamins.date_given " .
            "from childrens inner join mothers on childrens.mother_id=mothers.id " .
            "inner join vitamins on childrens.id=vitamins.children_id group by childrens.id;";
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

    function getChildrens_Filter()
    {
        $result = array();
        $query = "select childrens.id as cID, childrens.first_name, childrens.middle_name, childrens.last_name, childrens.prefix, childrens.age, childrens.sex, mothers.first_name as mFirstName, mothers.middle_name as mMiddleName, mothers.last_name as mLastName " .
            "from childrens inner join mothers on childrens.mother_id=mothers.id;";

        $stmt = $this->con->stmt_init();

        if ($stmt->prepare($query)) {
            $stmt->execute();
            $que_result = $stmt->get_result();
            if ($que_result->num_rows > 0) {
                while ($row = $que_result->fetch_assoc()) {
                    $results = [
                        'id' => $row['cID'],
                        'name' => $row['first_name'] . ' ' . $row['middle_name'] . ' ' . $row['last_name'] . ' ' . $row['prefix'],
                        'age' => $row['age'],
                        'sex' => $row['sex'],
                        'mother' => $row['mFirstName'] . ' ' . $row['mMiddleName'] . ' ' . $row['mLastName']
                    ];
                    array_push($result, $results);
                    unset($results);
                }
            } else {
                $result = null;
            }
        } else {
            $result = ['request_failed' => 'Failed to process request.'];
        }
        $stmt->close();
        return $result;
    }

    function getVitamins_ByChildrenID($id)
    {
        $result = array();

        $query = "select * from vitamins where children_id=? order by date_given desc";
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

    function storeVitamin(array $selected, $date_given, $given_by)
    {
        $childObj = new Children;

        $child_list = '';
        foreach ($selected as $child) {
            $childs = $childObj->getChildren_ByID($child['value']);
            if ($childs[0]['prefix'] == '') {
                $child_list .= $childs[0]['first_name'] . ' ' . $childs[0]['middle_name'] . ' ' . $childs[0]['last_name'] . ', ';
            } else {
                $child_list .= $childs[0]['first_name'] . ' ' . $childs[0]['middle_name'] . ' ' . $childs[0]['last_name'] . ' '  . $childs[0]['prefix'] .  ', ';
            }
        }

        $query = "insert into vitamins (children_id, date_given, given_by, last_user)values(?, ?, ?, ?)";
        $stmt = $this->con->stmt_init();

        $this->con->begin_transaction();
        try {
            foreach ($selected as $children) {
                $stmt->prepare($query);
                $stmt->bind_param('isss', $children['value'], $date_given, $given_by, $_SESSION['auth'][0]['username']);
                $stmt->execute();
            }

            $this->con->commit();

            if ($stmt->affected_rows >= 1) {
                $activity_log = new ActivityLog;
                $log = array(
                    'username' => $_SESSION['auth'][0]['username'],
                    'action' => 'Add New Vitamin Distribution',
                    'content' => 'Date Given: ' . $date_given . ', Given By: ' . $given_by . ', Childrens Received: ' . $child_list,
                    'changes' => ''
                );
                $activity_log->storeLog($log);
                return true;
            } else {
                return false;
            }
        } catch (\Throwable $th) {
            $this->con->rollback();
            throw $th;
            $result = array('request_failed' => 'Failed to process request.');
            return $result;
        } finally {
            $stmt->close();
        }
    }
}
