<?php

session_start();
session_destroy();

header("location: ../../pages/dashboard/main-page.php");
