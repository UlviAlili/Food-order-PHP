<?php include('../config/constants.php'); ?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login - Food Order System</title>
    <link rel="stylesheet" href="../css/admin.css">
</head>
<body>

    <div class="login">
        <h1 class="text-center">Login</h1>
        <br>
        <?php
        if (isset($_SESSION['login'])){
            echo $_SESSION['login']."<br>";
            unset($_SESSION['login']);
        }
        if (isset($_SESSION['no-login-message'])){
            echo $_SESSION['no-login-message']."<br>";
            unset($_SESSION['no-login-message']);
        }
        ?>
           <!--Login Form Starts -->
           <form action="" method="post" class="text-center">
           Username: <br>
           <input type="text" name="username" placeholder="Enter Username"> <br> <br>

           Password: <br>
           <input type="password" name="password" placeholder="Enter Password"> <br> <br>

           <input type="submit" name="submit" value="Login" class="btn-primary">
           <br><br>
           </form>
           <!--Login Form Ends-->
        <p class="text-center">Created By Ulvi Alili</p>

    </div>
</body>
</html>

<?php
// Check whether the Submit Button is Clicked or Not
if (isset($_POST['submit'])){
    //Proccess for Login
    //1. Get the Data from Login Form
//    $username = $_POST['username'];
    $username = mysqli_real_escape_string($conn,$_POST['username']);
    $raw_password = md5($_POST['password']);
    $password = mysqli_real_escape_string($conn,$raw_password);

    //2. Sql to Checked whether the user with username and password exists or not
    $sql = "SELECT * FROM tbl_admin WHERE username='$username' AND password='$password'";

    //3. Execute the Query
    $res = mysqli_query($conn,$sql);

    //4. Count rows to check whether the user exists or not
    $count = mysqli_num_rows($res);
    if ($count==1){
        // User Available and Login Success
        $_SESSION['login']= "<div class='success'>Login Successful</div>";
        $_SESSION['user'] = $username;//To check whether the user is logged in or not and logout will unset it
        //Redirect to Home page
        header("location:".SITEURL."admin/");
    } else {
        // User Not Available and Login Fail
        $_SESSION['login']= "<div class='error text-center'>Username or Password did not match</div>";
        //Redirect to Login page
        header("location:".SITEURL."admin/login.php");
    }
}

?>
