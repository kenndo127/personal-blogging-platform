<?php
  if (!(isset($_GET['title']))) {
    header("Location: index.php");
    exit();
  }

  include("./includes/db_connect.php");
  include_once("./includes/functions.php");

  $slug = $_GET['title']; 

  $sql = "SELECT * FROM posts WHERE slug = ?";
  $stmt = mysqli_prepare($connection, $sql);
  mysqli_stmt_bind_param($stmt, "s", $slug);
  mysqli_stmt_execute($stmt);
  $result = mysqli_stmt_get_result($stmt);
  $row = mysqli_fetch_assoc($result);

  //Handling Social Media Sharing
  $raw_page_url = get_url();
  $encoded_page_url = urlencode(get_url());
  $domain_url = get_domain_url($row['image']);

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <!-- For Sharing Purposes -->
  <meta property="og:title" content="<?php echo $row['title'] ?>">
  <meta property="og:image" content="<?php echo $domain_url ?>">
  <meta property="og:url" content="<?php echo $raw_page_url; ?>">
  <meta property="og:type" content="article">
  <meta name="twitter:card" content="summary_large_image">

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
  <?php include("./includes/navbar.php"); ?>

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

        <div class="share">
          <p> Share Via Social Media </p>
          <div class="social">
            <a href="https://www.linkedin.com/sharing/share-offsite/?url=<?php echo $encoded_page_url ?>" target="_blank"><img src="./assets/linkedin-svgrepo-com.svg"></a>
            <a href="https://api.whatsapp.com/send?text=<?php echo $encoded_page_url ?>" target="_blank"><img src="./assets/whatsapp-color-svgrepo-com.svg"></a>
            <a href="https://www.facebook.com/sharer/sharer.php?u=<?php echo $encoded_page_url ?>" target="_blank"><img src="./assets/facebook-1-svgrepo-com.svg"></a>
            <a href="https://x.com/intent/tweet?url=<?php echo $encoded_page_url ?>" target="_blank"><img src="./assets/icons8-x-50.png"></a>
          </div>
        </div>

      </div>
    </div>
  </main>

  <!-- Footer Goes Here -->
  <?php include("./includes/footer.php"); ?>

</body>
</html>