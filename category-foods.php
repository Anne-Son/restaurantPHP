<?php include('partials-frontend/menu.php'); ?>
    <?php 
      //Check if id is passed or not
      if(isset($_GET['category_id']))
      {
        //category id is set and get the id
        $category_id = $_GET['category_id'];
        //Get the category title based on category ID
        $sql = "SELECT title FROM tbl_category WHERE id=$category_id";
        //Execute the query
        $res = mysqli_query($conn,$sql);
        //Get the value from database
        $row = mysqli_fetch_assoc($res);
        $category_title = $row['title'];
      }
      else
      {
        header('location:'.SITEURL);
      }
    ?>
    <!-- Food Search Section Starts Here -->
    <section class="food-search text-center">
      <div class="container">
        <h2 class="text-white">Foods on <a href="#">"<?php echo $category_title;?>"</a></h2>
      </div>
    </section>
    <!-- Food Search Section Ends Here -->

    <!-- Food Menu Section Starts Here -->
    <section class="food-menu">
      <div class="container">
        <h2 class="text-center">Food Menu</h2>

        <?php 
          //Create SQL Query to get foods based on selected category
          $sql2 = "SELECT * FROM tbl_food WHERE category_id=$category_id";
          //Execute the query
          $res2 = mysqli_query($conn, $sql2);
          $count2 = mysqli_num_rows($res2);

          //Check if food is available or not
          if($count2>0)
          {
            while($row2=mysqli_fetch_assoc($res2)){
              $id=$row2['id'];
              $food_name=$row2['food_name'];
              $price=$row2['price'];
              $description=$row2['description'];
              $image_name=$row2['image_name'];
              ?>
              <div class="food-menu-box">
                  <div class="food-menu-img square img-curve">
                  <?php 
                    if($image_name=="")
                    {
                      echo "<div class='error'>Image not available</div>";
                    }
                    else
                    {
                      ?>
                      <img
                      src="<?php echo SITEURL; ?>images/food/<?php echo $image_name;?>"
                      alt="bibimbab"
                      class="menu-img"
                       />
                      <?php
                    }
                  ?>
                  </div>
                  <div class="food-menu-desc">
                    <h4><?php echo $food_name;?></h4>
                    <p class="food-price">$<?php echo $price;?></p>
                    <p class="food-detail">
                      <?php echo $description;?>
                    </p>
                    <a href="<?php echo SITEURL; ?>order.php?food_id=<?php echo $id;?>" class="btn btn-primary btn-menu">Order Now</a>
                  </div>
                  <div class="clearfix"></div>
                </div>

              <?php
            }
          }
          else
          {
            echo "<div class='error'>Food is not available</div>";
          }
        ?>
        <div class="clearfix"></div>
      </div>
    </section>
    <!-- Food Menu Section Ends Here -->

 <?php include('partials-frontend/footer.php'); ?>