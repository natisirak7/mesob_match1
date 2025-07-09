<?php
session_start();
if (!isset($_SESSION['userid'])) {
    header('Location: login.php');
    exit();
}
require 'db.php';

$userid = $_SESSION['userid'];
$userrole = $_SESSION['userrole'];

if (!isset($_GET['post_id'])) {
    header('Location: dashboard.php');
    exit();
}
$post_id = intval($_GET['post_id']);


$allowed = false;

$result = mysqli_query($conn, "SELECT author_id FROM recipes WHERE id=$post_id");
if ($row = mysqli_fetch_assoc($result)) {
    if ($row['author_id'] == $userid && $userrole !== 'admin') {
        $allowed = true;
    }
}

if (!$allowed) {
    echo '<p style="color:red;">You are not allowed to update this recipe.</p>';
    echo '<a href="dashboard.php">Back to Dashboard</a>';
    exit();
}


$recipe = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM recipes WHERE id=$post_id"));
$ingredients = [];
$optional_ingredients = [];
$ingredient_result = mysqli_query($conn, "SELECT i.name, ri.is_optional FROM recipe_ingredients ri JOIN ingredients i ON ri.ingredient_id = i.id WHERE ri.recipe_id = $post_id");
while ($row = mysqli_fetch_assoc($ingredient_result)) {
    if ($row['is_optional']) {
        $optional_ingredients[] = $row['name'];
    } else {
        $ingredients[] = $row['name'];
    }
}
$instructions = [];
$inst_result = mysqli_query($conn, "SELECT instruction FROM instructions WHERE recipe_id = $post_id ORDER BY step_number ASC");
while ($row = mysqli_fetch_assoc($inst_result)) {
    $instructions[] = $row['instruction'];
}

$error = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = $_POST['title'];
    $category = $_POST['category'];
    $cook_time = $_POST['cook_time'];
    $servings = intval($_POST['servings']);
    $description = $_POST['description'];
    $name = preg_replace('/[^a-zA-Z0-9_\- ]/', '', $title);
    $image_path = $recipe['image'];
    if (isset($_FILES['image']) && $_FILES['image']['tmp_name']) {
        $img_name = uniqid('recipe_') . '_' . basename($_FILES['image']['name']);
        $target = 'mesob_match_picture/' . $img_name;
        if (move_uploaded_file($_FILES['image']['tmp_name'], $target)) {
            $image_path = $target;
        }
    }
    // Update recipe
    $stmt = $conn->prepare("UPDATE recipes SET name=?, title=?, category=?, cook_time=?, servings=?, image=?, description=? WHERE id=?");
    if (!$stmt) {
        $error = 'Failed to prepare recipe update: ' . $conn->error;
    } else {
        $stmt->bind_param('ssssissi', $name, $title, $category, $cook_time, $servings, $image_path, $description, $post_id);
        if (!$stmt->execute()) {
            $error = 'Failed to update recipe: ' . $stmt->error;
        } else {
            $stmt->close();
            
            mysqli_query($conn, "DELETE FROM recipe_ingredients WHERE recipe_id=$post_id");
            mysqli_query($conn, "DELETE FROM instructions WHERE recipe_id=$post_id");
            
            $required_ingredients = array_filter(array_map('trim', explode(',', $_POST['required_ingredients'])));
            $optional_ingredients = array_filter(array_map('trim', explode(',', $_POST['optional_ingredients'])));
            foreach (['required' => $required_ingredients, 'optional' => $optional_ingredients] as $type => $ings) {
                $is_optional = $type === 'optional' ? 1 : 0;
                foreach ($ings as $ingredient) {
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
                    if (!mysqli_query($conn, "INSERT INTO recipe_ingredients (recipe_id, ingredient_id, is_optional) VALUES ($post_id, $ingredient_id, $is_optional)")) {
                        $error = 'Failed to link ingredient: ' . mysqli_error($conn);
                        break 2;
                    }
                }
            }
            
            $instructions = array_filter(array_map('trim', explode("\n", $_POST['instructions'])));
            $step = 1;
            foreach ($instructions as $instruction) {
                $stmt = $conn->prepare("INSERT INTO instructions (recipe_id, step_number, instruction) VALUES (?, ?, ?)");
                if (!$stmt) {
                    $error = 'Failed to prepare instruction insert: ' . $conn->error;
                    break;
                }
                $stmt->bind_param('iis', $post_id, $step, $instruction);
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
    <title>Update Recipe</title>
    <link rel="stylesheet" href="addrecipe.css">
</head>
<body>
<header class="medium-header">
    <div class="medium-header-left">
        <span class="medium-logo">Update Recipe</span>
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
<main class="medium-main">
    <?php if ($error): ?>
        <div style="color: #b71c1c; background: #ffeaea; border: 1px solid #f5c2c7; padding: 1em; border-radius: 8px; margin-bottom: 1.5em;">
            <?php echo htmlspecialchars($error); ?>
        </div>
    <?php endif; ?>
    <form class="medium-form" action="updatepost.php?post_id=<?php echo $post_id; ?>" method="POST" enctype="multipart/form-data">
        <input class="medium-title" type="text" name="title" placeholder="Recipe Title" value="<?php echo htmlspecialchars($recipe['title']); ?>" required>
        <div class="medium-form-row">
            <input class="medium-category" type="text" name="category" placeholder="Category (e.g. Key Wot)" value="<?php echo htmlspecialchars($recipe['category']); ?>" required>
            <input class="medium-category" type="text" name="cook_time" placeholder="Cook Time (e.g. 45 mins)" value="<?php echo htmlspecialchars($recipe['cook_time']); ?>" required>
            <input class="medium-category" type="number" name="servings" placeholder="Servings" min="1" value="<?php echo htmlspecialchars($recipe['servings']); ?>" required>
        </div>
        <textarea class="medium-content" name="description" placeholder="Short description" required><?php echo htmlspecialchars($recipe['description']); ?></textarea>
        <div class="medium-form-row">
            <label class="medium-image-btn" for="image">Upload Image</label>
            <input class="medium-image-input" type="file" name="image" id="image" accept="image/*">
        </div>
        <input class="medium-category" type="text" name="required_ingredients" placeholder="Required Ingredients (comma separated)" value="<?php echo htmlspecialchars(implode(', ', $ingredients)); ?>" required>
        <input class="medium-category" type="text" name="optional_ingredients" placeholder="Optional Ingredients (comma separated)" value="<?php echo htmlspecialchars(implode(', ', $optional_ingredients)); ?>">
        <textarea class="medium-content" name="instructions" placeholder="Instructions (one step per line)" required><?php echo htmlspecialchars(implode("\n", $instructions)); ?></textarea>
        <button class="medium-publish" type="submit">Update Recipe</button>
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
});
</script>
</body>
</html> 