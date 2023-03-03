<?php
if ($_SERVER['REQUEST_METHOD'] == 'GET' && realpath(__FILE__) == realpath($_SERVER['SCRIPT_FILENAME'])) {
    header('location: ../options/');
    exit();
}
$page = "Options";
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
                        <!-- Page Heading -->
                        <section>
                            <div class="">
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="card mb-4">
                                            <div class="card-body">
                                                <div class="row">
                                                    <div class="col-md-9">
                                                        <h4 class="card-title">Civil Status</h4>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <button class="btn btn-primary" id="btnAddCivilStatus" data-toggle="modal" data-target="#modal_civil_status_add_new"><i class="fa fa-plus-circle"></i> Add New</button>
                                                    </div>
                                                </div>
                                                <div class="row mt-3">
                                                    <table class="table table-responsive-sm" id="table_civil_status">
                                                        <thead>
                                                            <tr>
                                                                <th scope="col">Civil Status</th>
                                                                <th scope="col">Action</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <?php
                                                            require_once('../model/CivilStatus.php');
                                                            $civil_status = new CivilStatus;

                                                            $status_lists = $civil_status->getCivilStatusAll();

                                                            if ($status_lists) {
                                                                foreach ($status_lists as $status_list) {
                                                            ?>
                                                                    <tr>
                                                                        <td><?php echo $status_list['civil_status']; ?></td>
                                                                        <td>
                                                                            <?php
                                                                            if (!($status_list['civil_status'] == "Other" || $status_list['civil_status'] == "Single" || $status_list['civil_status'] == "Married")) {
                                                                            ?>
                                                                                <button class="btn btn-primary" id="btn_edit_status" data-id="<?php echo $status_list['id']; ?>" data-toggle="modal" data-target="#modal_civil_status_edit"><i class="fa fa-edit"></i></button>
                                                                                <!-- <button class="btn btn-danger" id="btn_delete_status" data-id="<?php echo $status_list['id']; ?>"><i class="fa fa-trash"></i></button> -->
                                                                            <?php
                                                                            } else {
                                                                            ?>
                                                                                <button class="btn btn-primary"><i class="fa fa-stop"></i></button>
                                                                            <?php
                                                                            }
                                                                            ?>
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
                                    <div class="col-lg-6">
                                        <div class="card mb-4">
                                            <div class="card-body">
                                                <div class="row">
                                                    <div class="col-md-9">
                                                        <h4 class="card-title">Immunizations Type</h4>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <button class="btn btn-primary" id="btnAddImmuneType" data-toggle="modal" data-target="#modal_immune_add"><i class="fa fa-plus-circle"></i> Add New</button>
                                                    </div>
                                                </div>
                                                <div class="row mt-3">
                                                    <table class="table table-responsive-sm" id="table_immunizations_type">
                                                        <thead>
                                                            <tr>
                                                                <th scope="col">Immunization Type</th>
                                                                <th scope="col">Action</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <?php
                                                            require_once('../model/ImmunizationType.php');
                                                            $immune_types = new ImmunizationType;

                                                            $immune_lists = $immune_types->getImmunizationsTypeAll();

                                                            if ($immune_lists) {
                                                                foreach ($immune_lists as $immune_list) {
                                                            ?>
                                                                    <tr>
                                                                        <td><?php echo $immune_list['immunization_type']; ?></td>
                                                                        <td>
                                                                            <button class="btn btn-primary" id="btn_edit_immune" data-id="<?php echo $immune_list['id']; ?>" data-toggle="modal" data-target="#modal_immune_edit"><i class="fa fa-edit"></i></button>
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
                                </div>
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="card mb-4">
                                            <div class="card-body">
                                                <div class="row">
                                                    <div class="col-md-9">
                                                        <h4 class="card-title">Religions</h4>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <button class="btn btn-primary" id="btnAddReligion" data-toggle="modal" data-target="#modal_religion_add"><i class="fa fa-plus-circle"></i> Add New</button>
                                                    </div>
                                                </div>
                                                <div class="row mt-3">
                                                    <table class="table table-responsive-sm" id="table_religions">
                                                        <thead>
                                                            <tr>
                                                                <th scope="col">Religions</th>
                                                                <th scope="col">Action</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <?php
                                                            require_once('../model/Religion.php');
                                                            $religions = new Religion;

                                                            $religion_lists = $religions->getReligionAll();

                                                            if ($religion_lists) {
                                                                foreach ($religion_lists as $religion_list) {
                                                            ?>
                                                                    <tr>
                                                                        <td><?php echo $religion_list['religion_name']; ?></td>
                                                                        <td>
                                                                            <?php
                                                                            if (!($religion_list['religion_name'] == "Roman Catholic")) {
                                                                            ?>
                                                                                <button class="btn btn-primary" id="btn_edit_religion" data-id="<?php echo $religion_list['id']; ?>" data-toggle="modal" data-target="#modal_religion_edit"><i class="fa fa-edit"></i></button>
                                                                            <?php
                                                                            } else {
                                                                            ?>
                                                                                <button class="btn btn-primary"><i class="fa fa-stop"></i></button>
                                                                            <?php
                                                                            }
                                                                            ?>
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
                                    <div class="col-lg-6">
                                        <div class="card mb-4">
                                            <div class="card-body">
                                                <div class="row">
                                                    <div class="col-md-9">
                                                        <h4 class="card-title">Puroks</h4>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <button class="btn btn-primary" id="btnAddPurok" data-toggle="modal" data-target="#modal_purok_add_new"><i class="fa fa-plus-circle"></i> Add New</button>
                                                    </div>
                                                </div>
                                                <div class="row mt-3">
                                                    <table class="table table-responsive-sm" id="table_puroks">
                                                        <thead>
                                                            <tr>
                                                                <th scope="col">Purok Name</th>
                                                                <th scope="col">Action</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <?php
                                                            require_once('../model/Purok.php');
                                                            $puroks = new Purok;

                                                            $purok_lists = $puroks->getPurokAll();

                                                            if ($purok_lists) {
                                                                foreach ($purok_lists as $purok) {
                                                            ?>
                                                                    <tr>
                                                                        <td><?php echo $purok['purok_name']; ?></td>
                                                                        <td>
                                                                            <?php
                                                                            if (!($purok['purok_name'] == "1")) {
                                                                            ?>
                                                                                <button class="btn btn-primary" id="btn_edit_purok" data-id="<?php echo $purok['id']; ?>" data-toggle="modal" data-target="#modal_purok_edit"><i class="fa fa-edit"></i></button>
                                                                            <?php
                                                                            } else {
                                                                            ?>
                                                                                <button class="btn btn-primary"><i class="fa fa-stop"></i></button>
                                                                            <?php
                                                                            }
                                                                            ?>
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
                                </div>
                            </div>
                        </section>
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

    <!-- modal -->
    <?php
    include('modals/modal_civil_status_add_new.php');
    include('modals/modal_civil_status_edit.php');
    include('modals/modal_immune_add.php');
    include('modals/modal_immune_edit.php');
    include('modals/modal_religion_add.php');
    include('modals/modal_religion_edit.php');
    include('modals/modal_purok_add_new.php');
    include('modals/modal_purok_edit.php');
    ?>

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

    <script src="options.js"></script>

</body>

</html>