<?php include('partials-frontend/menu.php'); ?>

    <!-- Food Search Section Starts Here -->
    <section class="food-search text-center">
      <div class="container">
        <form action="">
          <input type="search" name="search" placeholder="Search for Food..." />
          <input
            type="submit"
            name="submit"
            value="Search"
            class="btn btn-primary"
          />
        </form>
      </div>
    </section>
    <!-- Food Search Section Ends Here -->

    <!-- Categories Section Starts Here -->
    <section class="categories">
      <div class="container">
        <h2 class="text-center">Explore Foods</h2>

        <?php 
          //Create SQL Query to display categories from database
          $sql = "SELECT * FROM tbl_category WHERE active='Yes' AND featured='Yes' LIMIT 3";
          $res = mysqli_query($conn, $sql);
          //Count rows to check whether the category is available or not
          $count = mysqli_num_rows($res);

          if($count>0)
          {
            //categories available
            while($row=mysqli_fetch_assoc($res))
            {
              $id=$row['id'];
              $title=$row['title'];
              $image_name = $row['image_name'];
              ?>
            <a href="#">
              <div class="box-3 float-container">
                <?php 
                  //Check if the image is available or not
                if($image_name=="")
                {
                  echo "<div class='error'>Image not Available</div>";
                }
                else
                {
                  ?>
                  <img
                  src="<?php echo SITEURL;?>images/category/<?php echo $image_name;?>"
                  alt="<?php echo $image_name;?>"
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
          else{
            echo"<div class='error'>Category not Added.</div>";
          }
        ?>

       

        <div class="clearfix"></div>
      </div>
    </section>
    <!-- Categories Section Ends Here -->


    <!-- Food Menu Section Starts Here -->
    <section class="food-menu">
      <div class="container">
        <h2 class="text-center">Food Menu</h2>

        <?php 
        //Getting foods from databas that are active and featured
        //SQL Query
        $sql2 = "SELECT * FROM tbl_food WHERE active='Yes' AND featured='Yes' LIMIT 6";

        //Execute the query
        $res2 = mysqli_query($conn, $sql2);

        //Count rows
        $count2 = mysqli_num_rows($res2);
        
        //Check if the food is available or not
        if($count2>0)
        {
          //food available
          while($row=mysqli_fetch_assoc($res2))
          {
            $id=$row['id'];
            $food_name=$row['food_name'];
            $price=$row['price'];
            $description=$row['description'];            
            $image_name=$row['image_name']; 
            ?>
            
            <div class="food-menu-box">
              <div class="square img-curve">
                <?php
                  if($image_name=="")
                  {
                    echo "<div class='error'>Image is not available</div>";
                  }
                  else
                  {
                    ?>
                      <img
                        src="<?php SITEURL; ?>images/food/<?php echo $image_name; ?>"
                        alt="<?php echo $food_name;?>"
                        class="menu-img"
                      />
                    <?php
                  }
                ?>
              
              </div>
              <div class="food-menu-desc">
                <h4><?php echo $food_name; ?></h4>
                <p class="food-price">$<?php echo $price; ?></p>
                <p class="food-detail"><?php echo $description; ?></p>
                <a href="#" class="btn btn-primary btn-menu">Order Now</a>
              </div>
              <div class="clearfix"></div>
            </div>

            <?php
          }
        }
        else
        {
          echo "<div class='error'>Food not available</div>";
        }

        ?>

        


        <div class="clearfix"></div>
      </div>
    </section>
    <!-- Food Menu Section Ends Here -->

    <?php include('partials-frontend/footer.php'); ?>
