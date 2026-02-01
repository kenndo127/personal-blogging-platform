<!DOCTYPE html>
<html lang="en">

<!-- Header Goes Here -->
<?php
  $page_title = "Newsletter";
  $css_path = "./styles/newsletter.css";
  include("./includes/header.php")
?>

<body>
  <!-- Navbar Goes Here -->
  <?php include("./includes/navbar.php"); ?>

  <!-- Newsletter Section -->
  <div class="newsletter">
    <div class="container">
      <div class="row">


        <?php 
          session_start();
          if(isset($_SESSION['invalid-email']) && isset($_SESSION['invalid-email']) == true){
                echo "<div class='alert alert-danger alert-dismissible fade show' role='alert'>
                        Invalid Email.
                        <div type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></div>
                      </div>";
          } else if(isset($_SESSION['duplicate']) && isset($_SESSION['duplicate']) == true){
                echo "<div class='alert alert-warning alert-dismissible fade show' role='alert'>
                        You are already a subscriber!
                        <div type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></div>
                      </div>";
          } else if(isset($_SESSION['subscribed']) && isset($_SESSION['subscribed']) == true){
                echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>
                        Thank You for Subscribing to my Newsletter!.
                        <div type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></div>
                      </div>";
          }
          unset($_SESSION['invalid-email']);
          unset($_SESSION['duplicate']);
          unset($_SESSION['subscribed']);
          session_destroy();
        ?>

        <h3>Subscribe to my Newsletter</h3>
        <form action="newsletter-processor.php" method="post">
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

  <!-- Footer Section -->
  <?php include("./includes/footer.php") ?>
  
</body>
</html>