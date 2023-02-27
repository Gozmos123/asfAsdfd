<!DOCTYPE html>
<?php
include('../includes/auth.php');
$page = "Activity Logs";
?>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo ucfirst($page); ?></title>
    <!-- style -->
    <?php include('../includes/styles.php'); ?>

</head>

<body id="page-top">
    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- sidebar -->
        <?php include('../includes/sidebar_inc.php'); ?>

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">
                <!-- topbar -->
                <?php include('../includes/navbar_inc.php'); ?>

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <div class="d-lg-none d-md-none d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800"><?php echo ucfirst($page); ?></h1>
                    </div>

                    <!-- Content Row -->
                    <div class="row">
                        <table class="table table-responsive-sm">
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

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- modals -->
    <?php include('modals/modal_view_log.php'); ?>

    <!-- scripts -->
    <?php include('../includes/scripts.php'); ?>
    <script>
        $(document).ready(function() {

            $('button#btn_view_log').click(function(e) {
                // e.preventDefault();
                var log_id = $(this).data('id');

                $.ajax({
                    type: "post",
                    url: "../functions/log/RequestLogDetails.php",
                    data: {
                        id: log_id
                    },
                    dataType: "JSON",
                    success: function(response) {
                        if (response == "false" || response == "request_failed") {
                            Swal.fire({
                                icon: 'error',
                                title: 'Failed To Load Log',
                                text: 'Something went wrong, failed to load log details. Please try again.',
                                allowOutsideClick: false
                            });
                        } else {
                            $('#username').text(response[0]['username']);
                            $('#action').text(response[0]['action']);
                            $('#log_content').text(response[0]['content']);
                            $('#log_changes').text(response[0]['changes']);
                            $('#date').text(response[0]['created_at']);
                        }
                    }
                });
            });
        });
    </script>
</body>

</html>