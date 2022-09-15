<?php include('partials/menu.php'); ?>

<!--Main Content Section starts-->
<div class="main-content">
    <div class="wrapper">
    <h1>Manage Admin</h1>
        <br>
        <?php
        if (isset($_SESSION['add'])){
            echo $_SESSION['add']."<br>";
            unset($_SESSION['add']);
        }
        if (isset($_SESSION['delete'])){
            echo $_SESSION['delete']."<br>";
            unset($_SESSION['delete']);
        }
        if (isset($_SESSION['update'])){
            echo $_SESSION['update']."<br>";
            unset($_SESSION['update']);
        }
        if (isset($_SESSION['user-not-found'])){
            echo $_SESSION['user-not-found']."<br>";
            unset($_SESSION['user-not-found']);
        }
        if (isset($_SESSION['pwd-not-match'])){
            echo $_SESSION['pwd-not-match']."<br>";
            unset($_SESSION['pwd-not-match']);
        }
        if (isset($_SESSION['change-pwd'])){
            echo $_SESSION['change-pwd']."<br>";
            unset($_SESSION['change-pwd']);
        }
        ?>
        <br>

        <a href="add-admin.php" class="btn-primary">Add Admin</a>
        <br> <br> <br>
      <table class="tbl-full">
          <tr>
              <th>S.N.</th>
              <th>Full Name</th>
              <th>Username</th>
              <th>Actions</th>
          </tr>

          <?php
          $sql = "SELECT * FROM tbl_admin";
          $res = mysqli_query($conn,$sql);

          if ($res == true){
              $count =mysqli_num_rows($res);

              //check the num of rows
              if($count>0){
                  $sn =1;
                  while ($rows = mysqli_fetch_assoc($res)){
                  // Using while loop to get all the data from Database

                      //Get individual data
                      $id = $rows['id'];
                      $full_name = $rows['full_name'];
                      $username = $rows['username'];

                      ?>
                <tr>
                      <td><?php echo $sn++;?></td>
                      <td><?php echo $full_name;?></td>
                      <td><?php echo $username;?></td>
                      <td>
                          <a href="<?php echo SITEURL;?>admin/update-password.php?id=<?php echo $id;?>" class="btn-primary">Update Password</a>
                          <a href="<?php echo SITEURL;?>admin/update-admin.php?id=<?php echo $id;?>" class="btn-secondary">Update Admin</a>
                          <a href="<?php echo SITEURL;?>admin/delete-admin.php?id=<?php echo $id;?>" class="btn-danger">Delete Admin</a>
                      </td>
                </tr>
          <?php
                  }
              } else {
                  //We dont have data in Database
              }
          }
          ?>

      </table>
    </div>
</div>
<!--Main Content Section ends-->

<?php include('partials/footer.php'); ?>
