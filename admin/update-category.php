<?php include('partials/menu.php');?>
<div class="main-content">
 <div class="wrapper">
  <h1>Update Category</h1>

  <br><br>
 <?php 
  //Check if the id is set or not
  if(isset($_GET['id']))
  {
   //Get the ID and all other details
   $id = $_GET['id'];
   //Create SQL query to get all other details
   $sql = "SELECT * FROM tbl_category WHERE id=$id";
   //Execute the Query
   $res = mysqli_query($conn, $sql);

   //Count the Rows to check whether the id is valid or not
   $count = mysqli_num_rows($res);

   if($count==1)
   {
    //Get all the data
    $row= mysqli_fetch_assoc($res);
    $title = $row['title'];
    $current_image = $row['image_name'];
    $featured = $row['featured'];
    $active = $row['active'];
   }
   else
   {
    //Redirect to manage category with session message
    $_SESSION['no-category-found'] = "<div class='error'>Category not Found</div>";
    header('location:'.SITEURL.'admin/manage-category.php');
   }
  }
  else
  {
   //redirect to Manage Category
   header('location:'.SITEURL.'admin/manage-category.php');
  }
 
 ?>

 <form action="" method="POST" enctype="multipart/form-data">
   <table class="tbl-30">
    <tr>
     <td>Title: </td>
     <td>
    <input type="text" name="title" value="<?php echo $title; ?>">
     </td>
    </tr>

    <tr>
     <td>Current Image: </td>
      <td>
       <?php 
        if($current_image != "")
        {
          //Display the image
          ?>
            <img src="<?php echo SITEURL; ?>images/category/<?php echo $current_image;?>" width="150px">
          <?php
        }
        else
        {
          //Display message
          echo "<div class='error'>Image Not Added</div>";
        }
       ?>
      </td>
    </tr>

    <tr>
     <td>New Image: </td>
     <td>
      <input type="file" name="image" >
     </td>
    </tr>

    <tr>
     <td>Featured: </td>
     <td>
      <input <?php if($featured=="Yes"){echo "checked";} ?> type="radio" name="featured" value="Yes">Yes
      <input <?php if($featured=="No"){echo "checked";} ?>  type="radio" name="featured" value="No">No
     </td>
    </tr>

    <tr>
        <td>Active: </td>
     <td>
      <input <?php if($active=="Yes"){echo "checked";} ?>  type="radio" name="active" value="Yes">Yes
      <input <?php if($active=="No"){echo "checked";} ?>  type="radio" name="active" value="No">No
     </td>
    </tr>

    <tr>
     <td>
       <input type="hidden" name="current_image" value="<?php echo $current_image; ?>">
       <input type="hidden" name="id" value="<?php echo $id; ?>">
      <input type="submit" name="submit" value="Update Categpry" class="btn-secondary">
    </td>
    </tr>

   </table>
  </form>

  <?php 
    if(isset($_POST['submit']))
    {
      //1.Get all the values from our form
      $id = $_POST['id'];
      $title = $_POST['title'];
      $current_image = $_POST['current_image']; 
      $featured = $_POST['featured'];
      $active = $_POST['active'];

      //2. Updating New Image if selected
      //Check if the image is selected or not
      if(isset($_FILES['image']['name']))
      {
        //Get the Image Details
        $image_name = $_FILES['image']['name'];

        //Check if the image is available or not
        if($image_name != "")
        {
          //Image Available
          //Upload the New image 
           //Auto rename our Image
          //Get the extension of our image(jpg,png,gif,etc)
          $ext = end(explode('.', $image_name));

          //Rename the image
          $image_name = "Food_Category_".rand(000, 999).'.'.$ext;

          $source_path = $_FILES['image']['tmp_name'];

          $destination_path = "../images/category/".$image_name;

          //Upload the image
          $upload = move_uploaded_file($source_path,$destination_path);

          // Check whether the image is uploaded or not
          // And if the image is not uploaded then we will stop the process and redirect with error message
          if($upload==false)
          {
            //Set message
            $_SESSION['upload'] = "<div class='error'>Failed to upload</div>";
            //Redirect to Add Category Page
            header('location:'.SITEURL.'admin/add-category.php');
            //Stop the process
            die();
          }
          //Remove the current image if available
          if($current_image!="")
          {
             $remove_path = "../images/category/".$current_image;
          $remove = unlink($remove_path);

          //Check if the image is removed or not
          //If failed to remove then display message and stop the process
          if($remove==false)
          {
            //Failed to remove the image
            $_SESSION['failed-remove'] = "<div class='error'>Failed to remove current Image</div>";
            header('location:'.SITEURL.'admin/manage-category.php');
            die(); //Stop the process
          }
          }
         
        }
        else
        {
          $image_name = $current_image;
        }
      }
      else
      {
        $image_name = $current_image;
      }

      //3. Update the database
      $sql2 = "UPDATE tbl_category SET
        title = '$title',
        image_name = '$image_name',
        featured = '$featured',
        active = '$active'
        WHERE id=$id
      ";

      $res2 = mysqli_query($conn, $sql2);

      //4. Redirect to Manage Category with a message
      if($res2==true)
      {
        //Category updated
        $_SESSION['update'] = "<div class='success'>Category Updated Successfully</di>";
        header('location:'.SITEURL.'admin/manage-category.php');
      }
      else
      {
        //Failed to update 
        $_SESSION['update'] = "<div class='error'>Failed to update Category</di>";
        header('location:'.SITEURL.'admin/manage-category.php');
      }

    }
  
  ?>

 </div>
</div>


<?php include('partials/footer.php');?>