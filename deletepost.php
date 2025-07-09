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
if ($userrole === 'admin') {
    $allowed = true;
} else {
    $result = mysqli_query($conn, "SELECT author_id FROM recipes WHERE id=$post_id");
    if ($row = mysqli_fetch_assoc($result)) {
        if ($row['author_id'] == $userid) {
            $allowed = true;
        }
    }
}

if ($allowed) {
    
    mysqli_query($conn, "DELETE FROM instructions WHERE recipe_id=$post_id");
    mysqli_query($conn, "DELETE FROM recipe_ingredients WHERE recipe_id=$post_id");
    mysqli_query($conn, "DELETE FROM recipes WHERE id=$post_id");
    header('Location: dashboard.php');
    exit();
} else {
    echo '<p style="color:red;">You are not allowed to delete this recipe.</p>';
    echo '<a href="dashboard.php">Back to Dashboard</a>';
}
?> 