<?php
session_start();
if (!isset($_SESSION['userid']) || $_SESSION['userrole'] !== 'author') {
    header('Location: login.php');
    exit();
}
require 'db.php';


$error = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = $_POST['title'];
    $category = $_POST['category'];
    $cook_time = $_POST['cook_time'];
    $servings = intval($_POST['servings']);
    $description = $_POST['description'];
    $author_id = $_SESSION['userid'];
    $name = preg_replace('/[^a-zA-Z0-9_\- ]/', '', $title); 

    // Handle image upload
    $image_path = '';
    if (isset($_FILES['image']) && $_FILES['image']['tmp_name']) {
        $img_name = uniqid('recipe_') . '_' . basename($_FILES['image']['name']);
        $target = 'mesob_match_picture/' . $img_name;
        if (move_uploaded_file($_FILES['image']['tmp_name'], $target)) {
            $image_path = $target;
        }
    }

    // Insert recipe
    $stmt = $conn->prepare("INSERT INTO recipes (name, title, category, cook_time, servings, image, description, author_id) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
    if (!$stmt) {
        $error = 'Failed to prepare recipe insert: ' . $conn->error;
    } else {
        $stmt->bind_param('ssssissi', $name, $title, $category, $cook_time, $servings, $image_path, $description, $author_id);
        if (!$stmt->execute()) {
            $error = 'Failed to insert recipe: ' . $stmt->error;
        } else {
            $recipe_id = $stmt->insert_id;
            $stmt->close();

            // Handle ingredients (required/optional)
            $required_ingredients = array_filter(array_map('trim', explode(',', $_POST['required_ingredients'])));
            $optional_ingredients = array_filter(array_map('trim', explode(',', $_POST['optional_ingredients'])));
            foreach (['required' => $required_ingredients, 'optional' => $optional_ingredients] as $type => $ingredients) {
                $is_optional = $type === 'optional' ? 1 : 0;
                foreach ($ingredients as $ingredient) {
                    $ingredient = trim($ingredient);
                    if ($ingredient === '') continue;

                    $result = mysqli_query($conn, "SELECT id FROM ingredients WHERE name='" . mysqli_real_escape_string($conn, $ingredient) . "'");
                    if ($row = mysqli_fetch_assoc($result)) {
                        $ingredient_id = $row['id'];
                    } else {
                        if (!mysqli_query($conn, "INSERT INTO ingredients (name) VALUES ('" . mysqli_real_escape_string($conn, $ingredient) . "')")) {
                            $error = 'Failed to insert ingredient: ' . mysqli_error($conn);
                            break 2;
                        }
                        $ingredient_id = mysqli_insert_id($conn);
                    }
                    // Link to recipe
                    if (!mysqli_query($conn, "INSERT INTO recipe_ingredients (recipe_id, ingredient_id, is_optional) VALUES ($recipe_id, $ingredient_id, $is_optional)")) {
                        $error = 'Failed to link ingredient: ' . mysqli_error($conn);
                        break 2;
                    }
                }
            }

            // Handle instructions (one per line)
            $instructions = array_filter(array_map('trim', explode("\n", $_POST['instructions'])));
            $step = 1;
            foreach ($instructions as $instruction) {
                $stmt = $conn->prepare("INSERT INTO instructions (recipe_id, step_number, instruction) VALUES (?, ?, ?)");
                if (!$stmt) {
                    $error = 'Failed to prepare instruction insert: ' . $conn->error;
                    break;
                }
                $stmt->bind_param('iis', $recipe_id, $step, $instruction);
                if (!$stmt->execute()) {
                    $error = 'Failed to insert instruction: ' . $stmt->error;
                    $stmt->close();
                    break;
                }
                $stmt->close();
                $step++;
            }
        }
    }
    if (!$error) {
        header('Location: dashboard.php');
        exit();
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Recipe</title>
    <link rel="stylesheet" href="addrecipe.css">
</head>
<body>
<header class="medium-header">
    <div class="medium-header-left">
        <span class="medium-logo">Add Recipe</span>
        <span class="medium-username-sub"><?php echo htmlspecialchars($_SESSION['username']); ?></span>
    </div>
    <div class="medium-user-menu">
        <button class="user-icon" id="userIconBtn"><?php echo strtoupper(substr($_SESSION['username'], 0, 1)); ?></button>
        <div class="user-dropdown" id="userDropdown">
            <a href="dashboard.php">Dashboard</a>
            <a href="logout.php">Logout</a>
        </div>
    </div>
</header>
<a href="index.php#hero" class="home-btn-floating icon-btn" id="homeBtn" title="Home">
    <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 24 24"><path d="M3 11.5L12 4l9 7.5V20a1 1 0 0 1-1 1h-5a1 1 0 0 1-1-1v-4h-4v4a1 1 0 0 1-1 1H4a1 1 0 0 1-1-1V11.5z"/></svg>
</a>
<a href="#" class="back-btn-floating icon-btn" id="backBtn" title="Back">
    <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 24 24"><path d="M15 19l-7-7 7-7" stroke-linecap="round" stroke-linejoin="round"/></svg>
</a>
<main class="medium-main">
    <?php if ($error): ?>
        <div style="color: #b71c1c; background: #ffeaea; border: 1px solid #f5c2c7; padding: 1em; border-radius: 8px; margin-bottom: 1.5em;">
            <?php echo htmlspecialchars($error); ?>
        </div>
    <?php endif; ?>
    <form class="medium-form" action="insertPost.php" method="POST" enctype="multipart/form-data">
        <input class="medium-title" type="text" name="title" placeholder="Recipe Title" required>
        <div class="medium-form-row">
            <input class="medium-category" type="text" name="category" placeholder="Category (e.g. Key Wot)" required>
            <input class="medium-category" type="text" name="cook_time" placeholder="Cook Time (e.g. 45 mins)" required>
            <input class="medium-category" type="number" name="servings" placeholder="Servings" min="1" required>
        </div>
        <textarea class="medium-content" name="description" placeholder="Short description" required></textarea>
        <div class="medium-form-row">
            <label class="medium-image-btn" for="image">Upload Image</label>
            <input class="medium-image-input" type="file" name="image" id="image" accept="image/*">
        </div>
        <input class="medium-category" type="text" name="required_ingredients" placeholder="Required Ingredients (comma separated)" required>
        <input class="medium-category" type="text" name="optional_ingredients" placeholder="Optional Ingredients (comma separated)">
        <textarea class="medium-content" name="instructions" placeholder="Instructions (one step per line)" required></textarea>
        <button class="medium-publish" type="submit">Publish Recipe</button>
    </form>
</main>
<script>
document.addEventListener('DOMContentLoaded', function() {
    const userIconBtn = document.getElementById('userIconBtn');
    const userDropdown = document.getElementById('userDropdown');
    if(userIconBtn) {
        userIconBtn.addEventListener('click', function(e) {
            e.stopPropagation();
            userDropdown.classList.toggle('show');
        });
    }
    document.addEventListener('click', function() {
        userDropdown.classList.remove('show');
    });
    // Show file name on file input change only (remove label click handler)
    const imageInput = document.getElementById('image');
    const imageLabel = document.querySelector('.medium-image-btn');
    if (imageInput && imageLabel) {
        imageInput.addEventListener('change', function() {
            if (imageInput.files.length > 0) {
                imageLabel.textContent = imageInput.files[0].name;
            } else {
                imageLabel.textContent = 'Upload Image';
            }
        });
    }
    var homeBtn = document.getElementById('homeBtn');
    if (homeBtn) {
        homeBtn.addEventListener('click', function(e) {
            e.preventDefault();
            window.location.href = 'index.php#hero';
        });
    }
    var backBtn = document.getElementById('backBtn');
    if (backBtn) {
        backBtn.addEventListener('click', function(e) {
            e.preventDefault();
            if (window.history.length > 1) {
                window.history.back();
            } else {
                window.location.href = 'dashboard.php';
            }
        });
    }
});
</script>
</body>
</html> 