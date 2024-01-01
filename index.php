<?php

session_start();
ob_start();

if ($_SESSION['username'] != "" && $_SESSION['username'] != NULL && $_SESSION['oturum'] == 'ok') {
    header("location: inc/index.php");
} else {
    header("location: login.php");
}