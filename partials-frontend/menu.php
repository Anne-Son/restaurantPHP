<?php include('config/constants.php'); ?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <!-- Important to make website responsive -->
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Galbi Restaurant</title>

    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Bebas+Neue&display=swap"
      rel="stylesheet"
    />
    <!-- Link CSS file -->
    <link rel="stylesheet" href="css/style.css" />
  </head>

  <body>
    <!-- Navbar Section Starts Here -->
    <section class="navbar">
      <div class="container navbar-container">
        <div class="logo">
          <img
            src="images/galbiBlack.png"
            alt="Galbi logo"
            class="img-responsive"
          />
        </div>

        <div class="menu text-right">
          <ul>
            <li><a href="<?php echo SITEURL; ?>">HOME</a></li>
            <li><a href="<?php echo SITEURL; ?>categories.php">CATEGORIES</a></li>
            <li><a href="<?php echo SITEURL; ?>foods.php">FOODS</a></li>
            <li><a href="#">CONTACT</a></li>
          </ul>
        </div>
        <div class="clearfix"></div>
      </div>
    </section>
    <!-- Navbar Section Ends Here -->