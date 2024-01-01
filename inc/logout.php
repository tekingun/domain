<?php

include 'sessions.php';

session_destroy();
ob_flush();
header("Location: ../login.php?q=cikis");