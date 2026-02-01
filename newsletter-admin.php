<?php 
require_once("admin-verify.php");
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
      <h2>All Your Subscribers</h2>
      <a href="./logout.php">Logout <img src="./assets/logout-icon.svg" alt="Log out Icon"></a>
    </div>

    <div class="container table-container">
      <table class="table">
        <thead>
          <tr>
            <th scope="col">Id</th>
            <th scope="col">Email</th>
          </tr>
        </thead>
        <tbody>

          <?php
            include_once("./includes/db_connect.php");

            $sql = "SELECT * FROM subscribers";
            $stmt = mysqli_prepare($connection, $sql);
            mysqli_stmt_execute($stmt);
            $result = mysqli_stmt_get_result($stmt);


            if(mysqli_num_rows($result) > 0){
              $id = 1;
              while($row = mysqli_fetch_assoc($result)){
                echo "
                  <tr>
                    <td scope='row'>{$id}</td>
                    <td>{$row['subscriber_email']}</td>
                  </tr>
                ";
                $id++;
              }
            } else {
              echo "<h1> No entries found! </h1>";
            }
          ?>
          
        </tbody>
      </table>
    </div>
  </main>



  <!-- Bootstrap -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
</body>

</html>