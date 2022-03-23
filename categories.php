<?php include('partials-frontend/menu.php'); ?>

    <!-- Categories Section Starts Here -->
    <section class="categories">
      <div class="container">
        <h2 class="text-center">Explore Foods</h2>

        <?php 
          //Display all the categories that are active
          $sql = "SELECT * FROM tbl_category WHERE active='Yes'";

          //Execute the query
          $res = mysqli_query($conn, $sql);

          //Count the rows
          $count = mysqli_num_rows($res);

          //Check if categories are available or not
          if($count>0)
          {
            //categories available
            while($row=mysqli_fetch_assoc($res))
            {
              $id=$row['id'];
              $title=$row['title'];
              $image_name=$row['image_name'];
              ?>
               <a href="#">
                <div class="box-3 float-container">
                  <?php 
                  if($image_name=="")
                  {
                    echo "<div class='error'>Image not found.</div>";
                  }
                  else
                  {
                    ?>
                     <img
                    src="<?php echo SITEURL;?>images/category/<?php echo $image_name;?>"
                    alt="<?php echo $title;?>"
                    class="img-responsive img-curve"
                    />
                    <?php
                  }
                  ?>
                 
                  <h3 class="float-text text-white"><?php echo $title;?></h3>
                </div>
              </a>
              <?php
            }
          }
          else
          {
            //categories not available
            echo "<div class='error'>Category not found.</div>";
          }
        ?>

       


        <div class="clearfix"></div>
      </div>
    </section>
    <!-- Categories Section Ends Here -->

    <?php include('partials-frontend/footer.php') ?>