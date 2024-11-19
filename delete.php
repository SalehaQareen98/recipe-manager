<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="style.css" />
    <title>Delete Recipe</title>
</head>
<body>
<?php
require_once('database.php');
include "header.php";

$db = db_connect();

// Check if the RecipeID is provided
if (!isset($_GET['id'])) {
    header("Location: index.php"); // Redirect to index if no ID is provided
    exit;
}

$id = $_GET['id']; // Get the RecipeID from the URL

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Execute the DELETE query
    $sql = "DELETE FROM recipes WHERE RecipeID = '$id'";
    $result = mysqli_query($db, $sql);

    if ($result) {
        // Redirect to the main page after deletion
        header("Location: index.php");
        exit;
    } else {
        // Handle query error
        die("Deletion failed: " . mysqli_error($db));
    }
} else {
    // Fetch the recipe details to display for confirmation
    $sql = "SELECT * FROM recipes WHERE RecipeID = '$id'";
    $result_set = mysqli_query($db, $sql);

    if (!$result_set) {
        die("Database query failed: " . mysqli_error($db));
    }

    $result = mysqli_fetch_assoc($result_set);

    if (!$result) {
        die("No recipe found with ID: $id");
    }
}
?>

<div id="content">
    <a class="back-link" href="index.php">&laquo; Back to List</a>

    <div class="page delete">
        <h1>Delete Recipe</h1>
        <p>Are you sure you want to delete this recipe?</p>
        <p class="item"><strong><?php echo htmlspecialchars($result['Title']); ?></strong></p>

        <form action="<?php echo 'delete.php?id=' . $result['RecipeID']; ?>" method="post">
            <div id="operations">
                <input type="submit" name="commit" value="Delete Recipe" />
            </div>
        </form>
    </div>
</div>

<?php include 'footer.php'; ?>
</body>
</html>
