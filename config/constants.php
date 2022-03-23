<?php 
//Start Session
session_start();

//Create Constants to Store Non Repeating Values
define('SITEURL','http://localhost/restaurantPHP/');
define('LOCALHOST', 'localhost');
define('DB_USERNAME', 'root');
define('DB_PASSWORD','');
define('DB_NAME', 'galbidb');


 $conn = mysqli_connect(LOCALHOST, DB_USERNAME, DB_PASSWORD) or die(mysqli_error()); //database connection
 $db_select = mysqli_select_db($conn, DB_NAME) or die(mysqli_error()); //selecting database

function displayMsg($session){
if(isset($_SESSION[$session]))
{
   echo $_SESSION[$session]; //Displaying session message
   unset($_SESSION[$session]); //Removing Session message
}
}

function countDashboard($table, $number){
  //sql query
          $sql.$number = "SELECT * FROM $table";
          //execute query
          $res.$number = mysqli_query($conn, $sql.$number);
          $count = mysqli_num_rows($res.$number);
          echo $count.$number;
}
?>