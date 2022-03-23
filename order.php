<?php include('partials-frontend/menu.php'); ?>

    <!-- Order Form Section Starts Here -->
    <section>
      <div class="container">
        <h2 class="text-center text-white">
          Fill this form to confirm your order
        </h2>
        <form action="#" class="order">
          <fieldset>
            <legend>Selected Food</legend>

            <div class="food-menu-img">
              <img
                src="images/kimbab2.jpg"
                alt="kimbab with sausage"
                class="img-responsive img-curve"
              />
            </div>

            <div class="food-menu-desc">
              <h4>Food Title</h4>
              <p class="food-price">$17.5</p>

              <div class="order-label">Quantity</div>
              <input
                type="number"
                name="qty"
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
      </div>
    </section>
    <!-- Order Form Section Ends Here -->

 <?php include('partials-frontend/footer.php'); ?>