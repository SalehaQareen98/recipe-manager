<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: ../pages/login_page.php");
    exit;
}

require_once('../database/database.php');
$db = db_connect();

// Check if the RecipeID is provided
if (!isset($_GET['id'])) {
    header("Location: ../pages/login_page.php"); // Redirect to login if no ID is provided
    exit;
}

$id = $_GET['id']; // Get the RecipeID from the URL

// Fetch current recipe data
$sql = "SELECT * FROM recipes WHERE RecipeID = $id";
$result_set = mysqli_query($db, $sql);
$result = mysqli_fetch_assoc($result_set); // Fetch the recipe data

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $errors = []; // Array to store image upload errors

    // Access the recipe information from the form
    $title = $_POST['title'];
    $time_to_cook = $_POST['time_to_cook'];
    $vegetarian = $_POST['vegetarian'];
    $ingredients = $_POST['ingredients'];
    $directions = $_POST['directions'];
    $type = $_POST['type'];

    // Handle image upload
    $imagePath = $result['Image']; // Default to current image path if no new image is uploaded
    if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
        // Process the uploaded image
        $targetDir = "../uploads/"; // Set the target directory
        $targetFile = $targetDir . basename($_FILES['image']['name']);
        $uploadOk = true;
        $imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));
        $allowedFileTypes = ['jpg', 'jpeg', 'png', 'gif'];

        // Check if the file is an actual image
        if (getimagesize($_FILES['image']['tmp_name']) === false) {
            $errors[] = "Uploaded file is not a valid image.";
            $uploadOk = false;
        }

        // Check file size (2MB limit)
        if ($_FILES['image']['size'] > 2000000) {
            $errors[] = "Image size exceeds 2MB.";
            $uploadOk = false;
        }

        // Allow certain file formats
        if (!in_array($imageFileType, $allowedFileTypes)) {
            $errors[] = "Only JPG, JPEG, PNG, and GIF files are allowed.";
            $uploadOk = false;
        }

        // If valid, move the uploaded file
        if ($uploadOk) {
            if (move_uploaded_file($_FILES['image']['tmp_name'], $targetFile)) {
                $imagePath = $targetFile;
            } else {
                $errors[] = "Error occurred while uploading the file.";
            }
        }
    }

    // If there are no image errors, update the recipe with the new information and image
    if (empty($errors)) {
        $sql = "UPDATE recipes SET 
                Title = '$title', 
                TimeToCook = '$time_to_cook', 
                Vegetarian = $vegetarian, 
                Ingredients = '$ingredients', 
                Directions = '$directions', 
                Type = '$type', 
                Image = '$imagePath' 
                WHERE RecipeID = $id";
        $result = mysqli_query($db, $sql);

        // Redirect to the show page
        header("Location: ../pages/view_recipe.php?id=$id");
        exit;
    } else {
        // Store errors in session and redirect back to the edit page
        $_SESSION['errors'] = $errors;
        header("Location: ../pages/edit_recipe_page.php?id=$id");
        exit;
    }
}
?>
