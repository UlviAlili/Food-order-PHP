<?php
include("partials/menu.php");
?>

  <div class="main-content">
      <div class="wrapper">
          <h1>Add Food</h1>
          <br><br>
          <?php
          if (isset($_SESSION['add'])){
              echo $_SESSION['add']."<br>";
              unset($_SESSION['add']);
          }
          if (isset($_SESSION['upload'])){
              echo $_SESSION['upload']."<br>";
              unset($_SESSION['upload']);
          }
          ?>

<!--          Add Category Form Starts-->
          <form action="" method="post" enctype="multipart/form-data">
              <table class="tbl-30">
                  <tr>
                      <td>Title:</td>
                      <td>
                          <input type="text" name="title" placeholder="Title of the Food">
                      </td>
                  </tr>
                   <tr>
                      <td>Description:</td>
                      <td>
                          <textarea name="description" cols="30" rows="5" placeholder="Description of the Food"></textarea>
                      </td>
                  </tr>
                  <tr>
                      <td>Price:</td>
                      <td>
                          <input type="number" name="price">
                      </td>
                  </tr>
                  <tr>
                      <td>Select Image:</td>
                      <td>
                          <input type="file" name="image"
                      </td>
                  </tr>
                  <tr>
                      <td>Category:</td>
                      <td>
                          <select name="category">
                              <?php
                              //Create Php Code to display categories from database
                              //1. Create sql to get all active categories from database
                              $sql = "SELECT * FROM tbl_category WHERE active='Yes'";
                              //Execute query
                              $res =mysqli_query($conn, $sql);
                              //Count Rows to check whether we have categories or not
                              $count = mysqli_num_rows($res);
                              //If count is greater than zero,we have categories else we don't have categories
                              if ($count>0){
                                  //we have categories
                                  while ($row = mysqli_fetch_assoc($res)){
                                      //get the details of categories
                                      $id = $row['id'];
                                      $title = $row['title'];
                                      ?>
                                      <option value="<?php echo $id; ?>"><?php echo $title;?></option>
                                      <?php
                                  }
                              } else{
                                  //we don't have category

                                  ?>
                                  <option value="0">No Category Found</option>
                              <?php
                              }
                              //display on dropdown
                              ?>
                          </select>
                      </td>
                  </tr>
                  <tr>
                      <td>Featured:</td>
                      <td>
                          <input type="radio" name="featured" value="Yes"> Yes
                          <input type="radio" name="featured" value="No"> No
                      </td>
                  </tr>
                  <tr>
                      <td>Active:</td>
                      <td>
                          <input type="radio" name="active" value="Yes"> Yes
                          <input type="radio" name="active" value="No"> No
                      </td>
                  </tr>
                  <tr>
                      <td colspan="2">
                          <input type="submit" name="submit" value="Add Food" class="btn-secondary">
                      </td>
                  </tr>
              </table>
          </form>
<!--          Add Category Form Ends-->

          <?php
             //Check whether the Submit Button is Clicked or Not
             if (isset($_POST['submit'])){
                 // Clicked
                 //1. Get the Value from Category Form
                 $title = $_POST['title'];
                 $description = $_POST['description'];
                 $price= $_POST['price'];
                 $category = $_POST['category'];

                 //For Radio Input , we need to check whether the button is selected or Not
                 if (isset($_POST['featured'])){
                     // Get the Value from Form
                     $featured = $_POST['featured'];
                 } else {
                     // Set the Default Value
                     $featured = "No";
                 }
                 if (isset($_POST['active'])){
                     // Get the Value from Form
                     $active = $_POST['active'];
                 } else {
                     // Set the Default Value
                     $active = "No";
                 }

                 //Check whether the image is selected or not and set the value for image name accordingly
                 if (isset($_FILES['image']['name'])){
                     // Upload Image
                     $image_name = $_FILES['image']['name'];

                     if ($image_name != "") {

                             //Auto Rename our Image
                             $array = explode('.', $image_name);
                             $ext = end($array);
                             $image_name = "Food-Name-" . rand(000, 999) . "." . $ext;

                             $src = $_FILES['image']['tmp_name'];
                             $dst = "../images/food/" . $image_name;

                             //Upload the Image
                             $upload = move_uploaded_file($src, $dst);

                             //Check whether the image is uploaded or not
                             if ($upload == false) {
                                 //Set message
                                 $_SESSION['upload'] = "<div class='error'>Failed to Upload Image</div>";
                                 //Redirect to Add Category page
                                 header("location:" . SITEURL . "admin/add-food.php");
                                 //Stop the Proccess
                                 die();
                             }
                     }
                 } else {
                     // Don't upload Image
                     $image_name = '';
                 }

                 //2. Create Sql Query to Insert Category into Database
                 $sql2 = "INSERT INTO tbl_food SET 
                         title= '$title',
                         description='$description',
                         price=$price,
                         image_name='$image_name',
                         category_id='$category',
                         featured= '$featured',
                         active='$active'";

                 //3. Execute the Query and Save in Database
                 $res2 = mysqli_query($conn,$sql2);

                 //4. Check whether the query executed or not and data added or not
                 if ($res2==true){
                     //Query Executed and Food Added
                     $_SESSION['add']="<div class='success'>Food Added Successfully</div>";
                     //Redirect to Manage Food page
                     header("location:".SITEURL."admin/manage-food.php");
                 } else {
                     // Failed to Add Food
                     $_SESSION['add']="<div class='error'>Failed to Add Food</div>";
                     //Redirect to Manage Food page
                     header("location:".SITEURL."admin/add-food.php");
                 }
             }

          ?>
      </div>
  </div>

<?php include("partials/footer.php"); ?>
