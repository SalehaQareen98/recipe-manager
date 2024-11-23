<?php
session_start(); // Start the session to access session variables

if (!isset($_SESSION['user_id'])) {
    header("Location: ../pages/login_page.php");
    exit;
}

require_once('../database/database.php'); // Include your database connection script
$db = db_connect(); // Establish a database connection

// Retrieve the keyword from the POST request
$keyword = $_POST['keyword'] ?? '';
$user_id = $_SESSION['user_id'];

$response = ''; // Initialize response

// Construct SQL query based on whether a keyword is provided
if (!empty($keyword)) {
    // Sanitize the keyword to prevent SQL injection
    $keyword = mysqli_real_escape_string($db, $keyword);

    // Search query
    $sql = "SELECT * FROM recipes WHERE UserID = '$user_id' AND (
            Title LIKE '%$keyword%' OR 
            Ingredients LIKE '%$keyword%' OR 
            Directions LIKE '%$keyword%' OR 
            Type LIKE '%$keyword%'
        ) ORDER BY TimeToCook ASC";
} else {
    // Default query to fetch all recipes
    $sql = "SELECT * FROM recipes WHERE UserID = '$user_id' ORDER BY TimeToCook ASC";
}

// Execute the query
$result_set = mysqli_query($db, $sql);

if (!$result_set) {
    die("Database query failed: " . mysqli_error($db));
}

// Generate the HTML for the recipes
if (mysqli_num_rows($result_set) > 0) {
    while ($recipe = mysqli_fetch_assoc($result_set)) {
        $response .= '<div class="recipe-card" onclick="window.location.href=\'../pages/view_recipe.php?id=' . $recipe['RecipeID'] . '\'">';
        $response .= '<div class="recipe-image">';
        $response .= '<img src="' . htmlspecialchars($recipe['Image']) . '" alt="Recipe Image">';
        $response .= '</div>';
        $response .= '<h2 class="recipe-title">' . htmlspecialchars($recipe['Title']) . '</h2>';
        $response .= '</div>';
    }
} else {
    // No results found
    $response = '<p>No recipes found.</p>';
}

// Free the result set and close the database connection
mysqli_free_result($result_set);
db_disconnect($db);

// Output the response
echo $response;
?>
