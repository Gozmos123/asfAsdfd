<?php
session_start();
if (isset($_SESSION['auth'])) {
    header('location: bhis/dashboard.php');
    exit();
}
$page = 'index';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BHIS Login</title>
    <?php include('includes/styles.php'); ?>
    <style>
        body {
            background: rgb(2, 0, 36);
            background: linear-gradient(90deg, rgba(2, 0, 36, 1) 0%, rgba(9, 9, 121, 1) 35%, rgba(0, 212, 255, 1) 100%);
        }

        .btn-color {
            background-color: #0e1c36;
            color: #fff;
        }

        .profile-image-pic {
            height: 200px;
            width: 200px;
            object-fit: cover;
        }

        .cardbody-color {
            background-color: #ebf2fa;
        }

        a {
            text-decoration: none;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="row">
            <div class="col-md-6 offset-md-3">
                <div class="card my-5">
                    <form class="card-body cardbody-color p-lg-5">
                        <div class="text-center">
                            <img src="resources/images/sys_logo.png" class="img-fluid profile-image-pic img-thumbnail rounded-circle my-3" width="200px" alt="profile">
                        </div>
                        <div class="mb-3">
                            <h4 class="font-weight-bold text-weight text-center">BHIS</h4>
                        </div>
                        <div class="mb-3">
                            <input type="text" class="form-control" id="username" aria-describedby="emailHelp" placeholder="User Name" name="username" required>
                        </div>
                        <div class="mb-4">
                            <input type="password" class="form-control" id="password" placeholder="Password" name="password" required>
                            <div class="form-check mx-2 mt-2">
                                <span>
                                    <input class="form-check-input" type="checkbox" value="" id="show_password" unchecked>
                                    <label class="form-check-label" for="show_password" id="show_password">
                                        Show Password
                                    </label>
                                </span>
                            </div>
                        </div>
                        <div class="text-center">
                            <button type="submit" class="btn btn-color px-5 mb-5 w-100" name="login_request" id="btn_login">Login</button>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>

    <footer class="container-fluid d-flex align-items-center justify-content-center mb-0 mt-5">
        <div class="row d-flex justify-content-center">
            <div class="col-12">
                <center>
                    <img src="resources/images/sys_logo.png" width="30" height="30" class="rounded" alt="sys_logo">
                </center>
            </div>
            <div class="col-12">
                <center>
                    <p class="font-weight-normal text-white">&copy; All Rights Reserved 2023</p>
                </center>
            </div>
        </div>
    </footer>

    <?php include('includes/scripts.php'); ?>
    <script>
        $(document).ready(function() {
            $('#show_password').click(function(e) {
                // e.preventDefault();
                var passwd = document.getElementById('password');
                if (passwd.type === "password") {
                    passwd.type = "text";
                } else {
                    passwd.type = "password";
                }
            });

            $('button#btn_login').click(function(e) {
                e.preventDefault();
                var username = $('#username').val();
                var password = $('#password').val();
                if (username.trim() == "" || password.trim() == "") {
                    Swal.fire({
                        icon: 'error',
                        title: 'Empty Fields',
                        text: 'Please enter a username and password.'
                    });
                } else {
                    $.ajax({
                        type: "post",
                        url: "functions/auth/AuthenticateLogin.php",
                        data: {
                            username: username,
                            password: password
                        },
                        dataType: "JSON",
                        success: function(response) {
                            // console.log(response);
                            if (response == 'request_failed') {
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Login Failed',
                                    text: 'Something went wrong, failed to process request. Please try again.'
                                });
                            } else if (response == "false") {
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Login Failed',
                                    text: 'Incorrect username or password. Please try again.'
                                });
                            } else {
                                location.href = 'bhis/dashboard.php';
                            }
                        }
                    });
                }
            });
        });
    </script>
</body>

</html>