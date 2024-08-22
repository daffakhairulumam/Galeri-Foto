<?php

session_start();
session_destroy();

header("location: ../../pages/auth/loginn.php");
