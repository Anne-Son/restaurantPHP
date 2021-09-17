<?php include('partials/menu.php'); ?>

<div class="main-content">
 <div class="wrapper">
  <h1>Add Admin</h1>

  <br><br>

  <?php 
    if(isset($_SESSION['add']))
    {
      echo $_SESSION['add'];
      unset($_SESSION['add']);
    }
  ?>
  <br><br>

  <form action="" method="POST">

   <table class="tbl-30">
    <tr>
     <td>Full Name:</td>
     <td><input type="text" name="full_name" placeholder="Enter your full name"></td>
    </tr>

    <tr>
     <td>Username: </td>
     <td><input type="text" name="username" placeholder="Enter your username"></td>
    </tr>

   <tr>
    <td>Password:</td>
    <td><input type="password" name="password" placeholder="Enter your password"></td>
   </tr>

   <tr>
    <td colspan="2">
     <input type="submit" name="submit" value="Add Admin" class="btn-secondary">
    </td>
   </tr>

   </table>

  </form>
 </div>
</div>


<?php include('partials/footer.php'); ?>

<?php  
 //Process the value from Form and save it in Database
 //Check whether the submit button is clicked or not
 if(isset($_POST['submit']))
 {
   //Button clicked
   //echo "Button Clicked";

   //1. Get data from form
   $full_name = $_POST['full_name'];
   $username = $_POST['username'];
   $password = md5($_POST['password']); //password encryption with MD5

   //2. SQL Query to Save the data into database
   $sql = "INSERT INTO tbl_admin SET
    full_name='$full_name',
    username='$username',
    password='$password'
   ";
  
  //3. Executing Query and Saving Data into Database
   $res = mysqli_query($conn, $sql) or die(mysqli_error());

   //4. Check whether the (Query is Executed) data is inserted or not and displayy appropriate message
   if($res == TRUE)
   {
     //Data inserted
     //echo "Data inserted";
     //Create a Session variable to Display Message
     $_SESSION['add'] = "<div class='success'>Admin Added Successfully</div>";
     //Redirect  to Manage Admin
     header("location:".SITEURL.'admin/manage-admin.php');
   }
   else{
     //failed
     //echo "Failed inserted data";
          $_SESSION['add'] = "<div class='error'>Failed to add Admin</div>";
     //Redirect Page to Add Adming
     header("location:".SITEURL.'admin/add-admin.php');
   }
   
 }
 

?>