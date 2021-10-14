<?php include('partials/menu.php');?>
   <!-- Main Content Section Starts -->
   <div class="main-content">
    <div class="wrapper">
    <h1>MANAGE CATEGORIES</h1>
    
      <br><br>
         <?php 
         if(isset($_SESSION['add']))
         {
            echo $_SESSION['add'];
            unset($_SESSION['add']);
         }
         displayMsg('remove');
         displayMsg('delete');
         displayMsg('no-category-found');
         displayMsg('update');
         displayMsg('upload');
         displayMsg('failed-remove');
         ?>
      <br><br>

      <!-- Button to Add Admin -->
      <a href="<?php echo SITEURL; ?>admin/add-category.php" class="btn-primary">Add Category</a>
      <br><br><br>

      <table class="tbl-full">
         <tr>
            <th>S.N</th>
            <th>Title</th>
            <th>Image</th>
            <th>Featured</th>
            <th>Active</th>
            <th>Actions</th>
         </tr>

         <?php 
            $sql = "SELECT * FROM tbl_category";

            //Execute Query
            $res = mysqli_query($conn, $sql);

            //Count rows
            $count = mysqli_num_rows($res);

            //Crate Serial Number Variable and assign value as 1
            $sn=1;

            //Check whether we have data in database or not
            if($count>0)
            {  
               //If we have datat, get the data and display
               while($row=mysqli_fetch_assoc($res))
               {
                  $id = $row['id'];
                  $title = $row['title'];
                  $image_name = $row['image_name'];
                  $featured = $row['featured'];
                  $active = $row['active'];

                  ?>

                     <tr>
                        <td><?= $sn++ ?> </td>
                        <td><?= $title; ?></td>
                        
                        <td>
                           
                           <?php
                           //Check whether image name is available or not
                           if($image_name!="")
                           {
                              //Display the image
                              ?>
                              <img src="<?php echo SITEURL;?>images/category/<?php echo $image_name; ?>" width="100px">
                              <?php
                           }
                           else
                           {
                              //Display the message
                              echo "<div class='error'>Image not added</div>";
                           }
                           ?>
                        
                        </td>

                        <td><?= $featured; ?></td>
                        <td><?= $active; ?></td>
                        <td>
                           <a href="<?php echo SITEURL;?>admin/update-category.php?id=<?php echo $id ?>" class="btn-secondary">Update Category</a>  
                           <a href="<?php echo SITEURL; ?>admin/delete-category.php?id=<?php echo $id; ?>&image_name=<?php echo $image_name; ?>" class="btn-danger">Delete Category</a> 
                        </td>
                     </tr>

                  <?php
               }
            }
            else
            {
               //Display message inside the table
               ?>
               <tr>
                  <td colspan="6"><div class="error">No Category Added.</div></td>
               </tr>
               <?php

            }
         ?>

        


      </table>

    </div>
   </div>
   <!-- Main Content Section Ends -->


<?php include('partials/footer.php');?>