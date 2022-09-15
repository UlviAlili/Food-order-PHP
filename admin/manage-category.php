<?php include('partials/menu.php'); ?>

<div class="main-content">
    <div class="wrapper">
    <h1>Manage Category</h1>
           <br> <br>
        <?php
          if (isset($_SESSION['add'])){
              echo $_SESSION['add']."<br>";
              unset($_SESSION['add']);
          }
          if (isset($_SESSION['remove'])){
              echo $_SESSION['remove']."<br>";
              unset($_SESSION['remove']);
          }
          if (isset($_SESSION['delete'])){
              echo $_SESSION['delete']."<br>";
              unset($_SESSION['delete']);
          }
          if (isset($_SESSION['no-category-found'])){
              echo $_SESSION['no-category-found']."<br>";
              unset($_SESSION['no-category-found']);
          }
          if (isset($_SESSION['update'])){
              echo $_SESSION['update']."<br>";
              unset($_SESSION['update']);
          }
          if (isset($_SESSION['upload'])){
              echo $_SESSION['upload']."<br>";
              unset($_SESSION['upload']);
          }
          if (isset($_SESSION['failed-remove'])){
              echo $_SESSION['failed-remove']."<br>";
              unset($_SESSION['failed-remove']);
          }
          ?>

        <a href="<?php echo SITEURL; ?>admin/add-category.php" class="btn-primary">Add Category</a>
        <br> <br> <br>
      <table class="tbl-full">
          <tr>
              <th>S.N.</th>
              <th>Title</th>
              <th>Image</th>
              <th>Featured</th>
              <th>Active</th>
              <th>Actions</th>
          </tr>

          <?php
          //Query to Get all Categories from Database
          $sql = "SELECT * FROM tbl_category";
          //Execute query
          $res= mysqli_query($conn,$sql);
          //Count Rows
          $count=mysqli_num_rows($res);
          //Check whether we have data in database or not
          if ($count>0){
              //we have data in database
              //get the data and display
              $i=1;
              while ($row=mysqli_fetch_assoc($res)){
                  $id=$row['id'];
                  $title = $row['title'];
                  $image_name = $row['image_name'];
                  $featured = $row['featured'];
                  $active= $row['active'];

                  ?>

                    <tr>
                       <td><?php echo $i++; ?></td>
                       <td><?php echo $title; ?></td>
                        <td>
                        <?php
                        if ($image_name!=""){
                            ?>
                            <img src="<?php echo SITEURL;?>images/category/<?php echo $image_name;?>"width="80px">
                            <?php
                        }
                        else { echo "<div class='error'>Image not Added.</div>"; }
                        ?>
                       </td>
                       <td><?php echo $featured; ?></td>
                       <td><?php echo $active; ?></td>
                       <td>
<a href="<?php echo SITEURL; ?>admin/update-category.php?id=<?php echo $id; ?>" class="btn-secondary">Update Category</a>
<a href="<?php echo SITEURL; ?>admin/delete-category.php?id=<?php echo $id;?>&image_name=<?php echo $image_name;?>" class="btn-danger">Delete Category</a>
                       </td>
                    </tr>
                  <?php

              }
          } else {
              //we don't have data
              //we will display the message inside table
              ?>
              <tr>
                  <td colspan="6"><div class="error">No Category Added.</div></td>
              </tr>
          <?php
          }
          ?>

      </table>

    </div>
</div>

<?php include('partials/footer.php'); ?>
