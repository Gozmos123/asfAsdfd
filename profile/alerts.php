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