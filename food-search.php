<?php include('partials-frontend/menu.php'); ?>

    <!-- Food Search Section Starts Here -->
    <section class="food-search text-center">
      <div class="container">
        <?php 
        //Get the Search Keyword
        $search = $_POST['search'];
        ?>
        <h2 class="text-white">Foods on your search <a href="#" class="text-white">"<?php echo $search;?>"</a> </h2>
      </div>
    </section>
    <!-- Food Search Section Ends Here -->

    <!-- Food Menu Section Starts Here -->
    <section class="food-menu">
      <div class="container">
        <h2 class="text-center">Food Menu</h2>

        <?php 
        //SQL query to get foods based on search keyword
        $sql = "SELECT * FROM tbl_food WHERE food_name LIKE '%$search%' OR description LIKE '%$search%'";
        //Execute the query
        $res = mysqli_query($conn, $sql);
        //count rows
        $count = mysqli_num_rows($res);
        //Check if food is available or not
        if($count>0)
        {
          //food available
          while($row=mysqli_fetch_assoc($res))
          {
            $id= $row['id'];
            $food_name= $row['food_name'];
            $price= $row['price'];
            $description= $row['description'];
            $image_name= $row['image_name'];
            ?>
             <div class="food-menu-box">
              <div class="food-menu-img square img-curve">
               <?php
                if($image_name=="")
                {
                  echo "<div class='error'>Image not available</div>";
                }
                else{
                  ?>
                  <img
                  src="<?php echo SITEURL; ?>images/food/<?php echo $image_name; ?>"
                  alt="kimbab with sausage"
                  class="menu-img"
                />  
                  <?php

                }
               ?>
               
              </div>
              <div class="food-menu-desc">
                <h4><?php echo $food_name; ?></h4>
                <p class="food-price"><?php echo $price; ?></p>
                <p class="food-detail">
                  <?php echo $description; ?>
                </p>
                <a href="#" class="btn btn-primary btn-menu">Order Now</a>
              </div>
              <div class="clearfix"></div>
            </div>
            <?php
          }
        }
        else{
          echo "<div class='error'>Food not found</div>";
        }
        ?>

        <div class="clearfix"></div>
      </div>
    </section>
    <!-- Food Menu Section Ends Here -->

 <?php include('partials-frontend/footer.php'); ?>