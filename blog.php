<!DOCTYPE html>
<html lang="en">

<!-- Header Goes Here -->
<?php
  $page_title = "Blog";
  include("./includes/header.php");
?>

<body>
  <!-- Navbar Goes Here -->
  <?php include("./includes/navbar.php") ?>

  <!-- Recent Blogs section -->
  <div class="recent-blogs">
    <div class="container">
      <div class="row">

        <h2>Blogs</h2>

        <?php
          include_once("./includes/db_connect.php");

          $sql = "SELECT * FROM posts ORDER BY id DESC";
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
      </div>
    </div>
  </div>

  <!-- Footer Goes Here -->
  <?php include("./includes/footer.php"); ?>

</body>
</html>