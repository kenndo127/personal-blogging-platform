<?php
require_once("admin-verify.php");
// this is used to make sure that the page is accessed only when the admin is logged in
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Admin</title>
  <link rel="icon" type="image/x-icon" href="./assets/logo.png">
</head>

<!-- Bootstrap -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">

<!-- Fonts -->
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Anta&family=Bai+Jamjuree:ital,wght@0,200;0,300;0,400;0,500;0,600;0,700;1,200;1,300;1,400;1,500;1,600;1,700&family=Caveat:wght@400..700&family=Libre+Baskerville:ital,wght@0,400;0,700;1,400&family=Micro+5&family=Montserrat:ital,wght@0,100..900;1,100..900&family=Open+Sans:ital,wght@0,300..800;1,300..800&family=Ubuntu:ital,wght@0,300;0,400;0,500;0,700;1,300;1,400;1,500;1,700&display=swap" rel="stylesheet">

<!-- CSS -->
<link rel="stylesheet" href="./styles/dashboard.css">

<body>

  <!-- Side Nav -->
  <nav>
    <ul>
      <a href="dashboard-menu.php">
        <li><img src="./assets/home-icon.svg" alt="home-icon"> Dashboard</li>
      </a>

      <a href="posts.php">
        <li><img src="./assets/add-post-icon.svg" alt="add-post-icon"> Add Posts</li>
      </a>

      <a href="edit.php">
        <li><img src="./assets/edit-icon.svg" alt="edit-icon"> Edit</li>
      </a>

      <a href="settings.php">
        <li><img src="./assets/settings-icon.svg" alt="settings-icon"> Settings</li>
      </a>
    </ul>
  </nav>

  <!-- Main section -->
  <main>
    <div class="main-nav">
      <h2>Welcome Admin !</h2>
      <a href="#">Logout <img src="./assets/logout-icon.svg" alt="Log out Icon"></a>
    </div>

    <div class="container mt-3">
      <div class="alert alert-info" role="alert">
        This feature is not available yet!
      </div>
    </div>


  </main>



  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
</body>

</html>