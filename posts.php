<?php
require_once("admin-verify.php");

include("./includes/db_connect.php");
include("./includes/functions.php");

if($_SERVER["REQUEST_METHOD"] == "POST"){

  //Get input from user
  $title = $_POST['title'];
  $slug = create_slug($title);
  $img_src = $_POST['img-src'];
  $content = $_POST['content'];

  //Dealing with the images
  $file_name = $_FILES['image']['name']; 
  $file_name = str_replace([" ", "'", '"', '&', '(', ')'], "_", $file_name);
  //$file_name = str_replace(" ", "_", $file_name);
  $file_tmp_name = $_FILES['image']['tmp_name'];
  $file_destination = 'uploads/' . $file_name; 

  //Ensuring user uploads only valid Image
  if($_FILES['image']['error'] === 0){
    $finfo = finfo_open(FILEINFO_MIME_TYPE);
    $mime_type = finfo_file($finfo, $file_tmp_name);
    
    $file_types = ["image/jpeg", "image/png", "image/gif", "image/webp"];

    if(in_array($mime_type, $file_types)){
      $image_info = getimagesize($file_tmp_name);

      if($image_info !== false){
        move_uploaded_file($file_tmp_name, $file_destination);

        //Send details to database
        $sql = "INSERT INTO posts (title, slug, image, image_source, content) VALUES (?, ?, ?, ?, ?)";

        $stmt = mysqli_prepare($connection, $sql);
        mysqli_stmt_bind_param(
          $stmt,
          "sssss",
          $title,
          $slug,
          $file_destination,
          $img_src,
          $content
        );

        $query = mysqli_stmt_execute($stmt);

        if($query){
          $success = "<div class='alert alert-success alert-dismissible fade show' role='alert'>
              You have successfully uploaded your post.
            <div type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></div>
          </div>";
        } else {
          $unsuccessful = "<div class='alert alert-error alert-dismissible fade show' role='alert'>
              Could not upload post!
            <div type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></div>
          </div>";
        }
      } else{
        $image_error = "<div class='alert alert-danger alert-dismissible fade show' role='alert'>
            Only Images are allowed!
          <div type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></div>
        </div>";
      }
    } else {
        $image_error = "<div class='alert alert-danger alert-dismissible fade show' role='alert'>
            Only Images are allowed!
          <div type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></div>
        </div>";      
    }
  } else {
        $image_error = "<div class='alert alert-danger alert-dismissible fade show' role='alert'>
            Only Images are allowed!
          <div type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></div>
        </div>";
  }
}
?>
<!DOCTYPE html>
<html lang="en">

<!-- Header Goes here -->
<?php include("./includes/post-header.php") ?>

<body>

  <!-- Side Nav -->
  <?php include("./includes/admin-nav.php") ?>

  <!-- Main section -->
  <main>
    <div class="main-nav">
      <h2>Post a Blog Today !</h2>
      <a href="./logout.php">Logout <img src="./assets/logout-icon.svg" alt="Log out Icon"></a>
    </div>

    <div class="new-post">
      <div class="container">

      <?php if(isset($image_error)) echo $image_error; ?>
      <?php if(isset($success)) echo $success; ?>
      <?php if(isset($unsuccessful)) echo $unsuccessful; ?>

        <form id="postForm" action="posts.php" method="post" enctype="multipart/form-data">

          <div class="mb-4">
            <label for="Blog Title" class="form-label">Title</label>
            <input type="text" class="form-control" id="blog-title" name="title" placeholder="This is the title of the blog ... " required>
          </div>

          <div class="row">
            <div class="col-lg-6 col-sm-6">
              <div class="mb-4">
                <label for="formFile" class="form-label">Upload your blog Image</label>
                <input class="form-control" name="image" type="file" id="formFile" required>
              </div>
            </div>

            <div class="col-lg-6 col-sm-6">
              <div class="mb-4">
                <label for="Image Source" class="form-label">Image Source</label>
                <input type="text" class="form-control" id="image-source" name="img-src" placeholder="Enter your image source" required>
              </div>
            </div>
          </div>

          <!-- Quill editor -->
          <div id="editor"> </div>

          <!-- Hidden input that will be sent to backend -->
          <input type="hidden" name="content" id="content" required>

          <button type="submit" name="publish">Publish</button>

        </form>
      </div>
    </div>

  </main>



  <!-- bootstrap js -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>

  <!-- Quill js -->
  <script src="https://cdn.jsdelivr.net/npm/quill@2.0.3/dist/quill.js"></script>
  <script src="./js/quillSetup.js"></script>

</body>

</html>