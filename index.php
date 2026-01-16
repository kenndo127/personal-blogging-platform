<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Home</title>
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
  <div class="trending"><a href="#">This is the latest trending news</a></div>
  <nav class="navbar navbar-expand-lg">
    <div class="container-fluid">
      <a class="navbar-brand" href="index.php"><img src="./assets/logo.png" alt="Logo"></a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">

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

  <!-- Hero section -->
  <div class="carousel">

    <div class="slides">

      <div class="slide">
        <img src="./assets/carousel-img1.jpg" alt="Slide Image 1">
        <div class="overlay">
          <h2>How Technology Is Shaping the Future</h2>
        </div>
      </div>

      <div class="slide">
        <img src="./assets/carousel-img2.jpg" alt="Slide Image 2">
        <div class="overlay">
          <h2>The Beauty of Nature and Quiet Living</h2>
        </div>
      </div>

      <div class="slide">
        <img src="./assets/carousel-img3.jpg" alt="Slide Image 3">
        <div class="overlay">
          <h2>Simple Habits That Improve Daily Life</h2>
        </div>
      </div>

    </div>

    <div class="arrow prev">&#10094;</div>
    <div class="arrow next">&#10095;</div>

  </div>

  <!-- Recent Blogs section -->
  <div class="recent-blogs">
    <div class="container">
      <div class="row">

        <h2>Blogs</h2>

        <div class="col-lg-4 col-sm-6">
          <div class="blog">
            <img src="./assets/carousel-img1.jpg" class="img-fluid" alt="Blog Image">
            <span>10 mins read</span>
            <h3><a href="#">This is a blog title</a></h3>
            <p>By Okechukwu Kenneth</p>
          </div>
        </div>

        <div class="col-lg-4 col-sm-6">
          <div class="blog">
            <img src="./assets/carousel-img1.jpg" class="img-fluid" alt="Blog Image">
            <span>10 mins read</span>
            <h3><a href="#">This is a blog title</a></h3>
            <p>By Okechukwu Kenneth</p>
          </div>
        </div>

        <div class="col-lg-4 col-sm-6">
          <div class="blog">
            <img src="./assets/carousel-img1.jpg" class="img-fluid" alt="Blog Image">
            <span>10 mins read</span>
            <h3><a href="#">This is a blog title</a></h3>
            <p>By Okechukwu Kenneth</p>
          </div>
        </div>

        <a href="#" class="more-blogs">See More</a>

      </div>
    </div>
  </div>

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




  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
  <script src="index.js"></script>
</body>

</html>