<?php 
session_start(); //Track Login Sessions

  include("db_connect.php"); //connecting to the database

  //getting value from the user
  if($_SERVER["REQUEST_METHOD"] == "POST"){ //instead of isset()

    $email = filter_input(INPUT_POST, "email", FILTER_VALIDATE_EMAIL); //validating email
    if($email === false){
      echo "
        <div class='alert alert-danger' role='alert'>
            Enter a valid email or password!
        </div> 
      ";
    }

    $password = $_POST['password']; //getting userpassword

    $sql = "SELECT * FROM admin WHERE id = 1";
    $result = mysqli_query($connection, $sql);

    $row = mysqli_fetch_assoc($result);
    if(($row['email'] === $email) && password_verify($password, $row['password'])){
      $_SESSION['logged-in'] = true; // used to track if admin is logged in.
      header("Location: ./dashboard-menu.php");
      exit();
    } else {
      $error = "Invalid Login Details";
    }
  }
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Kenneth'Blog</title>
  <link rel="icon" type="image/x-icon" href="./assets/logo.png">


  <!-- bootstrap -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">

  <!-- links -->
  <link rel="stylesheet" href="styles/login.css">

</head>

<body>

  <div class="login">
    <div class="container">
      <div class="row">

        <!-- Background Image -->
        <div class="col-lg-6 login-left"></div>

        <!-- Form section -->
        <div class="col-lg-6 form-section">
          <form method="post" action="login.php">
            <h1>Welcome Admin!</h1>

            <?php if(isset($error)){
              echo "
                <div class='alert alert-warning alert-dismissible fade show'  role='alert'>
                  Invalid email or password!
                    <div type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></div>
                </div> ";
            }
            ?>

            <div class="mb-3">
              <label for="email" class="form-label">Email address</label>
              <input type="email" id="email" name="email" class="form-control" required>
            </div>

            <div class="mb-3">
              <label for="password" class="form-label">Password</label>
              <input type="password" class="form-control" id="password" name="password" required>
            </div>

            <div class="mb-3 form-check">
              <div>
                <input type="checkbox" class="form-check-input" id="remember-me">
                <label class="form-check-label" for="remember-me">Remember me</label>
              </div>
              <a href="#">Forgotten Password?</a>
            </div>

            <button type="submit" class="btn btn-primary" name="login" value="login">Login</button>
          </form>
        </div>

      </div>
    </div>
  </div>

  <!-- javascript -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
</body>

</html>