<?php
  if (!(isset($_GET['title']))) {
    header("Location: index.php");
    exit();
  }
  include("./db_connect.php");
  $slug = $_GET['title']; 

  $sql = "SELECT * FROM posts WHERE slug = ?";
  $stmt = mysqli_prepare($connection, $sql);
  mysqli_stmt_bind_param($stmt, "s", $slug);
  mysqli_stmt_execute($stmt);
  $result = mysqli_stmt_get_result($stmt);
  $row = mysqli_fetch_assoc($result);
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>News</title>
  <link rel="icon" type="image/x-icon" href="./assets/logo.png">

  <!-- Bootstrap -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">

  <!-- Fonts -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Anta&family=Bai+Jamjuree:ital,wght@0,200;0,300;0,400;0,500;0,600;0,700;1,200;1,300;1,400;1,500;1,600;1,700&family=Caveat:wght@400..700&family=Libre+Baskerville:ital,wght@0,400;0,700;1,400&family=Micro+5&family=Montserrat:ital,wght@0,100..900;1,100..900&family=Open+Sans:ital,wght@0,300..800;1,300..800&family=Ubuntu:ital,wght@0,300;0,400;0,500;0,700;1,300;1,400;1,500;1,700&display=swap" rel="stylesheet">

  <!-- CSS -->
  <link rel="stylesheet" href="./styles/style.css">

</head>

<body>

  <!-- Navbar Section -->
  <nav class="navbar navbar-expand-lg">
    <div class="container-fluid">
      <a class="navbar-brand" href="index.php"><img src="./assets/logo.png" alt="Logo"></a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse justify-content-end" id="navbarSupportedContent">

        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="index.php">Home</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="blog.php">Blog</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="newsletter.php">Newsletter</a>
          </li>
        </ul>

        <div class="search">
          <a class="nav-link" href="search.php"><img src="./assets/search.svg" alt="Search Logo"></a>
        </div>

      </div>
    </div>
  </nav>

  <!-- News Section -->
  <main class="news">
    <div class="container">
      <div class="row">

        <h1><?php echo $row['title'] ?></h1>
        <hr>
        <div class="news-elements">
          <p>By Okechukwu Kenneth</p>
          <div>
            <p><img src="./assets/time.svg" alt="time icon">
              <?php
                $read_time = ceil(str_word_count(strip_tags($row['content']))/200);
                echo $read_time . " mins read";
              ?>
            </p>
            <p><img src="./assets/calendar.svg" alt="Calendar icon"><?php echo substr($row['date'], 0, 11) ?></p>
          </div>
        </div>

        <div class="news-section">
          <img src="<?php echo $row['image'] ?>" class="img-fluid" alt="News Image">
          <small class="img-source"><?php echo $row['image_source'] ?></small>
          <?php echo $row['content'] ?>
        </div>

      </div>
    </div>
  </main>

  <!-- Newsletter Section -->
  <div class="newsletter">
    <div class="container">
      <div class="row">
        <h3>Subscribe to my Newsletter</h3>
        <form>
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
  <footer>
    <p>&copy; Okechukwu Kenneth Chidiebube 2026 </p>
  </footer>

  <!-- Js -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
</body>

</html>