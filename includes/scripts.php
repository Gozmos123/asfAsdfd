<?php
if ($_SERVER['REQUEST_METHOD'] == 'GET' && realpath(__FILE__) == realpath($_SERVER['SCRIPT_FILENAME'])) {
    header('location: ../index.php');
    exit();
}
?>
<script src="resources/js/bootstrap.js"></script>
<script src="resources/js/jquery-3.6.3.min.js"></script>
<script src="../resources/js/bootstrap.js"></script>
<script src="../resources/js/jquery-3.6.3.min.js"></script>
<!-- sweeet alert -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.2/dist/sweetalert2.all.min.js"></script>