<!DOCTYPE html>
<?php
include('../includes/auth.php');
$page = "My Profile";
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
                                                <img src="<?php echo $user[0]['photo']; ?>" alt="avatar" class="rounded-circle img-fluid" style="width: 150px;">
                                                <h4 class="my-3" id="username"><?php echo $user[0]['username']; ?></h4>
                                                <p class="text-muted mb-1">BHIS <?php echo ucfirst($user[0]['user_type']); ?></p>
                                                <div class="d-flex justify-content-center mt-3">
                                                    <button type="button" class="btn btn-primary" id="btn_change_picture">Change Picture</button>
                                                </div>
                                                <div class="d-flex justify-content-center mb-2 mt-2">
                                                    <!-- edit profile -->
                                                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal_edit_profile" id="btn_edit_profile">Edit Profile</button>
                                                    <a href="activity_logs.php"><button type="button" class="btn btn-outline-primary ms-1">Activity Log</button></a>
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
                                                            <input type="password" class="form-control" id="password" value="" required>
                                                            <div class="invalid-feedback">
                                                                Enter your new password.
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row mt-3">
                                                        <div class="col-sm-10">
                                                            <label for="password_confirmation" class="form-label">Confirm Password</label>
                                                            <input type="password" class="form-control" id="password_confirmation" value="" required>
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
    <?php include('../includes/scripts.php'); ?>
    <!-- success -->
    <?php
    if (isset($_SESSION['update_success'])) {
        unset($_SESSION['update_success']);
    ?>
        <script>
            Swal.fire({
                // toast: true,
                // position: 'top',
                icon: 'success',
                title: 'Profile Updated Successfully.',
                confirmButtonText: 'Ok',
                // showConfirmButton: false,
                timer: 3000,
                timerProgressBar: true,
                didOpen: (toast) => {
                    // Swal.showLoading()
                    toast.addEventListener('mouseenter', Swal.stopTimer)
                    toast.addEventListener('mouseleave', Swal.resumeTimer)
                }
            });
        </script>
    <?php
    }
    ?>
    <!-- request failed -->
    <?php
    if (isset($_SESSION['request_failed'])) {
        unset($_SESSION['request_failed']);
    ?>
        <script>
            Swal.fire({
                // toast: true,
                // position: 'top',
                icon: 'error',
                title: 'Something went wrong.',
                text: 'Failed to update profile, please try again.',
                confirmButtonText: 'Ok',
                // showConfirmButton: false,
                timer: 3000,
                timerProgressBar: true,
                didOpen: (toast) => {
                    // Swal.showLoading()
                    toast.addEventListener('mouseenter', Swal.stopTimer)
                    toast.addEventListener('mouseleave', Swal.resumeTimer)
                }
            });
        </script>
    <?php
    }
    ?>

    <script>
        const current_date = new Date().toLocaleDateString('fr-ca');
        birthdate.max = current_date;

        function civil_status_change() {
            if (document.getElementById('civil_status').value === "Other") {
                other_status.required = true;
            } else {
                other_status.required = false;
            }
        }

        $(document).ready(function() {
            civil_status_change();

            $('#btn_close_edit_profile').click(function(e) {
                e.preventDefault();
                Swal.fire({
                    title: 'Are you sure you want to cancel editing?',
                    text: "All changes will be discarded!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes',
                    allowOutsideClick: false
                }).then((result) => {
                    if (result.isConfirmed) {
                        location.reload();
                    }
                });
            });

            $('button#btn_change_password').click(function(e) {
                var username = $('#username').text();
                var current_password = $('#current_password').val();
                var password = $('#password').val();
                var password_confirmation = $('#password_confirmation').val();

                if (!(current_password.trim() == "" || password.trim() == "" || password_confirmation.trim() == "")) {
                    e.preventDefault();
                    $.ajax({
                        type: "post",
                        url: "../functions/auth/ChangePassword.php",
                        data: {
                            verify_password: 1,
                            username: username,
                            password: current_password
                        },
                        dataType: "JSON",
                        success: function(response) {
                            if (response == "request_failed") {
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Change Password Failed',
                                    text: 'Something went wrong, failed to process request. Please try again.',
                                    allowOutsideClick: false
                                });
                            } else if (response == "false") {
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Current password is incorrect.',
                                    allowOutsideClick: false
                                });
                            } else {
                                if (password != password_confirmation) {
                                    Swal.fire({
                                        icon: 'error',
                                        title: 'New password and confirmation do not match.',
                                        allowOutsideClick: false
                                    });
                                } else {
                                    $.ajax({
                                        type: "post",
                                        url: "../functions/auth/ChangePassword.php",
                                        data: {
                                            change_password: 1,
                                            username: username,
                                            password: password_confirmation
                                        },
                                        dataType: "JSON",
                                        success: function(response) {
                                            if (response == "true") {
                                                Swal.fire({
                                                    // toast: true,
                                                    // position: 'top',
                                                    icon: 'success',
                                                    title: 'Password Changed Successfully.',
                                                    confirmButtonText: 'Ok',
                                                    // showConfirmButton: false,
                                                    timer: 3000,
                                                    timerProgressBar: true,
                                                    didOpen: (toast) => {
                                                        // Swal.showLoading()
                                                        toast.addEventListener('mouseenter', Swal.stopTimer)
                                                        toast.addEventListener('mouseleave', Swal.resumeTimer)
                                                    }
                                                }).then((result) => {
                                                    $('#current_password').val('');
                                                    $('#password').val('');
                                                    $('#password_confirmation').val('');
                                                });
                                            } else {
                                                Swal.fire({
                                                    icon: 'error',
                                                    title: 'Change Password Failed',
                                                    text: 'Something went wrong, failed to change password. Please try again.',
                                                    allowOutsideClick: false
                                                });
                                            }
                                        }
                                    });
                                }
                            }
                        }
                    });
                }
            });
        });
    </script>
</body>

</html>