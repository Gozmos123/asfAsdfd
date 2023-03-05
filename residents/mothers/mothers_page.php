<?php
if ($_SERVER['REQUEST_METHOD'] == 'GET' && realpath(__FILE__) == realpath($_SERVER['SCRIPT_FILENAME'])) {
    header('location: ../mothers/');
    exit();
}
$page = "mothers";
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo ucfirst($page); ?></title>
    <!-- styles -->
    <link rel="stylesheet" href="../../resources/css/bootstrap.css">
    <!-- sweet alert -->
    <link rel="stylesheet" href="../../resources/sweetalert2/sweetalert2.min.css">
    <!-- sb-admin -->
    <link rel="stylesheet" href="../../resources/sb-admin/css/sb-admin-2.min.css">

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
        include('../../_includes/nav_links.php');

        // navbar
        $link_profile = '../../profile/';
        $link_options = '../../options/';
        $link_activity_log = '../../activity_logs/';

        // sidebar
        $link_dashboard = '../../dashboard/';
        $link_users = '../../users/';
        $link_mothers = '../mothers/';
        $link_childrens = '../childrens/';
        $link_vitamins = '../../distributions/vitamins/';
        $link_deworming = '../../distributions/deworming/';
        $link_weights = '../../monitoring/weights/';
        $link_immunizations = '../../monitoring/immunizations/';
        $link_logout = '../../logout/index.php';

        // img logo
        $logo_sidebar = '../';
        $logo_navbar = '../';
        ?>
        <!-- sidebar -->
        <?php include('../../_includes/sidebar_inc.php'); ?>

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">
                <!-- topbar -->
                <?php include('../../_includes/navbar_inc.php'); ?>

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
                                    <?php
                                    if (!($_SESSION['auth'][0]['user_type'] == "user")) {
                                    ?>
                                        <div class="col-md-12 mb-4">
                                            <button class="btn btn-primary" id="btn_add_mother" data-toggle="modal" data-target="#modal_add_mother"><i class="fa fa-plus-circle"></i> Add New Mother</button>
                                        </div>

                                    <?php
                                    }
                                    ?>
                                </div>
                                <table class="table table-responsive-sm" id="table_mothers">
                                    <thead>
                                        <tr>
                                            <th scope="col">Photo</th>
                                            <th scope="col">Name</th>
                                            <th scope="col">Age</th>
                                            <th scope="col">Sex</th>
                                            <th scope="col">Civil Status</th>
                                            <th scope="col">Purok</th>
                                            <th scope="col">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        require_once('../../model/residents/Mother.php');
                                        require_once('../../model/Secure.php');

                                        $mother = new Mother;

                                        $mothers = $mother->getMothersAll();

                                        if ($mothers) {
                                            foreach ($mothers as $mother) {
                                        ?>
                                                <tr>
                                                    <td><img src="../../<?php echo $mother['photo']; ?>" alt="profile" width="50px" height="50px"></td>
                                                    <td><?php echo $mother['first_name'] . ' ' . $mother['middle_name'] . ' ' . $mother['last_name']; ?></td>
                                                    <td><?php echo $mother['age']; ?></td>
                                                    <td><?php echo $mother['sex']; ?></td>
                                                    <?php
                                                    if ($mother['civil_status'] == "Other") {
                                                        $civil_status = $mother['other_status'];
                                                    } else {
                                                        $civil_status = $mother['civil_status'];
                                                    }
                                                    ?>
                                                    <td><?php echo $civil_status; ?></td>
                                                    <td><?php echo $mother['purok_name']; ?></td>
                                                    <td>
                                                        <?php
                                                        if (!($_SESSION['auth'][0]['user_type'] == "user")) {
                                                        ?>

                                                            <button class="btn btn-primary" id="btn_edit_mother" data-id="<?php echo $mother['id']; ?>" data-toggle="modal" data-target="#modal_edit_mother"><i class="fa fa-edit"></i> Edit</button>
                                                            <button class="btn btn-primary" id="btn_add_children" data-id="<?php echo $mother['id']; ?>" data-toggle="modal" data-target="#modal_add_children"><i class="fa fa-plus-circle"></i> Add Children</button>
                                                        <?php
                                                        }
                                                        ?>
                                                        <?php
                                                        $id = Secure::encrypt($mother['id']);
                                                        // die($id);
                                                        ?>
                                                        <a href="../childrens/?q=<?php echo $id; ?>">
                                                            <button class="btn btn-primary" id="btn_view_childrens"><i class="fa fa-eye"></i> Childrens</button>
                                                        </a>
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
            <?php include('../../_includes/footer_inc.php'); ?>
        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- modal -->
    <?php
    include('modals/modal_add_mother.php');
    include('modals/modal_edit_mother.php');
    include('modals/modal_add_children.php');
    ?>

    <!-- scripts -->
    <script src="../../resources/js/script.js"></script>
    <!-- bootstrap -->
    <script src="../../resources/js/bootstrap.js"></script>
    <!-- jquery -->
    <script src="../../resources/js/jquery-3.6.3.min.js"></script>
    <!-- sweet alert -->
    <script src="../../resources/sweetalert2/sweetalert2.min.js"></script>

    <!-- sb-admin preqrequiste -->
    <!-- sb-admin jquery & bootstrap -->
    <script src="../../resources/sb-admin/jquery/jquery.min.js"></script>
    <script src="../../resources/sb-admin/js/bootstrap/bootstrap.bundle.min.js"></script>
    <!-- jquery-easing -->
    <script src="../../resources/sb-admin/jquery-easing/jquery.easing.min.js"></script>
    <!-- sb-admin script -->
    <script src="../../resources/sb-admin/js/sb-admin-2.min.js"></script>
    <!-- dataTable -->
    <script src="https://cdn.datatables.net/1.13.3/js/jquery.dataTables.js"></script>

    <?php include('alerts.php'); ?>

    <script src="mothers.js"></script>
</body>

</html>