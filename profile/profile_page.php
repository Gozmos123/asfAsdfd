<?php
if ($_SERVER['REQUEST_METHOD'] == 'GET' && realpath(__FILE__) == realpath($_SERVER['SCRIPT_FILENAME'])) {
    header('location: ../profile/');
    exit();
}
$page = "My Profile";
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
                        <section>
                            <div class="container py-5">
                                <div class="row">
                                    <?php
                                    require_once('../model/User.php');
                                    $users = new User;
                                    $user = $users->getUser_ByUsername($_SESSION['auth'][0]['username']);
                                    $_SESSION['auth'] = $user;
                                    ?>
                                    <div class="col-lg-4">
                                        <div class="card mb-4">
                                            <div class="card-body text-center">
                                                <img src="../<?php echo $user[0]['photo']; ?>" alt="avatar" class="rounded-circle img-fluid" style="width: 150px;">
                                                <h4 class="my-3" id="username"><?php echo $user[0]['username']; ?></h4>
                                                <p class="text-muted mb-1">BHIS <?php echo ucfirst($user[0]['user_type']); ?></p>
                                                <div class="d-flex justify-content-center mt-3">
                                                    <button type="button" class="btn btn-primary" id="btn_change_picture">Change Picture</button>
                                                </div>
                                                <div class="d-flex justify-content-center mb-2 mt-2">
                                                    <!-- edit profile -->
                                                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal_edit_profile" id="btn_edit_profile">Edit Profile</button>
                                                    <a href="<?php echo $link_activity_log; ?>"><button type="button" class="btn btn-outline-primary ms-1">Activity Log</button></a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-8">
                                        <div class="card mb-4">
                                            <div class="card-body">
                                                <div class="row">
                                                    <div class="col-sm-3">
                                                        <p class="mb-0">Full Name</p>
                                                    </div>
                                                    <div class="col-sm-9">
                                                        <p class="text-muted mb-0"><?php echo $user[0]['first_name'] . ' ' . $user[0]['middle_name'] . ' ' . $user[0]['last_name'] . ' ' . $user[0]['prefix']; ?></p>
                                                    </div>
                                                </div>
                                                <hr>
                                                <div class="row">
                                                    <div class="col-sm-3">
                                                        <p class="mb-0">Sex</p>
                                                    </div>
                                                    <div class="col-sm-9">
                                                        <p class="text-muted mb-0"><?php echo $user[0]['sex']; ?></p>
                                                    </div>
                                                </div>
                                                <hr>
                                                <div class="row">
                                                    <div class="col-sm-3">
                                                        <p class="mb-0">Date of Birth</p>
                                                    </div>
                                                    <div class="col-sm-9">
                                                        <p class="text-muted mb-0"><?php echo $user[0]['birthdate']; ?></p>
                                                    </div>
                                                </div>
                                                <hr>
                                                <div class="row">
                                                    <div class="col-sm-3">
                                                        <p class="mb-0">Age</p>
                                                    </div>
                                                    <div class="col-sm-9">
                                                        <p class="text-muted mb-0"><?php echo $user[0]['age']; ?></p>
                                                    </div>
                                                </div>
                                                <hr>
                                                <div class="row">
                                                    <div class="col-sm-3">
                                                        <p class="mb-0">Place of Birth</p>
                                                    </div>
                                                    <div class="col-sm-9">
                                                        <p class="text-muted mb-0"><?php echo $user[0]['birthplace']; ?></p>
                                                    </div>
                                                </div>
                                                <hr>
                                                <div class="row">
                                                    <div class="col-sm-3">
                                                        <p class="mb-0">Civil Status</p>
                                                    </div>
                                                    <div class="col-sm-9">
                                                        <?php
                                                        if (strtolower($user[0]['civil_status']) == 'other') {
                                                        ?>
                                                            <p class="text-muted mb-0"><?php echo $user[0]['other_status']; ?></p>
                                                        <?php
                                                        } else {
                                                        ?>
                                                            <p class="text-muted mb-0"><?php echo $user[0]['civil_status']; ?></p>
                                                        <?php
                                                        }
                                                        ?>
                                                    </div>
                                                </div>
                                                <hr>
                                                <div class="row">
                                                    <div class="col-sm-3">
                                                        <p class="mb-0">Religion</p>
                                                    </div>
                                                    <div class="col-sm-9">
                                                        <p class="text-muted mb-0"><?php echo $user[0]['religion']; ?></p>
                                                    </div>
                                                </div>
                                                <hr>
                                                <div class="row">
                                                    <div class="col-sm-3">
                                                        <p class="mb-0">Purok</p>
                                                    </div>
                                                    <div class="col-sm-9">
                                                        <p class="text-muted mb-0"><?php echo $user[0]['purok_name']; ?></p>
                                                    </div>
                                                </div>
                                                <hr>
                                                <div class="row">
                                                    <div class="col-sm-3">
                                                        <p class="mb-0">Email</p>
                                                    </div>
                                                    <div class="col-sm-9">
                                                        <p class="text-muted mb-0"><?php echo $user[0]['email']; ?></p>
                                                    </div>
                                                </div>
                                                <hr>
                                                <div class="row">
                                                    <div class="col-sm-3">
                                                        <p class="mb-0">Contact Number</p>
                                                    </div>
                                                    <div class="col-sm-9">
                                                        <p class="text-muted mb-0"><?php echo $user[0]['contact_no']; ?></p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-4">
                                    </div>
                                    <div class="col-lg-8">
                                        <div class="card mb-4">
                                            <div class="card-body">
                                                <div class="row">
                                                    <div class="mb-4">
                                                        <h3>Update Password</h3>
                                                    </div>
                                                </div>
                                                <form id="form_change_password" class="needs-validation" novalidate action="#">
                                                    <div class="row">
                                                        <div class="col-sm-10">
                                                            <label for="current_password" class="form-label">Current Password</label>
                                                            <input type="password" class="form-control" id="current_password" value="" required>
                                                            <div class="invalid-feedback">
                                                                Enter your current password.
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <hr>
                                                    <div class="row">
                                                        <div class="col-sm-10">
                                                            <label for="password" class="form-label">New Password</label>
                                                            <input type="password" class="form-control" id="password" value="" required minlength="8">
                                                            <div class="invalid-feedback">
                                                                Enter your new password. (Minimum of 8 characters.)
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row mt-3">
                                                        <div class="col-sm-10">
                                                            <label for="password_confirmation" class="form-label">Confirm Password</label>
                                                            <input type="password" class="form-control" id="password_confirmation" value="" required minlength="8">
                                                            <div class="invalid-feedback">
                                                                Please confirm your new password.
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <hr>
                                                    <div class="row">
                                                        <div class="col-sm-9">
                                                            <button type="submit" class="btn btn-primary" id="btn_change_password">Change Password</button>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </section>
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
    <?php include('modals/modal_edit_profile.php') ?>

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

    <!-- alerts -->
    <?php include('alerts.php') ?>

    <script src="profile.js"></script>

</body>

</html>