<?php
require_once('database/database.php');

$db = db_connect();

// Check if the request method is POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Validate and sanitize input
    $id = isset($_POST['id']) ? mysqli_real_escape_string($db, $_POST['id']) : null;

    if ($id) {
        // Execute the DELETE query
        $sql = "DELETE FROM recipes WHERE RecipeID = '$id'";
        $result = mysqli_query($db, $sql);

        if ($result) {
            // Send success response
            http_response_code(200);
            echo "Recipe deleted successfully.";
        } else {
            // Handle query error
            http_response_code(500);
            echo "Deletion failed: " . mysqli_error($db);
        }
    } else {
        http_response_code(400);
        echo "Invalid recipe ID.";
    }
    exit;
} else {
    http_response_code(405);
    echo "Method not allowed.";
    exit;
}
