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
    // Process the form submission

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
        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));

        // Check if the file is an actual image
        if (getimagesize($_FILES['image']['tmp_name']) === false) {
            echo "File is not an image.";
            $uploadOk = 0;
        }

        // Check file size (limit to 2MB for example)
        if ($_FILES['image']['size'] > 2000000) {
            echo "Sorry, your file is too large.";
            $uploadOk = 0;
        }

        // Allow certain file formats
        if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif") {
            echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
            $uploadOk = 0;
        }

        // Check if the file was uploaded successfully
        if ($uploadOk == 1 && move_uploaded_file($_FILES['image']['tmp_name'], $targetFile)) {
            $imagePath = $targetFile; // Update image path if upload is successful
        } else {
            echo "Sorry, there was an error uploading your file.";
        }
    }

    // Update the recipe with the new information and image
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
}
?>
