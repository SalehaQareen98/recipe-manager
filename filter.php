<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

require_once('database.php');
$db = db_connect();

$user_id = $_SESSION['user_id']; // Retrieve the logged-in user's ID
$filter = $_GET['filter'] ?? ''; // Retrieve the filter parameter from the URL

// Initialize the base SQL query
$sql = "SELECT * FROM recipes WHERE UserID = '$user_id'";

// Append conditions based on the selected filter
if ($filter === 'Vegetarian') {
    $sql .= " AND Vegetarian = 1";
} elseif ($filter === 'Non-Vegetarian') {
    $sql .= " AND Vegetarian = 0";
} elseif (in_array($filter, ['15', '30', '60'])) {
    $sql .= " AND TIME_TO_SEC(STR_TO_DATE(TimeToCook, '%i minutes')) <= " . ($filter * 60);
}

$result_set = mysqli_query($db, $sql);

if (!$result_set) {
    die("Database query failed: " . mysqli_error($db));
}

// Fetch and generate the filtered recipes HTML
$response = '';

while ($recipe = mysqli_fetch_assoc($result_set)) {
    $response .= '<div class="recipe-card" onclick="window.location.href=\'show.php?id=' . $recipe['RecipeID'] . '\'">';
    $response .= '<div class="recipe-image"><img src="images/login-photo.jpg" alt="Recipe Image"></div>';
    $response .= '<h2 class="recipe-title">' . htmlspecialchars($recipe['Title']) . '</h2>';
    $response .= '</div>';
}

if (empty($response)) {
    $response = '<p>No recipes found for the selected filter.</p>';
}

// Free result set and close the connection
mysqli_free_result($result_set);
db_disconnect($db);

// Return the response
echo $response;
