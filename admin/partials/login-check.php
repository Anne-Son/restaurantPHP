<?php 
  //Authorization - Access Control

  // Check if the user is logged in or 
  if(!isset($_SESSION['user'])) //if user session is not set
  {
   //User is not logged in
   //Redirect to login page with message
   $_SESSION['no-login-message']="<div class='error text-center'>Please login to access Admin Panel</div>";
   //Redirect to Login Page
   header('location:'.SITEURL.'admin/login.php');
  }
?>
