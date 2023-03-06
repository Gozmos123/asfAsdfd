      <!-- Sidebar -->
      <ul class="navbar-nav sidebar sidebar-dark accordion" id="accordionSidebar" style="
        background: #141E30; /* fallback for old browsers */
        background: -webkit-linear-gradient(to right, #243B55, #141E30);  /* Chrome 10-25, Safari 5.1-6 */
        background: linear-gradient(to right, #243B55, #141E30); /* W3C, IE 10+/ Edge, Firefox 16+, Chrome 26+, Opera 12+, Safari 7+ */ ">

          <!-- Sidebar - BrandLogo -->
          <a class="sidebar-brand d-flex align-items-center justify-content-center" href="<?php echo $link_dashboard; ?>">
              <div class="sidebar-brand-icon mt-4">
                  <img src="<?php echo $logo_sidebar; ?>../resources/images/sys_logo.png" alt="Logo" width="60px" height="60px">
              </div>
          </a>
          <center>
              <p class="text-white font-weight-bold mt-2">BHIS</pc>
          </center>

          <!-- Divider -->
          <hr class="sidebar-divider my-0 mt-2">

          <!-- Nav Item - Dashboard -->
          <li class="nav-item active">
              <a class="nav-link" href="<?php echo $link_dashboard; ?>">
                  <i class="fas fa-fw fa-tachometer-alt"></i>
                  <span>Dashboard</span></a>
          </li>

          <?php
            if ($_SESSION['auth'][0]['user_type'] == "administrator") {
            ?>
              <!-- Divider -->
              <hr class="sidebar-divider my-0">

              <!-- Nav Item - Users -->
              <li class="nav-item">
                  <a class="nav-link" href="<?php echo $link_users; ?>">
                      <i class="fas fa-user-cog"></i>
                      <span>Users</span></a>
              </li>
          <?php
            }
            ?>

          <!-- Divider -->
          <hr class="sidebar-divider my-0">

          <!-- Heading -->
          <!-- <div class="sidebar-heading">
                Interface
            </div> -->

          <!-- Nav Item - Collapse Menu -->
          <li class="nav-item">
              <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseResidents" aria-expanded="true" aria-controls="collapseResidents">
                  <i class="fas fa-users"></i>
                  <span>Residents Profile</span>
              </a>
              <div id="collapseResidents" class="collapse" aria-labelledby="headingResidents" data-parent="#accordionSidebar">
                  <div class="bg-white py-2 collapse-inner rounded">
                      <!-- <h6 class="collapse-header">Custom Components:</h6> -->
                      <a class="collapse-item" href="<?php echo $link_mothers; ?>">Mothers</a>
                      <a class="collapse-item" href="<?php echo $link_childrens; ?>">Childrens</a>
                  </div>
              </div>
          </li>

          <!-- Divider -->
          <hr class="sidebar-divider">

          <!-- Heading -->
          <div class="sidebar-heading">
              Children Monitoring
          </div>

          <!-- Nav Item - Collapse Menu -->
          <li class="nav-item">
              <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseDistributions" aria-expanded="true" aria-controls="collapseDistributions">
                  <i class="fas fa-tasks"></i>
                  <span>Distributions</span>
              </a>
              <div id="collapseDistributions" class="collapse" aria-labelledby="headingDistributions" data-parent="#accordionSidebar">
                  <div class="bg-white py-2 collapse-inner rounded">
                      <!-- <h6 class="collapse-header">Custom Components:</h6> -->
                      <a class="collapse-item" href="<?php echo $link_vitamins; ?>">Vitamin A</a>
                      <a class="collapse-item" href="<?php echo $link_deworming; ?>">Deworming</a>
                  </div>
              </div>
          </li>

          <!-- Nav Item - Collapse Menu -->
          <li class="nav-item">
              <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseMonitoring" aria-expanded="true" aria-controls="collapseMonitoring">
                  <i class="fas fa-clipboard-check"></i>
                  <span>Monitoring</span>
              </a>
              <div id="collapseMonitoring" class="collapse" aria-labelledby="headingMonitoring" data-parent="#accordionSidebar">
                  <div class="bg-white py-2 collapse-inner rounded">
                      <!-- <h6 class="collapse-header">Custom Components:</h6> -->
                      <a class="collapse-item" href="<?php echo $link_weights; ?>">Weights</a>
                      <a class="collapse-item" href="<?php echo $link_immunizations; ?>">Immunizations</a>
                  </div>
              </div>
          </li>

          <!-- Divider -->
          <hr class="sidebar-divider my-0">

          <!-- Divider -->
          <hr class="sidebar-divider d-none d-md-block">

          <!-- Sidebar Toggler (Sidebar) -->
          <div class="text-center d-none d-md-inline">
              <button class="rounded-circle border-0" id="sidebarToggle"></button>
          </div>

          <!-- Sidebar Message -->
          <!-- <div class="sidebar-card d-none d-lg-flex">
                <img class="sidebar-card-illustration mb-2" src="img/undraw_rocket.svg" alt="...">
                <p class="text-center mb-2"><strong>SB Admin Pro</strong> is packed with premium features, components, and more!</p>
                <a class="btn btn-success btn-sm" href="https://startbootstrap.com/theme/sb-admin-pro">Upgrade to Pro!</a>
            </div> -->

      </ul>
      <!-- End of Sidebar -->

      <!-- Scroll to Top Button-->
      <a class="scroll-to-top rounded" href="#page-top">
          <i class="fas fa-angle-up"></i>
      </a>

      <!-- Logout Modal-->
      <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog" role="document">
              <div class="modal-content">
                  <div class="modal-header">
                      <h5 class="modal-title" id="exampleModalLabel"><strong>Ready to Leave?</strong></h5>
                      <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">×</span>
                      </button>
                  </div>
                  <div class="modal-body">
                      Are you sure you want to <strong>Logout</strong>?
                  </div>
                  <div class="modal-footer">
                      <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                      <form action="<?php echo $link_logout; ?>" method="post">
                          <button class="btn btn-primary">Logout</button>
                      </form>
                  </div>
              </div>
          </div>
      </div>