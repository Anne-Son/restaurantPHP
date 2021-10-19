<?php
include('../config/constants.php');

if(isset($_GET['id']) && isset($_GET['image_name']))
{
    //Process to Delete
    //1. Get ID and Image Name
    $id = $_GET['id'];
    $image_name = $_GET['image_name'];

    //2. Remove the image if available
    //Check if the image is available or not and delete only if it is available
    if($image_name != "")
    {
        $path = "../images/food/".$image_name;

        //Remove image files from folder
        $remove = unlink($path);

        //Check if the image was removed
        if($remove==false)
        {
            //Failed to remove image
            $_SESSION['upload'] = "<div class='error'>Failed to Remove Image File</div>";
            header('location:'.SITEURL.'admin/manage-food.php');
            //Stop the process of deleting food
        die();
        }
    }

    //3. Delete food from 
    $sql = "DELETE FROM tbl_food WHERE id=$id";
    //Execute query
    $res = mysqli_query($conn, $sql);

    //4. Redirect to manage food with session message
    if($res==true)
    {
        $_SESSION['delete'] = "<div class='success'>Food Deleted Successfully</div>";
        header('location:'.SITEURL.'admin/manage-food.php');
    }
    else
    {
        //Failed to delete food
        $_SESSION['delete']= "<div class='error'>Failed to Delete Food</div>";
        header('location:'.SITEURL.'admin/manage-food.php');
    }  
}
else
{
    //Redirect to manage food page
    $_SESSION['unauthorize'] = "<div class='error'>Unauthorized Access</div>";
    header('location:'.SITEURL.'admin/manage-food.php');
}

?>