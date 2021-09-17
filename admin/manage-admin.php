<?php include('partials/menu.php');?>

   <!-- Main Content Section Starts -->
   <div class="main-content">
    <div class="wrapper">
    <h1>MANAGE ADMIN</h1>
      <br>

      <?php  
         displayMsg('add');
         displayMsg('delete');
         displayMsg('update');
         displayMsg('user-not-found');
         displayMsg('pwd-not-match');
         displayMsg('change-pwd');

      ?>
      <br><br>

      <!-- Button to Add Admin -->
      <a href="add-admin.php" class="btn-primary">Add Admin</a>
      <br><br><br>

      <table class="tbl-full">
         <tr>
            <th>S.N</th>
            <th>Full Name</th>
            <th>Username</th>
            <th>Actions</th>
         </tr>

         <?php 
            //Query to get all admin
            $sql ="SELECT * FROM tbl_admin";
            //Execute the Query
            $res = mysqli_query($conn, $sql);

            //Check whether the Query is Executed or not
            if($res==TRUE)
            {
               //Count Rows to check whether we have data in database or not
               $count = mysqli_num_rows($res); //Function to get all the rows in database
               $sn = 1;
               //Check the num or rows
               if($count>0)
               {
                  //We have dta in database
                  while($rows=mysqli_fetch_assoc($res))
                  {
                     //Using while loop to get all the data from database.
                     //And while loop will run as long as we have data in database

                     //Get individual Data
                     $id=$rows['id'];
                     $full_name=$rows['full_name'];
                     $username=$rows['username'];

                     //Display de values in our table
                     ?>
                     
                       <tr>
                           <td><?php echo $sn++; ?>. </td>
                           <td><?php echo $full_name; ?></td>
                           <td><?php echo $username; ?></td>
                           <td>
                              <a href="<?php echo SITEURL;?>admin/update-password.php?id=<?php echo $id; ?>" class="btn-primary">Change Password</a>
                              <a href="<?php echo SITEURL;?>admin/update-admin.php?id=<?php echo $id; ?>" class="btn-secondary">Update Admin</a>  
                              <a href="<?php echo SITEURL;?>admin/delete-admin.php?id=<?php echo $id; ?>" class="btn-danger">Delete Admin</a> 
                           </td>
                        </tr>


                     <?php
                  }
               }
            }
         
         ?>

      
      </table>

    </div>
   </div>
   <!-- Main Content Section Ends -->

<?php include('partials/footer.php');?> 