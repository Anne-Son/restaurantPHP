<?php
includ('../config/constants.php');

if(isset($_GET['id']) && isset($_GET['image_name']))
{
    //Process to Delete
}
else
{
    //Redirect to manage food page
    $_SESSION['delete'] = "<div class='error'>Unauthorized Access</div>"
    header('location:'.SITEURL.'admin/manage-food.php');
}

?>