<?php
require_once('../database/database.php');

$db = db_connect();

// Check if the request method is POST, as this script is intended to handle POST requests only
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Validate and sanitize the 'id' parameter from the POST request
    $id = isset($_POST['id']) ? mysqli_real_escape_string($db, $_POST['id']) : null;
    
    // Check if the 'id' parameter is valid (not null or empty)
    if ($id) {
        // Construct the SQL query to delete the recipe with the specified RecipeID
        $sql = "DELETE FROM recipes WHERE RecipeID = '$id'";
        // Execute the DELETE query
        $result = mysqli_query($db, $sql);

        if ($result) {
            // Set the HTTP response code to 200 (OK) and return a success message
            http_response_code(200);
            echo "Recipe deleted successfully.";
        } else {
            // Set the HTTP response code to 500 (Internal Server Error) and return the error message
            http_response_code(500);
            echo "Deletion failed: " . mysqli_error($db);
        }
    } else {
        // Set the HTTP response code to 400 (Bad Request) if the 'id' parameter is missing or invalid
        http_response_code(400);
        echo "Invalid recipe ID.";
    }
    // Terminate the script to prevent further processing
    exit;
} else {
    // Set the HTTP response code to 405 (Method Not Allowed) if the request is not a POST request
    http_response_code(405);
    echo "Method not allowed.";
    exit;
}
