<?php
require_once("admin-verify.php");

if (!(isset($_GET['id'])) || !(is_numeric($_GET['id']))) {
  header("Location: all-posts.php");
  exit();
}
include("./includes/db_connect.php");
$post_id = (int) $_GET['id'];

$sql = "SELECT * FROM posts WHERE id = ?";
$stmt = mysqli_prepare($connection, $sql);
mysqli_stmt_bind_param($stmt, "i", $post_id);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);

$row = mysqli_fetch_assoc($result);
?>
<!DOCTYPE html>
<html lang="en">

<!-- Header Goes Here -->
<?php include("./includes/post-header.php") ?>

<body>

  <!-- Side Nav -->
  <nav style="display: none;"></nav>

  <!-- Main section -->
  <main style="margin: 0;">
    <div class="main-nav">
      <h2>Edit your post here!</h2>
    </div>

    <div class="new-post">
      <div class="container">

        <form id="postForm" action="update.php" method="post" enctype="multipart/form-data">

          <div class="mb-4">
            <label for="Blog Title" class="form-label">Edit Title</label>
            <input type="text" class="form-control" id="blog-title" name="title" placeholder="This is the title of the blog ... " value="<?php echo $row['title'] ?>">
          </div>

          <div class="row">
            <div class="col-lg-6 col-sm-6">
              <div class="mb-4">
                <label for="formFile" class="form-label">Edit your blog Image</label>
                <input class="form-control" name="image" type="file" id="formFile">
              </div>
            </div>

            <div class="col-lg-6 col-sm-6">
              <div class="mb-4">
                <label for="Image Source" class="form-label">Edit Image Source</label>
                <input type="text" class="form-control" id="image-source" name="img-src" value="<?php echo $row['image_source'] ?>">
              </div>
            </div>
          </div>

          <!-- Quill editor -->
          <div id="editor">
            <?php echo $row['content'] ?>
          </div>

          <!-- Hidden input that will be sent to backend -->
          <input type="hidden" name="content" id="content">
          <input type="hidden" name="id" value="<?php echo $row['id'] ?>">
          <input type="hidden" name="previous-image" value="<?php echo $row['image'] ?>">

          <button type="submit" name="publish">Update</button>

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