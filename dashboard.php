<?php
session_start();

if(!isset($_SESSION['userid'])){
  header("Location: login.php");
  exit();
}

require_once "db.php";

$userid = $_SESSION['userid'];
$userrole = $_SESSION['userrole'];
$username = $_SESSION['username'];


$recipe_count = mysqli_fetch_row(mysqli_query($conn, "SELECT COUNT(*) FROM recipes"))[0];
$ingredient_count = mysqli_fetch_row(mysqli_query($conn, "SELECT COUNT(*) FROM ingredients"))[0];
$category_result = mysqli_query($conn, "SELECT DISTINCT category FROM recipes");

$categories = [];
while ($row = mysqli_fetch_assoc($category_result)) {
  $categories[] = $row['category'];
}
$category_count = count($categories);


if ($userrole === 'admin') {
  $recipes = mysqli_query($conn, "SELECT * FROM recipes ORDER BY id DESC");
} else {
  $recipes = mysqli_query($conn, "SELECT * FROM recipes WHERE author_id='$userid' ORDER BY id DESC");
}
$ingredients = mysqli_query($conn, "SELECT name FROM ingredients ORDER BY id DESC LIMIT 5");
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="dashboard.css">
  <title>Recipe Dashboard</title>
</head>
<body class="dashboard-body">
  <header class="medium-header">
    <div class="medium-header-left">
      <span class="medium-logo">Recipe Dashboard</span>
      <span class="medium-username-sub"> <?php echo htmlspecialchars($username); ?> </span>
    </div>
    <div class="medium-user-menu">
      <?php if ($userrole !== 'admin') { ?>
        <a href="insertPost.php" class="dashboard-newpost-btn">+ Create Recipe</a>
      <?php } ?>
      <div class="user-icon" id="userIconBtn">
        <?php echo strtoupper(substr($username, 0, 1)); ?>
      </div>
      <div class="user-dropdown" id="userDropdown">
        <a href="index.php">Back to Home</a>
        <a href="logout.php">Logout</a>
      </div>
    </div>
  </header>
  
  <main class="dashboard-main">
    <h1 class="dashboard-main-title">All Recipes</h1>
    <div class="dashboard-posts-grid">
      <?php while($row = mysqli_fetch_assoc($recipes)) { ?>
        <div class="dashboard-post-card">
          <?php if (!empty($row['image'])) { ?>
            <img src="<?php echo htmlspecialchars($row['image']); ?>" alt="Recipe Image" class="dashboard-post-image">
          <?php } ?>
          <div class="dashboard-post-info">
            <div class="dashboard-post-title">
              <?php echo htmlspecialchars($row['title']); ?>
            </div>
            <?php if (!empty($row['created_at'])) { ?>
              <div class="dashboard-post-date">
                <?php echo date('F j, Y', strtotime($row['created_at'])); ?>
              </div>
            <?php } ?>
            <div class="dashboard-post-actions">
              <?php if ($userrole !== 'admin' && $row['author_id'] == $userid) { ?>
                <a href="updatepost.php?post_id=<?php echo $row['id']; ?>" class="dashboard-view-btn">Update</a>
              <?php } ?>
              <?php if (($userrole === 'admin') || ($row['author_id'] == $userid)) { ?>
                <a href="deletepost.php?post_id=<?php echo $row['id']; ?>" class="dashboard-delete-btn">Delete</a>
              <?php } ?>
            </div>
          </div>
        </div>
      <?php } ?>
    </div>
  </main>
  <?php include "footer.php"; ?>
  <script>
  document.addEventListener('DOMContentLoaded', function() {
      const userIconBtn = document.getElementById('userIconBtn');
      const userDropdown = document.getElementById('userDropdown');
      if(userIconBtn) {
          userIconBtn.addEventListener('click', function(e) {
              e.stopPropagation();
              if(userDropdown) userDropdown.classList.toggle('show');
          });
      }
      document.addEventListener('click', function() {
          if(userDropdown) userDropdown.classList.remove('show');
      });
      var homeBtn = document.getElementById('homeBtn');
      if (homeBtn) {
          homeBtn.addEventListener('click', function(e) {
              
          });
      }
      var backBtn = document.getElementById('backBtn');
      if (backBtn) {
          backBtn.addEventListener('click', function(e) {
              e.preventDefault();
              if (window.history.length > 1) {
                  window.history.back();
              } else {
                  window.location.href = 'insertPost.php';
              }
          });
      }
  });
  </script>
</body>
</html>