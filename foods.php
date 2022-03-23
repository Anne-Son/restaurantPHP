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

    <!-- Food Menu Section Starts Here -->
    <section class="food-menu">
      <div class="container">
        <h2 class="text-center">Food Menu</h2>

        <?php 
        //TODO
        ?>

        <div class="food-menu-box">
          <div class="food-menu-img square img-curve">
            <img
              src="images/kimbab2.jpg"
              alt="kimbab with sausage"
              class="menu-img"
            />
          </div>
          <div class="food-menu-desc">
            <h4>Kimbab</h4>
            <p class="food-price">$17.5</p>
            <p class="food-detail">
              Made with dried algae, vegetables, egg, sausage and meat
            </p>
            <a href="#" class="btn btn-primary btn-menu">Order Now</a>
          </div>
          <div class="clearfix"></div>
        </div>


        <div class="clearfix"></div>
      </div>
    </section>
    <!-- Food Menu Section Ends Here -->

 <?php include('partials-frontend/footer.php'); ?>