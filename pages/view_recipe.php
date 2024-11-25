<?php
// Start a session to maintain user authentication and session data
session_start();
// Include the database connection file
require_once('../database/database.php');

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: login_page.php");
    exit; // Stop further script execution after the redirect
}
// Connect to the database
$db = db_connect();

// Check if the recipe ID is passed in the URL
if (!isset($_GET['id'])) {
        // Redirect to the login page if no recipe ID is provided
    header("Location: login_page.php");
    exit;
}
// Retrieve the recipe ID from the URL
$id = $_GET['id'];

// Fetch the recipe details from the database using the provided recipe ID
$sql = "SELECT * FROM recipes WHERE RecipeID = $id";
$result_set = mysqli_query($db, $sql);
$result = mysqli_fetch_assoc($result_set); // Fetch the recipe data as an associative array
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description"
        content="View detailed recipes with ingredients, cooking directions, and preparation time. Discover vegetarian and non-vegetarian options, along with recipe images and types.">
    <meta name="keywords"
        content="view recipe, recipe details, ingredients list, cooking directions, preparation time, vegetarian recipes, non-vegetarian recipes, recipe images, recipe types">
    <title>Recipe Details</title>
    <link rel="stylesheet" href="../style.css">
    <script src="../script.js"></script>
</head>

<body>
    <header>
         <!-- Includes the header template for consistency across pages -->
        <?php include 'header.php'; ?>
    </header>

    <main>
        <!-- Wrapper for the recipe details page -->
        <div class="wrapper-container show-page">
            <div class="overlay"></div>
            <div class="container">
                <!-- Box containing the recipe details -->
                <div class="form-box">
                    <!-- Header section for the recipe, including navigation buttons -->
                    <div class="headr-container">
                        <div class="btns-container">
                             <!-- Button to navigate back to the homepage -->
                            <a href="home_page.php" class="back-to-home-btn">Back to Home</a>
                            <div class="card-actions">
                            <!-- Link to the edit page for the current recipe -->
                                <a href="../pages/edit_recipe_page.php?id=<?php echo $result['RecipeID']; ?>"
                                    class="btn btn-edit">Edit</a>
                                <!-- Button to delete the recipe with a confirmation dialog -->
                                <button class="btn btn-delete"
                                    onclick="confirmDelete(<?php echo $result['RecipeID']; ?>)">Delete</button>
                            </div>
                        </div>
                            <!-- Displays the title of the recipe -->
                        <h1 class="recipe-title">Recipe: <?php echo htmlspecialchars($result['Title']); ?></h1>
                    </div>

                    <!-- Displays the recipe image -->
                    <div class="recipe-image">
                        <img id="image-preview" src="<?php echo htmlspecialchars($result['Image']); ?>"
                            alt="Recipe Image">
                    </div>

                    <!-- Displays detailed information about the recipe -->
                    <div class="recipe-details">
                        <h3>Type</h3>
                        <p><?php echo htmlspecialchars($result['Type']); ?></p>

                        <h3>Time to Cook</h3>
                        <p><?php echo htmlspecialchars($result['TimeToCook']); ?></p>

                        <h3>Is Vegetarian</h3>
                        <p><?php echo $result['Vegetarian'] ? "Yes" : "No"; ?></p>

                        <h3>Ingredients</h3>
                        <p><?php echo nl2br(htmlspecialchars($result['Ingredients'])); ?></p>

                        <h3>Directions</h3>
                        <p><?php echo nl2br(htmlspecialchars($result['Directions'])); ?></p>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <footer>
        <!-- Includes the footer template for consistency across pages -->
        <?php include 'footer.php'; ?>
    </footer>
</body>

</html>