  <!-- success -->
  <?php
    if (isset($_SESSION['saved'])) {
        unset($_SESSION['saved']);
    ?>
      <script>
          Swal.fire({
              // toast: true,
              // position: 'top',
              icon: 'success',
              title: 'Mother Successfully Added.',
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
              title: 'Mother Successfully Updated.',
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