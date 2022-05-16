<?php include('partials-frontend/menu.php'); ?>
    <?php 
      //Check if food id is set ornot
      if(isset($_GET['food_id']))
      {
        //Get the food id and food's properties
        $food_id = $_GET['food_id'];

        //Get the details from selected food
        $sql = "SELECT * FROM tbl_food WHERE id=$food_id";
        $res = mysqli_query($conn,$sql);
        $count = mysqli_num_rows($res);
        if($count==1)
        {
          $row = mysqli_fetch_assoc($res);
          $food_name = $row['food_name'];
          $price = $row['price'];
          $image_name = $row['image_name'];
        }
        else
        {
          header('location:'.SITEURL);
        }
      }
      else
      {
        //Redirectt to homepage
        header('location:'.SITEURL);
      }
    ?>
    <!-- Order Form Section Starts Here -->
    <section>
      <div class="container">
        <h2 class="text-center text-white">
          Fill this form to confirm your order
        </h2>
        <form action="" method="POST" class="order">
          <fieldset>
            <legend>Selected Food</legend>

            <div class="food-menu-img">
              <?php 
                //Check whether the image is available or not
                if($image_name=="")
                {
                  echo "<div class='error'>Image not available</div>";
                }
                else{
                  ?>
                  <img
                  src="<?php echo SITEURL;?>images/food/<?php echo $image_name; ?>"
                  alt="kimbab with sausage"
                  class="img-responsive img-curve"
                  />
                  <?php 
                }
              
              ?>
              
            </div>

            <div class="food-menu-desc">
              <h4><?php echo $food_name;?></h4>
              <input type="hidden" name="food" value="<?php echo $food_name;?>">

              <p class="food-price">$<?php echo $price;?></p>
              <input type="hidden" name="price" value="<?php echo $price;?>">  

              <div class="order-label">Quantity</div>
              <input
                type="number"
                name="quantity"
                class="input-responsive"
                value="1"
                required
              />
            </div>
          </fieldset>

          <fieldset>
            <legend>Delivery Details</legend>
            <div class="order-label">Full Name</div>
            <input
              type="text"
              name="full-name"
              placeholder="Enter your name"
              class="input-responsive"
            />

            <div class="order-label">Phone Number</div>
            <input
              type="tel"
              name="contact"
              placeholder="Enter your phone E.g.7788793422"
              class="input-responsive"
              required
            />

            <div class="order-label">Email</div>
            <input
              type="email"
              name="email"
              placeholder="E.g. webdeveloper@anneson.com"
              class="input-responsive"
              required
            />

            <div class="order-label">Address</div>
            <textarea
              name="address"
              rows="10"
              placeholder="Street, City, Country"
              class="input-responsive"
              required
            ></textarea>
            <input
              type="submit"
              name="submit"
              value="Confirm Order"
              class="btn btn-primary input-responsive"
            />
          </fieldset>
        </form>
         
        <?php 
          //Check whether submit button is checked or not
          if(isset($_POST['submit']))
          {
            //Get all the details from form
            $food = $_POST['food'];
            $price = $_POST['price'];
            $quantity = $_POST['quantity'];
            $total = $price * $quantity;

            $order_date = date("Y-m-d h:i:s");
            $status = "Ordered"; //Ordered, on delivery, delivered, cancelled
            $customer_name = $_POST['full-name'];
            $customer_contact = $_POST['contact'];
            $customer_email = $_POST['email'];
            $customer_address = $_POST['address'];

            //Save the order in database
            //Create SQL to save the data
            $sql2 = "INSERT INTO tbl_order SET
            food = '$food',
            price = $price,
            quantity = $quantity,
            total = $total,
            order_date = '$order_date',
            status = '$status',
            customer_name = '$customer_name',
            customer_contact = '$customer_contact',
            customer_email = '$customer_email',
            customer_address = '$customer_address'
            ";
            //echo $sql2; die();

            //Execute the query
            $res2 = mysqli_query($conn,$sql2);
            //Check if the query was executed correctly
            if($res2==true)
            {
              //query executed and order saved
              $_SESSION['order'] = "<div class='success text-center padd'>Food ordered successfully.</div>";
              header('location:'.SITEURL);
            }
            else
            {
                $_SESSION['order'] = "<div class='error text-center padd'>Failed to order food.</div>";
              header('location:'.SITEURL);
            }
          }
        ?>
        <?php
          $mathematicians = array('archimedes', 'euler', 'pythagoras');
          array_push($mathematicians, 'hypatia');
          array_push($mathematicians, 'fibonacci');
          array_pop
        ?>
      </div>
    </section>
    <!-- Order Form Section Ends Here -->

 <?php include('partials-frontend/footer.php'); ?>