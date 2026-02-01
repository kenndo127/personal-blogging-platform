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
      <h2>Welcome Admin !</h2>
      <a href="./logout.php">Logout <img src="./assets/logout-icon.svg" alt="Log out Icon"></a>
    </div>

    <div class="container table-container">
      <?php
        if(isset($_SESSION['update-success']) && isset($_SESSION['update-success']) == true){
          echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>
                        Update Successful.
                      <div type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></div>
                    </div>";
        }
        unset($_SESSION['update-success']);
      ?>
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
            //This is the page deletion logic
            include_once("./includes/db_connect.php");
            if($_SERVER["REQUEST_METHOD"] === "POST"){
              $post_id = $_POST['post_id'];
              $image = $_POST['image'];

              $sql = "DELETE FROM posts WHERE id = ?";
              $stmt = mysqli_prepare($connection, $sql);
              mysqli_stmt_bind_param($stmt, "i", $post_id);
              $status = mysqli_stmt_execute($stmt);

              $alert = "<div class='alert alert-success alert-dismissible fade show' role='alert'>
                      Deletion Successful.
                    <div type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></div>
                  </div>";

              if($status){
                if(!(file_exists($image))){ 
                  echo $alert;
                }else{
                  unlink($image); //deleting image from directory
                  echo $alert;
                }
              } else {
                echo "<div class='alert alert-danger alert-dismissible fade show' role='alert'>
                    Error deleting the post.
                  <div type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></div>
                </div>";
              }
            }
          ?>

          <?php
            include_once("./includes/db_connect.php");

            $sql = "SELECT * FROM posts";

            $result = mysqli_query($connection, $sql);

            if(mysqli_num_rows($result) > 0){
              while($row = mysqli_fetch_assoc($result)){
                echo "
                  <tr>
                    <td scope='row'>{$row['title']}</td>
                    <td>{$row['date']}</td>
                    <td style='display: flex'>
                      <button class='btn btn-primary'><a href='edit.php?id={$row['id']}' style='color: #fff; text-decoration: none;'>Edit</a></button>

                      <form action='all-posts.php' method='post'> 
                        <input type='hidden' name='post_id' value='{$row['id']}'>
                        <input type='hidden' name='image' value='{$row['image']}'>
                        <button class='btn btn-danger' type='button' value='delete' data-bs-toggle='modal' data-bs-target='#deleteModal'>Delete</button>

                        <!-- Modal -->
                        <div class='modal fade' id='deleteModal' tabindex='-1' aria-labelledby='deleteModalLabel' aria-hidden='true'>
                          <div class='modal-dialog modal-dialog-centered modal-sm'>
                            <div class='modal-content bg-dark'>
                              <div class='modal-body' style='color: #fff'>
                                Are you sure you want to delete this post?
                              </div>
                              <div class='modal-footer'>
                                <button type='button' class='btn btn-secondary' data-bs-dismiss='modal'>Close</button>
                                <button type='submit' class='btn btn-danger'>Yes</button>
                              </div>
                            </div>
                          </div>
                        </div>
                      </form>
                      
                    </td>
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