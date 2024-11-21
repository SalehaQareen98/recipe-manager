<?php
session_start(); // Start the session to access session variables
if (!isset($_SESSION['user_id'])) {
    header("Location: index.php");
    exit;
}

require_once('database.php'); // Include your database connection script
$db = db_connect(); // Establish a database connection

// Retrieve the keyword from the POST request
$keyword = $_POST['keyword'] ?? '';
$user_id = $_SESSION['user_id'];

if (!empty($keyword)) {
    // Sanitize the keyword to prevent SQL injection
    $keyword = mysqli_real_escape_string($db, $keyword);

    // Construct the SQL query to search across multiple columns for the specific user
    $sql = "SELECT * FROM recipes WHERE UserID = '$user_id' AND (
            Title LIKE '%$keyword%' OR 
            Ingredients LIKE '%$keyword%' OR 
            Directions LIKE '%$keyword%' OR 
            Type LIKE '%$keyword%')";

    // Execute the query
    $result_set = mysqli_query($db, $sql);

    if (!$result_set) {
        die("Database query failed: " . mysqli_error($db));
    }

    // Check if any recipes were found
    if (mysqli_num_rows($result_set) > 0) {
        // Display the search results
        while ($recipe = mysqli_fetch_assoc($result_set)) {
            echo "<h2>" . htmlspecialchars($recipe['Title']) . "</h2>";
            echo "<p>Time to Cook: " . htmlspecialchars($recipe['TimeToCook']) . "</p>";
            echo "<p>Vegetarian: " . ($recipe['Vegetarian'] ? 'Yes' : 'No') . "</p>";
            echo "<p>Category: " . htmlspecialchars($recipe['Type']) . "</p>";
            echo "<p>Ingredients: " . htmlspecialchars($recipe['Ingredients']) . "</p>";
            echo "<p>Directions: " . htmlspecialchars($recipe['Directions']) . "</p>";
            // Add more fields as necessary
        }
    } else {
        // Display a message when no recipes match the search criteria
        // echo "<p>No recipes found matching your search criteria.</p>";
        header("Location:home.php");
    }

    // Free the result set
    mysqli_free_result($result_set);
// } else {
//     // Display a message when the search keyword is empty
//     echo "<p>Please enter a keyword to search for recipes.</p>";
// }  not required since are search input feild is required. 

// Close the database connection
db_disconnect($db);
?>
