<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: index.php");
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
    // Convert the TimeToCook column to minutes for comparison
    $sql .= " AND TIME_TO_SEC(STR_TO_DATE(TimeToCook, '%i minutes')) <= " . ($filter * 60);
}
// Execute the query
$result_set = mysqli_query($db, $sql);

if (!$result_set) {
    die("Database query failed: " . mysqli_error($db));
}

// Fetch and display the filtered recipes
while ($recipe = mysqli_fetch_assoc($result_set)) {
    echo "<h2>" . htmlspecialchars($recipe['Title']) . "</h2>";
    echo "<p>Time to Cook: " . htmlspecialchars($recipe['TimeToCook']) . "</p>";
    echo "<p>Vegetarian: " . ($recipe['Vegetarian'] ? 'Yes' : 'No') . "</p>";
    // Add more fields as necessary
}

// Free the result set
mysqli_free_result($result_set);

// Close the database connection
db_disconnect($db);
?>
