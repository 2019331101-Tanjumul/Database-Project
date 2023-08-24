<?php
include('config.php');
include('functions.php');
unset($_SESSION['UID']);
unset($_SESSION['UNAME']);
redirect('index.php');
?>