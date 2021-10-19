<?php 
include('../config/constants.php');
include('login-check.php');
?>

<!DOCTYPE html>
<html lang="en">
  <head>
   <title>Galbi Restaurant - Home Page</title>
   <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Bebas+Neue&display=swap"
      rel="stylesheet"
    />
   <link rel="stylesheet" href="../css/admin.css">

  </head>
 
  <body>
   <!-- Menu Section Starts -->
   <div class="menu text-center">
     <div class="wrapper">
     <ul>
      <li><a href="index.php">HOME</a></li>
      <li><a href="manage-admin.php">ADMIN</a></li>
      <li><a href="manage-category.php">CATEGORY</a></li>
      <li><a href="manage-food.php">FOOD</a></li>
      <li><a href="manage-order.php">ORDER</a></li>
      <li><a href="logout.php">Logout</a></li>
     </ul>
     </div>
    
   </div>
   <!-- Menu Section Ends -->