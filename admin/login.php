<?php include('../config/constants.php');?>
<!DOCTYPE html>
<html lang="en">
<head>
 <meta charset="UTF-8">
 <meta http-equiv="X-UA-Compatible" content="IE=edge">
 <meta name="viewport" content="width=device-width, initial-scale=1.0">
 <title>Login</title>
 <link rel="stylesheet" href="../css/admin.css">
</head>

<body>
 <div class="login">
  <h1 class="text-center menu">Login</h1>
  <br>

  <?php 
  displayMsg('login');
  displayMsg('no-login-message');
 
  ?>
  <br><br>
  <!-- Login form starts here -->
   <form action="" method="POST" class="text-center">
    Username: <br>
    <input type="text" name="username" placeholder="Enter username"><br><br>
    Password: <br>
    <input type="password" name="password" placeholder="Enter password"> <br><br>
    <input type="submit" name="submit" value="Login" class="btn-primary"> <br><br>
   </form>

  <!-- Login form ends here -->


<div class="footer">
  <p class="text-center">
   &copy Designed by
  <a href="www.anneson.com"> Anne Son </a>
  </p>
  </div>
 </div>
 
</body>
</html>

<?php 
//Check whether the submit button is clicked or not
if(isset($_POST['submit']))
{
  //Process for login
  //Get data from login form
  $username = $_POST['username'];
  $password = md5($_POST['password']);

  //2. Sql to check whether the user with username and password exists or not
  $sql = "SELECT * FROM tbl_admin WHERE username='$username' AND password='$password'";

  //3. Execute the Query
  $res = mysqli_query($conn, $sql);

  //4. Count rows to check whether the user exists or not
  $count = mysqli_num_rows($res);

  if($count==1)
  {
   //User available and login success
   $_SESSION['login']="<div class='success text-center'>Login Successfull</div>";
   $_SESSION['user'] = $username;//To check whetrher the user is logged in or not and logout will unset it
   //Redirect to HomePage
   header('location:'.SITEURL.'admin/');
  }
  else
  { 
   //user not available and login failed
   $_SESSION['login']="<div class='error text-center'>Login or Password did not match</div>";
   //Redirect to HomePage
   header('location:'.SITEURL.'admin/login.php');
  }
}
?>