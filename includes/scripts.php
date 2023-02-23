<?php
if ($_SERVER['REQUEST_METHOD'] == 'GET' && realpath(__FILE__) == realpath($_SERVER['SCRIPT_FILENAME'])) {
    header("location: ../index.php");
    exit();
}
?>
<!-- main -->
<script src="resources/js/bootstrap.js"></script>