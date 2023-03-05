<!-- updated -->
<?php
if (isset($_SESSION['updated'])) {
    unset($_SESSION['updated']);
?>
    <script>
        Swal.fire({
            // toast: true,
            // position: 'top',
            icon: 'success',
            title: 'Children Successfully Updated.',
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
            text: 'Failed to process request, please try again.',
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


<?php
if (isset($_SESSION['saved-immunization'])) {
    unset($_SESSION['saved-immunization']);
?>
    <script>
        Swal.fire({
            icon: 'success',
            title: 'Immunization Successfully Added.',
            confirmButtonText: 'Ok',
            timer: 3000,
            timerProgressBar: true,
            didOpen: (toast) => {
                toast.addEventListener('mouseenter', Swal.stopTimer)
                toast.addEventListener('mouseleave', Swal.resumeTimer)
            }
        });
    </script>
<?php
}
?>

<?php
if (isset($_SESSION['saved-weights'])) {
    unset($_SESSION['saved-weights']);
?>
    <script>
        Swal.fire({
            icon: 'success',
            title: 'Weight Successfully Added.',
            confirmButtonText: 'Ok',
            timer: 3000,
            timerProgressBar: true,
            didOpen: (toast) => {
                toast.addEventListener('mouseenter', Swal.stopTimer)
                toast.addEventListener('mouseleave', Swal.resumeTimer)
            }
        });
    </script>
<?php
}
?>

<?php
if (isset($_SESSION['saved-vitamin'])) {
    unset($_SESSION['saved-vitamin']);
?>
    <script>
        Swal.fire({
            icon: 'success',
            title: 'Vitamin Successfully Added.',
            confirmButtonText: 'Ok',
            timer: 3000,
            timerProgressBar: true,
            didOpen: (toast) => {
                toast.addEventListener('mouseenter', Swal.stopTimer)
                toast.addEventListener('mouseleave', Swal.resumeTimer)
            }
        });
    </script>
<?php
}
?>

<?php
if (isset($_SESSION['saved-deworming'])) {
    unset($_SESSION['saved-deworming']);
?>
    <script>
        Swal.fire({
            icon: 'success',
            title: 'Deworming Successfully Added.',
            confirmButtonText: 'Ok',
            timer: 3000,
            timerProgressBar: true,
            didOpen: (toast) => {
                toast.addEventListener('mouseenter', Swal.stopTimer)
                toast.addEventListener('mouseleave', Swal.resumeTimer)
            }
        });
    </script>
<?php
}
?>