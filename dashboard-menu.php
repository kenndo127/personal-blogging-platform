<?php
require_once("admin-verify.php");
// this is used to make sure that the page is accessed only when the admin is logged in

include("./includes/db_connect.php");
$total_rows = mysqli_num_rows(mysqli_query($connection, "SELECT * FROM posts"));
$newsletter_rows = mysqli_num_rows(mysqli_query($connection, "SELECT * FROM subscribers"));
?>
<!DOCTYPE html>
<html lang="en">

<!-- Header Goes Here -->
<?php include("./includes/admin-header.php") ?>

<body>
  <!-- Side Nav -->
  <?php include("./includes/admin-nav.php") ?>
  
  <!-- Main section -->
  <main>
    <div class="main-nav">
      <h2>Welcome Admin !</h2>
      <a href="./logout.php">Logout <img src="./assets/logout-icon.svg" alt="Log out Icon"></a>
    </div>

    <div class="stats">
      <div class="container">
        <div class="row">

          <div class="col-lg-4 col-sm-6">
            <div class="posts">
              <img src="./assets/feed-counter.svg" alt="feed-counter Icon">
              <h3><?php echo $total_rows ?></h3>
              <p>Number of Blogs</p>
            </div>
          </div>

          <div class="col-lg-4 col-sm-6">
            <div class="posts">
              <img src="./assets/feed-counter.svg" alt="feed-counter Icon">
              <h3><?php echo $newsletter_rows ?></h3>
              <p>Number of Subscribers</p>
            </div>
          </div>

          <div class="col-lg-4 col-sm-6">
            <div class="posts">
              <img src="./assets/feed-counter.svg" alt="feed-counter Icon">
              <h3>30</h3>
              <p>Number of Blogs</p>
            </div>
          </div>

        </div>
      </div>
    </div>

  </main>



  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
</body>

</html>