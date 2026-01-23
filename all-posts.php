<?php
require_once("admin-verify.php");
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Edit</title>
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

      <a href="all-posts.php">
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
      <a href="./logout.php">Logout <img src="./assets/logout-icon.svg" alt="Log out Icon"></a>
    </div>

    <div class="container table-container">
      <table class="table">
        <thead>
          <tr>
            <th scope="col">Title</th>
            <th scope="col">Date</th>
            <th scope="col">Action</th>
          </tr>
        </thead>
        <tbody>
          <?php
            include("db_connect.php");
            //fetch rows from the database
            //display the rows
            //add the delete functionality with a confirmation button
            //add the edit functionality

            $sql = "SELECT * FROM posts";

            $result = mysqli_query($connection, $sql);

            if(mysqli_num_rows($result) > 0){
              while($row = mysqli_fetch_assoc($result)){
                echo "
                  <tr>
                    <td scope='row'>{$row['title']}</td>
                    <td>{$row['date']}</td>
                    <td><button class='btn btn-primary' type='submit' name='delete'>Update</button> <button class='btn btn-danger'>Delete</button></td>
                  </tr>
                ";
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