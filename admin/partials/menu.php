<?php
 include('../config/constants.php');
 include('login-check.php');
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Food Order Website - Home Page</title>
    <link rel="stylesheet" href="../css/admin.css">
</head>
<body>
<!--Menu Section starts-->
<div class="menu text-center">
    <div class="wrapper">
    <ul>
        <li><a href="index.php">Home</a></li>
        <li><a href="manage-admin.php">Admin</a></li>
        <li><a href="manage-category.php">Category</a></li>
        <li><a href="manage-food.php">Food</a></li>
        <li><a href="manage-order.php">Order</a></li>
        <li><a href="<?php echo SITEURL;?>">Back to Site</a></li>
        <li><a href="logout.php">Logout</a></li>
    </ul>
    </div>
</div>
<!--Menu Section ends-->
