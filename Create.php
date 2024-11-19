<?php

require_once('database.php'); // Include database connection
include "header.php"; // Include the header for consistent layout

// Connect to the database
$db = db_connect();

// Handle form values sent by new.php
if ($_SERVER['REQUEST_METHOD'] == 'POST') { // Ensure the form is submitted via POST
    // Capture form data
    $title = $_POST['title']; // Recipe title
    $time_to_cook = $_POST['time_to_cook']; // Time to cook
    $vegetarian = $_POST['vegetarian']; // 1 for Vegetarian, 0 for Non-Vegetarian
    $ingredients = $_POST['ingredients']; // Ingredients list
    $directions = $_POST['directions']; // Cooking directions
    $type = $_POST['type']; // Recipe type (Appetizer, Main Course, etc.)
    $user_id = 1; // Temporarily hardcoded; replace with session-based user ID when authentication is implemented

    // Prepare the SQL query string
    $sql = "INSERT INTO recipes (Title, TimeToCook, Vegetarian, Ingredients, Directions, Type, UserID) 
            VALUES ('$title', '$time_to_cook', $vegetarian, '$ingredients', '$directions', '$type', $user_id)";

    // Execute the query
    $result = mysqli_query($db, $sql);

    // Check the result and handle success or error
    if ($result) {
        $id = mysqli_insert_id($db); // Get the ID of the newly inserted recipe
        // Redirect to the show page with the generated ID
        header("Location: show.php?id=$id");
    } else {
        // Handle query error
        echo "Error adding recipe: " . mysqli_error($db);
    }
} else {
    // Redirect to the form page if the request is not POST
    header("Location: new.php");
}

// Close the database connection
db_disconnect($db);

?>
