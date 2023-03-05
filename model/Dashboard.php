<?php
if ($_SERVER['REQUEST_METHOD'] == 'GET' && realpath(__FILE__) == realpath($_SERVER['SCRIPT_FILENAME'])) {
    header('location: ../');
    exit();
}
require_once __DIR__ . '/Database.php';

class Dashboard extends Database
{
    function __construct()
    {
        parent::__construct();
    }

    function __destruct()
    {
        $this->con->close();
    }

    function getTotalUser()
    {
        $result = array();

        $query = "select count(id) as TotalUsers from users;";
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

    function getTotalMothers()
    {
        $result = array();

        $query = "select count(id) as TotalMothers from mothers;";
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

    function getTotalChildrens()
    {
        $result = array();

        $query = "select count(id) as TotalChildrens from childrens;";
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

    function getTotalReceived_Vitamins()
    {
        $result = array();

        $query = "select count(distinct(children_id)) as TotalReceivedVitamins from vitamins;";
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

    function getTotalNotReceived_Vitamins()
    {
        $result = array();

        $query = "select count(distinct(children_id)) as TotalReceivedVitamins, ((select count(id) as TotalChildren from childrens) - (select count(distinct(children_id)))) as TotalNotReceived from vitamins;";
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

    function getTotalReceived_Deworming()
    {
        $result = array();

        $query = "select count(distinct(children_id)) as TotalReceivedDeworming from deworms;";
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

    function getTotalNotReceived_Deworming()
    {
        $result = array();

        $query = "select count(distinct(children_id)) as TotalReceivedDeworming, ((select count(id) as TotalChildren from childrens) - (select count(distinct(children_id)))) as TotalNotReceived from deworms;";
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

    function getTotalMeasured()
    {
        $result = array();

        $query = "select count(distinct(children_id)) as TotalMeasured from weights;";
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

    function getTotalNotMeasured()
    {
        $result = array();

        $query = "select count(distinct(children_id)) as TotalMeasured, ((select count(id) as TotalChildren from childrens) - (select count(distinct(children_id)))) as TotalNotMeasured from weights;";
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

    function getTotalImmunized()
    {
        $result = array();

        $query = "select count(distinct(children_id)) as TotalImmunized from immunizations;";
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

    function getTotalNotImmunized()
    {
        $result = array();

        $query = "select count(distinct(children_id)) as TotalImmunized, ((select count(id) as TotalChildren from childrens) - (select count(distinct(children_id)))) as TotalNotImmunized from immunizations;";
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
};
