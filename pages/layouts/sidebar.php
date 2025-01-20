<?php
if ($page == 'dashboard') {
  $classDashboard = 'nav-link active';
} else {
  $classDashboard = 'nav-link collapsed';
}

if ($page == 'up-foto') {
  $classFoto = 'nav-link active';
} else {
  $classFoto = 'nav-link collapsed';
}

if ($page == 'user') {
  $classUsers = 'nav-link active';
} else {
  $classUsers = 'nav-link collapsed';
}
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
      <a class="<?php echo $classFoto ?>" href="index.php?page=up-foto">
        <i class="bi bi-image"></i>
        <span>Foto</span>
      </a>
    </li>
    <!-- End Dashboard Nav -->

  </ul>

</aside><!-- End Sidebar-->