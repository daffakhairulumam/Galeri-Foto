<?php
if ($page == 'dashboard') {
  $classDashboard = 'nav-link active';
} else {
  $classDashboard = 'nav-link collapsed';
}

// if ($page == 'up-foto') {
//   $classFoto = 'nav-link active';
// } else {
//   $classFoto = 'nav-link collapsed';
// }

// if ($page == 'user') {
//   $classUsers = 'nav-link active';
// } else {
//   $classUsers = 'nav-link collapsed';
// }
?>

<!-- ======= Sidebar ======= -->
<aside id="sidebar" class="sidebar">
  <ul class="sidebar-nav" id="sidebar-nav">

    <li class="nav-item">
      <a class="<?php echo $classDashboard ?>" href="index.php">
        <i class="bi bi-grid"></i>
        <span>Dashboard</span>
      </a>
    </li><!-- End Dashboard Nav -->

    <li class="nav-item">
      <a class="nav-link collapsed" data-bs-target="#master-nav" data-bs-toggle="collapse" href="#">
        <i class="bi bi-menu-button-wide"></i><span>Master</span><i class="bi bi-chevron-down ms-auto"></i>
      </a>
      <ul id="master-nav" class="nav-content collapse <?php if ($page == 'up-foto' || $page == 'user') echo 'show' ?>" data-bs-parent="#sidebar-nav">
        <li>
          <a href="index.php?page=up-foto" class="<?php if ($page == 'up-foto') echo 'active' ?>">
            <i class="bi bi-circle"></i><span>Foto</span>
          </a>
        </li>
        <li>
          <a href="index.php?page=user" class="<?php if ($page == 'user') echo 'active' ?>">
            <i class="bi bi-circle"></i><span>User</span>
          </a>
        </li>
      </ul>
    </li>
    <!-- End Master Nav -->

  </ul>

</aside><!-- End Sidebar-->