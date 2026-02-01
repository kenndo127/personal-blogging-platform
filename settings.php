<?php
require_once("admin-verify.php");
// this is used to make sure that the page is accessed only when the admin is logged in
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

    <div class="container mt-3">
      <div class="alert alert-info" role="alert">
        This feature is not available yet!
      </div>
    </div>
  </main>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
</body>

</html>