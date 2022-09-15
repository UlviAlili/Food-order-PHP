<?php include('partials/menu.php'); ?>

<div class="main-content">
    <div class="wrapper">
        <h1>Add Admin</h1>
        <br>
        <?php
        if (isset($_SESSION['add'])) {
            echo $_SESSION['ad'] . '<br>';
            unset($_SESSION['ad']);
        }
        ?>
        <form action="" method="post">
            <table class="tbl-30">
                <tr>
                    <td>Full Name:</td>
                    <td>
                        <input type="text" name="full_name" placeholder="Enter Your Name">
                    </td>
                </tr>
                <tr>
                    <td>Username:</td>
                    <td>
                        <input type="text" name="username" placeholder="Enter Your Username">
                    </td>
                </tr>
                <tr>
                    <td>Password:</td>
                    <td>
                        <input type="password" name="password" placeholder="Enter Your Password">
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <input type="submit" name="submit" value="Add Admin" class="btn-secondary">
                    </td>
                </tr>
            </table>
        </form>
    </div>
</div>

<?php include('partials/footer.php'); ?>

<?php
//     Process the Value from Form and Save it in Database

//     Check whether the submit button is clicked or not
if (isset($_POST['submit'])) {
    // Button Clicked

    //1. Get the Data from Form
    $full_name = $_POST['full_name'];
    $username = $_POST['username'];
    $password = md5($_POST['password']); // Password Encryption with MD5

    //2. SQL Query to Save the Data into database
    $sql = "INSERT INTO tbl_admin SET
                        full_name = '$full_name',
                        username = '$username',
                        password = '$password'";

    // 3. Execute Query and Save Data in Database

    $res = mysqli_query($conn, $sql) or die(mysqli_error());

    if ($res) {
        // echo "Inserted";
        // Create Session Variable to Display Message
        $_SESSION['add'] = "<div class='success'>Admin Add Successfully</div>";
        //redirect page
        header("location:" . SITEURL . "admin/manage-admin.php");
    } else {
        // echo "Not Inserted";
        // Create Session Variable to Display Message
        $_SESSION['add'] = "<div class='error'> Failed to add Admin</div>";
        //redirect page
        header("location:" . SITEURL . "admin/add-admin.php");
    }
}
?>

