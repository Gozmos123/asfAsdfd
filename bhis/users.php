<!DOCTYPE html>
<?php
include('../includes/auth.php');
if (!($_SESSION['auth'][0]['user_type'] == "administrator")) {
    header('location: dashboard.php');
    exit();
}
$page = "Users";
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
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-12">
                                        <!-- <button class="btn btn-primary"><i class="fa fa-plus-circle"></i> Add New User</button> -->
                                    </div>
                                </div>
                                <table class="table table-responsive-sm mt-4">
                                    <thead>
                                        <tr>
                                            <th scope="col">Photo</th>
                                            <th scope="col">Username</th>
                                            <th scope="col">Name</th>
                                            <th scope="col">Last Login</th>
                                            <th scope="col">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        require_once('../model/User.php');
                                        $user = new User;

                                        $users = $user->getUsers();

                                        if ($users) {
                                            foreach ($users as $user) {
                                        ?>
                                                <tr>
                                                    <td><img src="<?php echo $user['photo']; ?>" alt="profile" width="50px" height="50px"></td>
                                                    <td><?php echo $user['username']; ?></td>
                                                    <td><?php echo $user['first_name'] . ' ' . $user['middle_name'] . ' ' . $user['last_name'] . ' ' . $user['prefix']; ?></td>
                                                    <td><?php echo $user['last_login_date']; ?></td>
                                                    <td>
                                                        <button class="btn btn-primary" id="btn_edit_user" data-id="<?php echo $user['username']; ?>" data-toggle="modal" data-target="#modal_edit_profile"><i class="fa fa-edit"></i> Edit</button>
                                                    </td>
                                                </tr>
                                        <?php
                                            }
                                        }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>

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

    <!-- modal -->
    <?php include('modals/modal_edit_user_profile.php'); ?>

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
                title: 'User Profile Updated Successfully.',
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
                text: 'Failed to update user profile, please try again.',
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

            $('button#btn_close_edit_profile').click(function(e) {
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

            $('button#btn_edit_user').click(function(e) {
                var username = $(this).data('id');

                $.ajax({
                    type: "post",
                    url: "../functions/auth/UpdateUserProfile.php",
                    data: {
                        request_user_details: 1,
                        username: username
                    },
                    dataType: "JSON",
                    success: function(response) {
                        if (response == "false" || response == "request_failed") {
                            Swal.fire({
                                icon: 'error',
                                title: 'Failed To Load User Details',
                                text: 'Something went wrong, failed to load user details. Please try again.',
                                allowOutsideClick: false
                            });
                        } else {
                            $('#username').val(response[0]['username']);
                            $('#first_name').val(response[0]['first_name']);
                            $('#middle_name').val(response[0]['middle_name']);
                            $('#last_name').val(response[0]['last_name']);
                            $('#prefix').val(response[0]['prefix']);
                            $('#sex').val(response[0]['sex']);
                            $('#birthdate').val(response[0]['birthdate']);
                            $('#birthplace').val(response[0]['birthplace']);
                            $('#civil_status').val(response[0]['civil_status']);
                            $('#other_status').val(response[0]['other_status']);
                            $('#religion').val(response[0]['religion']);
                            $('#purok_name').val(response[0]['purok_name']);
                            $('#email').val(response[0]['email']);
                            $('#contact_no').val(response[0]['contact_no']);
                        }
                    }
                });
            });

        });
    </script>
</body>

</html>