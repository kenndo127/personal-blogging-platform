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
        // Display update success message
        if(isset($_SESSION['update-success']) && $_SESSION['update-success'] == true){
          echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>
                        Update Successful.
                      <div type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></div>
                    </div>";
          unset($_SESSION['update-success']);
        }

        // Handle post deletion
        include_once("./includes/db_connect.php");
        
        if($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['post_id'])){
          $post_id = intval($_POST['post_id']); // Sanitize input
          $image = $_POST['image'];

          // Validate post_id
          if($post_id <= 0){
            echo "<div class='alert alert-danger alert-dismissible fade show' role='alert'>
                    Invalid post ID.
                  <div type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></div>
                </div>";
          } else {
            // Delete from database
            $sql = "DELETE FROM posts WHERE id = ?";
            $stmt = mysqli_prepare($connection, $sql);
            
            if($stmt){
              mysqli_stmt_bind_param($stmt, "i", $post_id);
              $status = mysqli_stmt_execute($stmt);

              if($status){
                // Check if any row was actually deleted
                if(mysqli_stmt_affected_rows($stmt) > 0){
                  // Try to delete the image file
                  $image_deleted = true;
                  if(!empty($image) && file_exists($image)){
                    if(!unlink($image)){
                      $image_deleted = false;
                      error_log("Failed to delete image: " . $image);
                    }
                  }
                  
                  if($image_deleted){
                    echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>
                            Post deleted successfully.
                          <div type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></div>
                        </div>";
                  } else {
                    echo "<div class='alert alert-warning alert-dismissible fade show' role='alert'>
                            Post deleted but image file could not be removed.
                          <div type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></div>
                        </div>";
                  }
                } else {
                  echo "<div class='alert alert-warning alert-dismissible fade show' role='alert'>
                          Post not found or already deleted.
                        <div type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></div>
                      </div>";
                }
              } else {
                echo "<div class='alert alert-danger alert-dismissible fade show' role='alert'>
                        Database error: " . htmlspecialchars(mysqli_error($connection)) . "
                      <div type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></div>
                    </div>";
              }
              
              mysqli_stmt_close($stmt);
            } else {
              echo "<div class='alert alert-danger alert-dismissible fade show' role='alert'>
                      Failed to prepare delete statement.
                    <div type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></div>
                  </div>";
            }
          }
        }
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
            $sql = "SELECT * FROM posts ORDER BY date DESC";
            $result = mysqli_query($connection, $sql);

            if($result && mysqli_num_rows($result) > 0){
              while($row = mysqli_fetch_assoc($result)){
                // Create unique modal ID for each post
                $modalId = "deleteModal" . $row['id'];
                
                echo "
                  <tr>
                    <td scope='row'>" . htmlspecialchars($row['title']) . "</td>
                    <td>" . htmlspecialchars($row['date']) . "</td>
                    <td style='display: flex'>
                      <button class='btn btn-primary'><a href='edit.php?id={$row['id']}' style='color: #fff; text-decoration: none;'>Edit</a></button>

                      <form action='all-posts.php' method='post'> 
                        <input type='hidden' name='post_id' value='{$row['id']}'>
                        <input type='hidden' name='image' value='" . htmlspecialchars($row['image']) . "'>
                        <button class='btn btn-danger' type='button' data-bs-toggle='modal' data-bs-target='#{$modalId}'>Delete</button>

                        <!-- Modal with unique ID -->
                        <div class='modal fade' id='{$modalId}' tabindex='-1' aria-labelledby='{$modalId}Label' aria-hidden='true'>
                          <div class='modal-dialog modal-dialog-centered modal-sm'>
                            <div class='modal-content bg-dark'>
                              <div class='modal-body' style='color: #fff'>
                                Are you sure you want to delete \"" . htmlspecialchars($row['title']) . "\"?
                              </div>
                              <div class='modal-footer'>
                                <button type='button' class='btn btn-secondary' data-bs-dismiss='modal'>Close</button>
                                <button type='submit' class='btn btn-danger'>Yes, Delete</button>
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
              echo "<tr><td colspan='3' class='text-center'><h5>No posts found!</h5></td></tr>";
            }
            
            mysqli_close($connection);
          ?>
          
        </tbody>
      </table>
    </div>
  </main>

  <!-- Bootstrap -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
</body>

</html>