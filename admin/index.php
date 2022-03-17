
<?php include('partials/menu.php');?>

   <!-- Main Content Section Starts -->
   <div class="main-content">
    <div class="wrapper">
    <h1>DASHBOARD</h1>
    <br><br>

      <?php 
      if(isset($_SESSION['login']))
      {
        echo$_SESSION['login'];
        unset($_SESSION['login']);
      }
      ?>
      <br><br>

      <div class="col-4 text-center">
        <?php 
          //sql query
          $sql = "SELECT * FROM tbl_category";
          //execute query
          $res = mysqli_query($conn, $sql);
          $count = mysqli_num_rows($res);
        ?>
        <h1><?php echo $count ?></h1>
        <br>
        Categories
      </div>

       <div class="col-4 text-center">
         <?php 
          //sql query
          $sql = "SELECT * FROM tbl_food";
          //execute query
          $res = mysqli_query($conn, $sql);
          $count = mysqli_num_rows($res);
        ?>
        <h1><?php echo $count ?></h1>
        <br>
        Foods
      </div>

       <div class="col-4 text-center">
        <h1>5</h1>
        <br>
        Total Orders
      </div>

       <div class="col-4 text-center">
        <h1>5</h1>
        <br>
        Revenue Generated
      </div>
      <div class="clearfix"></div>
    </div>
   </div>
   <!-- Main Content Section Ends -->

 <?php include('partials/footer.php');?>