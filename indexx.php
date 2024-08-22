<?php

@ob_start();
session_start();

if (isset($_SESSION['login'])) {
  include 'pages/layouts/header.php';
  include 'pages/layouts/navbar.php';
  include 'pages/layouts/sidebar.php';

  if (!empty($_GET['page'])) {
    include 'pages' . '/' . $_GET['page'] . '/indexx.php';
  } else {
    include 'pages/dashboard/indexx.php';
  }

  include 'pages/layouts/footer.php';
} else {
  echo '<script>window.location="pages/auth/loginn.php";</script>';
  exit;
}
