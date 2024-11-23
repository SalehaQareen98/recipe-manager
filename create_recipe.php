<?php
session_start(); // Start the session to access session variables
require_once('database.php'); // Include database connection
include "header.php"; // Include the header for consistent layout

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: login_page.php"); // Redirect to login page
    exit;
}

// Connect to the database
$db = db_connect();

// Handle form values sent by new_recipe_page.php
if ($_SERVER['REQUEST_METHOD'] == 'POST') { // Ensure the form is submitted via POST
    // Capture form data
    $title = $_POST['title']; // Recipe title
    $time_to_cook = $_POST['time_to_cook']; // Time to cook
    $vegetarian = $_POST['vegetarian']; // 1 for Vegetarian, 0 for Non-Vegetarian
    $ingredients = $_POST['ingredients']; // Ingredients list
    $directions = $_POST['directions']; // Cooking directions
    $type = $_POST['type']; // Recipe type (Appetizer, Main Course, etc.)
    $user_id = $_SESSION['user_id']; // Get the logged-in user's ID from session

    // Handle image upload
    $image = "uploads/placeholder.jpg"; // Default image path if no image is uploaded
    if (isset($_FILES['recipe_image']) && $_FILES['recipe_image']['error'] === UPLOAD_ERR_OK) {
        $targetDir = "uploads/";
        $fileName = basename($_FILES["recipe_image"]["name"]);
        $targetFile = $targetDir . $fileName;

        // Ensure the uploads directory exists
        if (!is_dir($targetDir)) {
            mkdir($targetDir, 0777, true);
        }

        // Validate file type (optional: only allow image files)
        $fileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));
        $validExtensions = ['jpg', 'jpeg', 'png', 'gif'];
        if (!in_array($fileType, $validExtensions)) {
            echo "Error: Only JPG, JPEG, PNG, and GIF files are allowed.";
            exit;
        }

        // Move uploaded file to the target directory
        if (move_uploaded_file($_FILES["recipe_image"]["tmp_name"], $targetFile)) {
            $image = $targetFile; // Set the image path to the uploaded file
        } else {
            echo "Error uploading image.";
            exit;
        }
    }

    // Prepare the SQL query string
    $sql = "INSERT INTO recipes (Title, TimeToCook, Vegetarian, Ingredients, Directions, Type, UserID, Image) 
            VALUES ('$title', '$time_to_cook', $vegetarian, '$ingredients', '$directions', '$type', $user_id, '$image')";

    // Execute the query
    $result = mysqli_query($db, $sql);

    // Check the result and handle success or error
    if ($result) {
        $id = mysqli_insert_id($db); // Get the ID of the newly inserted recipe
        // Redirect to the show page with the generated ID
        header("Location: view_recipe.php?id=$id");
        exit;
    } else {
        // Handle query error
        echo "Error adding recipe: " . mysqli_error($db);
    }
} else {
    // Redirect to the form page if the request is not POST
    header("Location: new_recipe_page.php");
    exit;
}

// Close the database connection
db_disconnect($db);
?>
