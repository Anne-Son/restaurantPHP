<?php include('partials/menu.php');?>
 <!-- Main Content Section Starts -->
   <div class="main-content">
    <div class="wrapper">
    <h1>MANAGE FOOD</h1>
    
       <br><br>
      <!-- Button to Add Admin -->
      <a href="<?php echo SITEURL; ?>admin/add-food.php" class="btn-primary">Add Food</a>
      <br><br><br>

      <?php
      displayMsg('add');
      displayMsg('delete');
      displayMsg('upload');
      displayMsg('delete');
      displayMsg('unauthorize');   
      ?>

      <table class="tbl-full">
         <tr>
            <th>S.N</th>
            <th>Food Name</th>
            <th>Price</th>
            <th>Image</th>
            <th>Featured</th>
            <th>Active</th>
            <th>Actions</th>
         </tr>
         <?php 
      //Create a SQL Query to get food properties
         $sql = "SELECT * FROM tbl_food";

         //Execute the query
         $res = mysqli_query($conn, $sql);

         //count rows to check if we have food inf or not
         $count = mysqli_num_rows($res);

         $sn=1;

         if($count>0)
         {
            //Get the food properties from database and display them
            while($row=mysqli_fetch_assoc($res))
            {
               //Get the values from individual columns
               $id=$row['id'];
               $food_name=$row['food_name'];
               $price=$row['price'];
               $image_name = $row['image_name'];
               $featured = $row['featured'];
               $active =$row['active'];
               ?>
               <tr>
                  <td><?= $sn++; ?> </td>
                  <td><?= $food_name; ?></td>
                  <td>
                     <?php
                     //Check if we have an image or not
                     if($image_name=="")
                     {
                        echo "<div class='error'>Image not added</div>";
                     }
                     else
                     {
                        ?>
                        <img src="<?php echo SITEURL; ?>images/food/<?php echo $image_name; ?>" width="100px">
                        <?php
                     } 
                     ?>
                  </td>
                  <td><?= $image_name; ?></td>
                  <td><?= $featured; ?></td>
                  <td><?= $active; ?></td>
                  <td>
                     <a href="<?php echo SITEURL; ?>admin/update-food.php?id=<?php echo $id; ?>" class="btn-secondary">Update Food</a>  
                     <a href="<?php echo SITEURL; ?>admin/delete-food.php?id=<?php echo $id; ?>&image_name=<?php echo $image_name; ?>" class="btn-danger">Delete Food</a> 
                  </td>
               </tr>

               <?php 
            }
         }
         else
         {
            //Food not added in Database
            echo "<tr> <td colspan='7' class='error'>Food not Added</td> </tr>";
         }       
         ?>       

      </table>

    </div>
   </div>
   <!-- Main Content Section Ends -->


<?php include('partials/footer.php');?>