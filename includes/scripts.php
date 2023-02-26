<?php
if ($_SERVER['REQUEST_METHOD'] == 'GET' && realpath(__FILE__) == realpath($_SERVER['SCRIPT_FILENAME'])) {
    header('location: ../index.php');
    exit();
}
?>
<!-- main script -->
<script src="resources/js/script.js"></script>
<script src="../resources/js/script.js"></script>

<!-- bootstrap -->
<script src="resources/js/bootstrap.js"></script>
<script src="../resources/js/bootstrap.js"></script>
<!-- <script src="../resources/js/bootstrap.bundle.min.js"></script> -->

<!-- jquery -->
<script src="resources/js/jquery-3.6.3.min.js"></script>
<script src="../resources/js/jquery-3.6.3.min.js"></script>

<!-- sb-admin -->
<!-- prerequisites -->
<script src="../resources/sb-admin/jquery/jquery.min.js"></script>
<script src="../resources/sb-admin/js/bootstrap/bootstrap.bundle.min.js"></script>
<!-- end -->
<!-- component -->
<script src="../resources/sb-admin/jquery-easing/jquery.easing.min.js"></script>
<script src="../resources/sb-admin/js/sb-admin-2.min.js"></script>
<!--  -->

<!-- sweeet alert -->
<!-- <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.2/dist/sweetalert2.all.min.js"></script> -->
<script src="resources/sweetalert2/sweetalert2.min.js"></script>
<script src="../resources/sweetalert2/sweetalert2.min.js"></script>

<!-- validate plugin -->
<!-- <script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.5/dist/jquery.validate.min.js"></script> -->