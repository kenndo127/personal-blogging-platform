<!DOCTYPE html>
<html lang="en">

<!-- Header Goes Here -->
<?php 
  $page_title = "Home";
  include("./includes/header.php"); 
?>

<body>
  <!-- Navbar Goes Here -->
  <?php include("./includes/navbar.php"); ?>

  <!-- Hero section -->
  <div class="carousel">

    <div class="slides">
      <?php
        include_once("./includes/db_connect.php");
        $sql = "SELECT * FROM posts ORDER BY id DESC LIMIT 3";
        $stmt = mysqli_prepare($connection, $sql);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);

        while($row = mysqli_fetch_assoc($result)){
          echo "
            <div class='slide'>
              <img src='{$row['image']}' alt='Slide Image 1'>
              <div class='overlay'>
                <a href = 'news.php?title={$row['slug']}' style='text-decoration: none'><h2>{$row['title']}</h2></a>
              </div>
            </div>
          ";
        }
      ?>
    </div>

    <div class="arrow prev">&#10094;</div>
    <div class="arrow next">&#10095;</div>

  </div>

  <!-- Recent Blogs section -->
  <div class="recent-blogs">
    <div class="container">
      <div class="row">

        <h2>Blogs</h2>
        <?php
          include_once("./includes/db_connect.php");

          $sql = "SELECT * FROM posts ORDER BY id DESC LIMIT 3 OFFSET 3";
          $stmt = mysqli_prepare($connection, $sql);
          mysqli_stmt_execute($stmt);
          $result = mysqli_stmt_get_result($stmt);
          
          while($row = mysqli_fetch_assoc($result)){
            $read_time = ceil(str_word_count(strip_tags($row['content']))/200);
            echo "
              <div class='col-lg-4 col-sm-6'>
                <div class='blog'>
                  <img src='{$row['image']}' class='img-fluid' alt='Blog Image'>
                  <span>{$read_time} mins read</span>
                  <h3><a href='news.php?title={$row['slug']}'>{$row['title']}</a></h3>
                  <p>By Okechukwu Kenneth</p>
                </div>
              </div>
            ";
          }
        ?>
        <a href="blog.php" class="more-blogs">See More</a>

      </div>
    </div>
  </div>

  <!-- Newsletter Section -->
  <div class="newsletter">
    <div class="container">
      <div class="row">
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

  <!-- Footer Goes Here -->
  <?php include("./includes/footer.php")?>

</body>
</html>