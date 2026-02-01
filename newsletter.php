<!DOCTYPE html>
<html lang="en">

<!-- Header Goes Here -->
<?php
  $page_title = "Newsletter";
  include("./includes/header.php");
?>

<body>
  <!-- Navbar Goes Here -->
  <?php include("./includes/navbar.php"); ?>

  <!-- Newsletter Section -->
  <div class="newsletter">
    <div class="container">
      <div class="row">
        <h3>Subscribe to my Newsletter</h3>
        <form action="" method="post">
          <div>
            <input type="email" name="newsletter-email" placeholder="example@email.com">
          </div>
          <div>
            <button type="submit" name="subscribe">Subscribe</button>
          </div>
        </form>
      </div>
    </div>
  </div>

  <!-- Footer Goes Here -->
  <?php include("./includes/footer.php"); ?>

</body>
</html>