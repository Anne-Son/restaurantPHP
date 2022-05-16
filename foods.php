<?php include('partials-frontend/menu.php'); ?>

    <!-- Food Search Section Starts Here -->
    <section class="food-search text-center">
      <div class="container">
        <form action="<?php echo SITEURL; ?>food-search.php" method="POST">
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

    <!-- Food Menu Section Starts Here -->
    <section class="food-menu">
      <div class="container">
        <h2 class="text-center">Food Menu</h2>

        <?php 
         //Display food that are active
         $sql= "SELECT * FROM tbl_food WHERE active='Yes'";
         $res=mysqli_query($conn,$sql);
         $count=mysqli_num_rows($res);
         if($count>0)
         {
          while($row=mysqli_fetch_assoc($res))
          {
            $id = $row['id'];
            $food_name = $row['food_name'];
            $description = $row['description'];
            $price=$row['price'];
            $image_name=$row['image_name'];
            ?>
              <div class="food-menu-box">
                <div class="food-menu-img square img-curve">
                  <?php 
                    if($image_name=="")
                    {
                      echo "<div class='error'>Image not Available</div>";
                    }
                    else{
                      ?>
                    <img
                    src="<?php echo SITEURL; ?>images/food/<?php echo $image_name;?>"
                    alt="kimbab with sausage"
                    class="menu-img"
                    />
                    <?php
                    }
                  ?>

                </div>
                <div class="food-menu-desc">
                  <h4><?php echo $food_name;?></h4>
                  <p class="food-price"><?php echo $price;?></p>
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
         else{
           echo "<div class='error'>Food not found</div>";
         }
        ?>

        


        <div class="clearfix"></div>
      </div>
    </section>
    <!-- Food Menu Section Ends Here -->

 <?php include('partials-frontend/footer.php'); ?>