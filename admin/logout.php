<?php
    include('../config/constants.php');
    //1. Session Destroy
    session_destroy();

    //2. Redirect to Login page
    header("location:".SITEURL."admin/login.php");
?>
