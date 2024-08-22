<?php

@ob_start();
session_start();

if (isset($_SESSION['login'])) {
  include 'page/layouts/header.php';
  include 'page/layouts/navbar.php';
  include 'page/layouts/sidebar.php';

  if (!empty($_GET['page'])) {
    include 'page' . '/' . $_GET['page'] . '/index.php';
  } else {
    include 'page/dashboard/index.php';
  }

  include 'page/layouts/footer.php';
} else {
  echo '<script>window.location="page/auth/login.php";</script>';
  exit;
}
