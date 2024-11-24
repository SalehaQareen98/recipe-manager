<?php
session_start();
require_once('../database/database.php');

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: login_page.php");
    exit;
}

$db = db_connect();

// Check if the recipe ID is set
if (!isset($_GET['id'])) {
    header("Location: login_page.php");
    exit;
}

$id = $_GET['id'];

// Fetch recipe details
$sql = "SELECT * FROM recipes WHERE RecipeID = $id";
$result_set = mysqli_query($db, $sql);
$result = mysqli_fetch_assoc($result_set);
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
        <?php include 'header.php'; ?>
    </header>

    <main>
        <div class="wrapper-container show-page">
            <div class="overlay"></div>
            <div class="container">
                <div class="form-box">
                    <div class="headr-container">
                        <div class="btns-container">
                            <a href="home_page.php" class="back-to-home-btn">Back to Home</a>
                            <div class="card-actions">
                                <a href="../pages/edit_recipe_page.php?id=<?php echo $result['RecipeID']; ?>"
                                    class="btn btn-edit">Edit</a>
                                <button class="btn btn-delete"
                                    onclick="confirmDelete(<?php echo $result['RecipeID']; ?>)">Delete</button>
                            </div>
                        </div>
                        <h1 class="recipe-title">Recipe: <?php echo htmlspecialchars($result['Title']); ?></h1>
                    </div>

                    <!-- Recipe Image -->
                    <div class="recipe-image">
                        <img id="image-preview" src="<?php echo htmlspecialchars($result['Image']); ?>"
                            alt="Recipe Image">
                    </div>


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
        <?php include 'footer.php'; ?>
    </footer>
</body>

</html>