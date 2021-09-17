<?php 

include('../config/constants.php');
//1. Destroy the sesssion 
session_destroy(); //unsets $_SESSION

//2.Redirect to Login page
header('location:'.SITEURL.'admin/login.php');
?>