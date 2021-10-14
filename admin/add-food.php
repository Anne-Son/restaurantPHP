<?php include('partials/menu.php');?>

<div class="main-content">
 <div class="wrapper">
  <h1>Add Food</h1>

  <br><br>

  <?php
  displayMsg('upload');
  ?>

  <form action="" method="POST" enctype="multipart/form-data">
   <table class="tbl-30">
    <tr>
     <td>Food Name: </td>
     <td>
      <input type="text" name="food_name" placeholder="Food Name">
     </td>
    </tr>

    <tr>
     <td>Description: </td>
     <td>
      <textarea name="description" cols="30" rows="5" placeholder="Food description"></textarea>
     </td>
    </tr>

    <tr>
     <td>Price: </td>
     <td>
      <input type="number" name="price">
     </td>
    </tr>

    <tr>
     <td>Select Image: </td>
     <td>
      <input type="file" name="image">
     </td>
    </tr>

    <tr>
     <td>Category: </td>
     <td>
      <select name="category">
       <?php 
        //Create php Code to display categories from Database
        //1. Create sql query to get all active categories from Database
        $sql = "SELECT * FROM tbl_category WHERE active='Yes'";

        $res = mysqli_query($conn, $sql);

        //Count rows to check if there is any category
        $count = mysqli_num_rows($res);

        //If count is greater than zero, we have categories
        if($count>0)
        {
         while($row=mysqli_fetch_assoc($res))
         {
          //get the details of categories
          $id=$row['id'];
          $title=$row['title'];

          ?>
          <option value="<?php echo $id;?>"><?php echo $title; ?></option>
          <?php
         }
        }
        else
        {
         ?>
         <option value="0">No Category Found</option>
         <?php
        }

        //2. Display on dropdown
       
       ?>
      </select>
     </td>
    </tr>

    <tr>
     <td>Featured: </td>
     <td>
      <input type="radio" name="featured" value="Yes">Yes
      <input type="radio" name="featured" value="No">No
     </td>
    </tr>

    <tr>
     <td>Active: </td>
     <td>
      <input type="radio" name="active" value="Yes">Yes
      <input type="radio" name="active" value="No">No
     </td>
    </tr>

    <tr>
     <td colspan="2">
      <input type="submit" name="submit" value="Add Food" class="btn-secondary">
     </td>
    </tr>

   </table>

  </form>

  <?php
   //Check if the button is clicked
   if(isset($_POST['submit']))
   {
    //Add the food in database

    //1. Get data from Form
    $food_name = $_POST['food_name'];
    $description = $_POST['description'];
    $price =$_POST['price'];
    $category = $_POST['category'];

    //Check if radio buttons for featured and active are checked or not
    if(isset($_POST['featured']))
    {
     $featured = $_POST['featured'];
    }
    else
    {
     $featured = "No";
    }

    if(isset($_POST['active']))
    {
     $active = $_POST['active'];
    }
    else
    {
     $active = "No";
    }

    //2. Upload image if selected
    //Check if the select image is clicked or not and upload an image only if the image is selected
    if(isset($_FILES['image']['name']))
    {
     //Get the details of the selected image
     $image_name = $_FILES['image']['name'];

     //Check if the image is selected or not and upload the image only if selected
     if($image_name!="")
     {
      //Image was selected
      //A.Rename the image
      //Get the extension of selected image
      $ext = end(explode('.', $image_name));

      //Create new name for image
      $image_name = "Food-Name-".rand(0000,9999).".".$ext; 

      //B. Upload the image
      //Get the src path and destination path

      //Source path is the current location of the image
      $src=$_FILES['image']['tmp_name'];

      //Destination path
      $dst = "../images/food/".$image_name;

      //Upload the food image
      $upload = move_uploaded_file($src, $dst);

      //Check if the image was uploaded
      if($upload==false)
      {
       //Failed to upload the image
       //Redirect to add food page with error message
       $_SESSION['upload'] = "<div class='error'>Failed to Upload the Image</div>";
       header('location:'.SITEURL.'admin/add-food.php');
       die();
      }
     }
    }
    else
    {
     $image_name = ""; //Setting default value as blank
    }

    //3. Insert into database

    //Create a SQL Query to save or add food
    $sql2 = "INSERT INTO tbl_food SET
    food_name = '$food_name',
    description = '$description',
    price = $price,
    image_name = '$image_name',
    category_id = $category,
    featured = '$featured',
    active = '$active'
    ";

    //Execute the query
    $res2 = mysqli_query($conn, $sql2);

    //Check if data was inserted or not
    if($res2 == true)
    {
     //data inserted successfully
     $_SESSION['add'] = "<div class='success'>Food Added Successfully</div>";
     header('location:'.SITEURL.'admin/manage-food.php');
    }
    else
    {
     $_SESSION['add'] = "<div class='error'>Failed to add food</div>";
     header('location:'.SITEURL.'admin/manage-food.php');
    }


    //4. Redirect with message to manage food page
   }
  
  ?>

 </div>
</div>

<?php include('partials/footer.php');?>
<?php ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
?>