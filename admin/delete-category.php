<?php
 //Include constants File
 include('../config/constants.php');

  //Check whether the id and image_name value is set or not
  if(isset($_GET['id']) AND isset($_GET['image_name']))
  {
   //Get the Value and Delete
   $id = $_GET['id'];
   $image_name = $_GET['image_name'];

   //Remove the physical image file if it's available 
   if($image_name != "")
   {
    //If image is available, then remove it
    $path = "../images/category/".$image_name;
    $remove = unlink($path);

    //If remove image has failed then add an error message and stop the process
    if($remove==false)
    {
     //Seth the session message
     $_SESSION['remove'] = "<div class='error'>Failed to remove Category Image</div>";
     //Redirect to Manage Category page
     header('location'.SITEURL.'admin/manage-category.php');
     //Stop the process
     die();
    }
   }

   //Delete Data from Database
   //SQL Query to delete data from Database
   $sql = "DELETE FROM tbl_category WHERE id=$id";

   //Execute the Query
   $res = mysqli_query($conn, $sql);

   //Check whether the data is delete from database or not
   if($res==true)
   {
    //Set Success message and redirect
    $_SESSION['delete']="<div class='success'>Category deleted Successfully.</div>";
    //Redirect to Manage CAtegory
    header('location:'.SITEURL.'admin/manage-category.php');
   }
   else
   { 
    //Set fail message and redirects
    $_SESSION['delete']="<div class='error'>Failed to delete Category.</div>";
    //Redirect to Manage CAtegory
    header('location:'.SITEURL.'admin/manage-category.php');
   }

   //Redirect to Manage Category Page with Message
  }
  else
  {
   //Redirect to Manage Category Page
   header('location:'.SITEURL.'admin/manage-category.php');
  }

?>