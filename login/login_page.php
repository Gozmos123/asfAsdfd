<?php
if ($_SERVER['REQUEST_METHOD'] == 'GET' && realpath(__FILE__) == realpath($_SERVER['SCRIPT_FILENAME'])) {
    header("location: ../login/");
    exit();
}
$page = 'login';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BHIS Login</title>
    <!-- styles -->
    <link rel="stylesheet" href="../resources/css/bootstrap.css">
    <!-- sweet alert -->
    <link rel="stylesheet" href="../resources/sweetalert2/sweetalert2.min.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous" />
    <!-- font family -->
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
    <!-- boxicon -->
    <link href="https://cdn.jsdelivr.net/npm/boxicons@2.0.5/css/boxicons.min.css" rel="stylesheet" />

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
                    <form class="card-body cardbody-color p-lg-5 needs-validation" novalidate id="form_login">
                        <div class="text-center">
                            <img src="../resources/images/sys_logo.png" class="img-fluid profile-image-pic img-thumbnail rounded-circle my-3" width="200px" alt="profile">
                        </div>
                        <div class="mb-3">
                            <h4 class="font-weight-bold text-weight text-center">BHIS</h4>
                        </div>
                        <div class="mb-3">
                            <input type="text" class="form-control" id="username" aria-describedby="username" placeholder="User Name" name="username" required>
                            <div class="invalid-feedback">
                                Username is required.
                            </div>
                        </div>
                        <div class="mb-4">
                            <input type="password" class="form-control" id="password" placeholder="Password" name="password" required>
                            <div class="invalid-feedback">
                                Password is required.
                            </div>
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
                            <button type="submit" class="btn btn-color px-5 mb-5 w-100" id="btn_login">Login</button>
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
                    <img src="../resources/images/sys_logo.png" width="30" height="30" class="rounded" alt="sys_logo">
                </center>
            </div>
            <div class="col-12">
                <center>
                    <p class="font-weight-normal text-white">&copy; All Rights Reserved 2023</p>
                </center>
            </div>
        </div>
    </footer>

    <!-- scripts -->
    <script src="../resources/js/script.js"></script>
    <!-- bootstrap -->
    <script src="../resources/js/bootstrap.js"></script>
    <!-- jquery -->
    <script src="../resources/js/jquery-3.6.3.min.js"></script>
    <!-- sweet alert -->
    <script src="../resources/sweetalert2/sweetalert2.min.js"></script>

    <!-- script -->
    <script src="login.js"></script>
</body>

</html>