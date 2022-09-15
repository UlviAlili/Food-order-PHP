<?php
    include('../config/constants.php');

    //1. get the ID of Admin to be deleted
    $id = $_GET['id'];

    //2. Created Sql Query to Delete Admin
    $sql = "DELETE FROM tbl_admin WHERE id=$id";
    $res = mysqli_query($conn,$sql);

    //3. Redirect to Manage Admin page with message
    if($res==true){
        // Delete Admin
        $_SESSION['delete'] = "<div class='success'>Admin Delete Successfully</div>";
        header('location:'.SITEURL.'admin/manage-admin.php');
    } else{
        //Failed to Delete Admin
        $_SESSION['delete'] = "<div class='error'> Admin Delete Failed. Try again later.</div>";
        header('location:'.SITEURL.'admin/manage-admin.php');
    }
?>

