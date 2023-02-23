<!DOCTYPE html>
<?php
include('../includes/auth.php');
$page = "dashboard";
?>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <!-- style -->
    <?php include('../includes/styles.php'); ?>
</head>

<body>
    <button id="sample">Sweet Alert</button>

    <form action="logout.php" method="post">
        <button type="submit" class="btn btn-primary">Logout</button>
    </form>

    <!-- scripts -->
    <?php include('../includes/scripts.php'); ?>
    <script>
        $(document).ready(function() {
            $('#sample').click(function(e) {
                e.preventDefault();
                Swal.fire(
                    'Good job!',
                    'You clicked the button!',
                    'success'
                );
                $.ajax({
                    type: "method",
                    url: "url",
                    data: "data",
                    dataType: "dataType",
                    success: function (response) {
                        
                    }
                });
            });
        });
    </script>
</body>

</html>