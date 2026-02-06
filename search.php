<!-- Header Goes Here -->
<?php 
  $page_title = "Search";
  include("./includes/header.php") 
?>

<body>
  <!-- Navbar Section -->
  <?php include("./includes/navbar.php"); ?>

  <!-- Search section -->
  <div class="search-page">
    <div class="container">
      <div class="row">
        <h2>Search here</h2>

        <form action="search.php" method="get">
          <div>
            <input type="text" class="search-input" name="search" required>
          </div>
          <div>
            <button type="submit">Search</button>
          </div>
        </form>

        <div class="container">
          <?php
            if(isset($_GET['search'])){
              if(!empty(trim($_GET['search']))){
                $key_word = trim($_GET['search'], " ");
                $search_key_word = "%" . $key_word . "%";

                include_once("./includes/db_connect.php");

                $sql = "SELECT * FROM posts WHERE title LIKE ? OR content LIKE ?";
                $stmt = mysqli_prepare($connection, $sql);
                mysqli_stmt_bind_param($stmt, "ss", $search_key_word, $search_key_word);
                mysqli_stmt_execute($stmt);
                $result = mysqli_stmt_get_result($stmt);

                if(mysqli_num_rows($result) > 0){
                  echo " <ol class='list-group'>
                        <h4 class='list-group-item'> Search Results </h4>
                    ";
                  while($row = mysqli_fetch_assoc($result)){
                    
                    $title = htmlspecialchars($row['title']);
                    $slug = urlencode($row['slug']);
                    echo
                    "
                      <li class='list-group-item'><a style='text-decoration: none;' href='news.php?title={$slug}'>{$title}</a></li>
                    ";
                  }
                  echo "</ol>";
                } else {
                  echo "No entries found!";
                }
              } else {
                echo "Enter a valid keyword";
              }
            }
          ?>
        </div>

      </div>
    </div>
  </div>
  <!-- Footer Section -->
  <?php include("./includes/footer.php"); ?>

</body>
</html>