<?php
if ($_SERVER['REQUEST_METHOD'] == 'GET' && realpath(__FILE__) == realpath($_SERVER['SCRIPT_FILENAME'])) {
    header('location: ../activity_logs/');
    exit();
}
$page = "Activity Logs";
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo ucfirst($page); ?></title>
    <!-- styles -->
    <link rel="stylesheet" href="../resources/css/bootstrap.css">
    <!-- sweet alert -->
    <link rel="stylesheet" href="../resources/sweetalert2/sweetalert2.min.css">
    <!-- sb-admin -->
    <link rel="stylesheet" href="../resources/sb-admin/css/sb-admin-2.min.css">

    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous" />
    <!-- font family -->
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
    <!-- boxicon -->
    <link href="https://cdn.jsdelivr.net/npm/boxicons@2.0.5/css/boxicons.min.css" rel="stylesheet" />
    <!-- dataTable -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.3/css/jquery.dataTables.css">
</head>

<body id="page-top">
    <!-- Page Wrapper -->
    <div id="wrapper">
        <?php
        include('../_includes/nav_links.php');
        ?>
        <!-- sidebar -->
        <?php include('../_includes/sidebar_inc.php'); ?>

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">
                <!-- topbar -->
                <?php include('../_includes/navbar_inc.php'); ?>

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <div class="d-lg-none d-md-none d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800"><?php echo ucfirst($page); ?></h1>
                    </div>

                    <!-- Content Row -->
                    <div class="row">
                        <table class="table table-responsive-sm" id="table_activity_logs">
                            <thead>
                                <tr>
                                    <th scope="col">Username</th>
                                    <th scope="col">Action</th>
                                    <th scope="col">Date</th>
                                    <th scope="col">View</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                require_once('../model/ActivityLog.php');
                                $activity_log = new ActivityLog;

                                if ($_SESSION['auth'][0]['user_type'] == "administrator") {
                                    $logs = $activity_log->getActivityLogsAll();
                                } else {
                                    $logs = $activity_log->getActivityLogs_ByUsername($_SESSION['auth'][0]['username']);
                                }

                                if ($logs) {
                                    foreach ($logs as $log) {
                                ?>
                                        <tr>
                                            <td><?php echo $log['username']; ?></td>
                                            <td><?php echo $log['action']; ?></td>
                                            <td><?php echo $log['created_at']; ?></td>
                                            <td><button class="btn btn-secondary" id="btn_view_log" data-id="<?php echo $log['id']; ?>" data-toggle="modal" data-target="#modal_view_log">View</button></td>
                                        </tr>
                                <?php
                                    }
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
                <!-- /.container-fluid -->
            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            <?php include('../_includes/footer_inc.php'); ?>

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- modals -->
    <?php include('modals/modal_view_log.php'); ?>

    <!-- scripts -->
    <script src="../resources/js/script.js"></script>
    <!-- bootstrap -->
    <script src="../resources/js/bootstrap.js"></script>
    <!-- jquery -->
    <script src="../resources/js/jquery-3.6.3.min.js"></script>
    <!-- sweet alert -->
    <script src="../resources/sweetalert2/sweetalert2.min.js"></script>

    <!-- sb-admin preqrequiste -->
    <!-- sb-admin jquery & bootstrap -->
    <script src="../resources/sb-admin/jquery/jquery.min.js"></script>
    <script src="../resources/sb-admin/js/bootstrap/bootstrap.bundle.min.js"></script>
    <!-- jquery-easing -->
    <script src="../resources/sb-admin/jquery-easing/jquery.easing.min.js"></script>
    <!-- sb-admin script -->
    <script src="../resources/sb-admin/js/sb-admin-2.min.js"></script>
    <!-- dataTable -->
    <script src="https://cdn.datatables.net/1.13.3/js/jquery.dataTables.js"></script>

    <script src="activity_logs.js"></script>
</body>

</html>