<?php
if ($_SERVER['REQUEST_METHOD'] == 'GET' && realpath(__FILE__) == realpath($_SERVER['SCRIPT_FILENAME'])) {
    header('location: ../childrens/');
    exit();
}
$page = "Childrens";
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
                        <?php
                        if (isset($_REQUEST['view'])) {
                            require_once('../../model/Secure.php');
                            require_once('../../model/residents/Children.php');
                            require_once('../../model/residents/Mother.php');

                            $child_id = Secure::decrypt($_REQUEST['view']);

                            $child = new Children;
                            $mother = new Mother;

                            $children = $child->getChildren_ByID($child_id);

                            if ($children) {
                                $requested_specific = 'child_profile';

                                $mother = $mother->getMother_ByID($children[0]['mother_id']);
                                include('childrens_profile.php');
                            } else {
                                include('childrens_list.php');
                            }
                        } else {
                            include('childrens_list.php');
                        }
                        ?>
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
    <?php
    include('modals/modal_edit_children.php');
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

    <?php include('alerts.php'); ?>

    <script src="childrens.js"></script>
</body>

</html>