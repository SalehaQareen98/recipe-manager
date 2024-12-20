<?php
// Start the session to maintain user state and track login status
session_start();
// Check if the user is logged in by verifying the 'user_id' session variable
if (!isset($_SESSION['user_id'])) {
        // Redirect to the login page if the user is not authenticated
    header("Location: login_page.php");
    exit; // Stop further execution of the script
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="keywords"
        content="recipe manager, online recipes, dietary preferences, meal planning, cooking, user-friendly, culinary, favorite dishes, recipe search, recipe organization">
    <meta name="description"
        content="Discover and manage a vast collection of recipes tailored to your dietary preferences. 
        Our platform offers user-friendly features for adding, searching, and organizing your favorite dishes. Join now to enhance your culinary journey.">
    <title>Recipe Manager</title>
    <link rel="stylesheet" href="../home_page_styles.css">
    <script src="../script.js"></script>
</head>

<body>
    <div class="content">
        <header class="header">
            <?php include("header.php"); ?>
        </header>

       <!-- Main container holding the title image, search/filter functionality, and recipe listings -->
        <div class="main-container">
             <!-- Section containing the title image and welcome text -->
            <div class="title-image-container">
                <!-- Displays a background image with a descriptive alt text -->
                <img src="../images/title-img.jpg"
                    alt="Two grilled steaks garnished with fresh rosemary served on a rustic stone plate, accompanied by a bowl of seasoning, olive oil, garlic cloves, and cherry tomatoes on a dark textured background."
                    class="title-img">
                <div class="overlay"></div>
                <div class="title-text">
                    <h1 class="image-title">Welcome to Recipe Manager</h1>
                    <p class="img-desc">Explore delicious recipes</p>
                </div>
            </div>

            <div class="search-filter-section">
                <!-- Search form with onSubmit attribute -->
                <form id="search-form" class="search-bar" action="../server/search_recipes.php" method="POST"
                    onsubmit="handleSearchFormSubmit(event)">
                    <input type="text" id="keyword" name="keyword" placeholder="Search recipes..." required>
                    <div class="button-wrapper">
                        <button type="submit" class="orange-button">Search</button>
                        <button type="button" class="green-button" onclick="resetSearchForm()">Reset</button>

                    </div>
                </form>
                <!-- Button to add a new recipe -->
                <div class="center-button">
                    <button class="add-recipe-button" onclick="window.location.href='new_recipe_page.php'">Add
                        Recipe</button>
                </div>

                <!-- Filter form with onSubmit attribute -->
                <form id="filter-form" class="filter-dropdown" action="../server/filter_recipes.php" method="GET"
                    onsubmit="handleFilterFormSubmit(event)">
                     <!-- Dropdown for selecting filters such as vegetarian and cooking time -->
                    <select id="filter" name="filter">
                        <option value="">Filter Recipes</option>
                        <option value="Vegetarian">Vegetarian</option>
                        <option value="Non-Vegetarian">Non-Vegetarian</option>
                        <option value="15">Max Time: 15 minutes</option>
                        <option value="30">Max Time: 30 minutes</option>
                        <option value="60">Max Time: 1 hour</option>
                    </select>
                    <!-- Buttons for applying or resetting filters -->
                    <div class="button-wrapper">
                        <button type="submit" class="orange-button">Apply</button>
                        <button type="button" class="green-button" onclick="resetFilterForm()">Reset</button>
                    </div>
                </form>
            </div>
           <!-- Section displaying the user's recipes -->
            <div class="sub-heading">
                <h1>My Recipes</h1>
            </div>

            <div class="recipes-listing">
                <div class="recipe-cards-container">
                    <?php
                    require_once('../database/database.php');
                    $db = db_connect();
                    $user_id = $_SESSION['user_id'];
                    // Query to fetch recipes created by the user, sorted by cooking time
                    $sql = "SELECT * FROM recipes WHERE UserID = '$user_id' ORDER BY TimeToCook ASC";
                    // Execute the query and store the result
                    $result_set = mysqli_query($db, $sql);
                    
                    // Loop through each recipe in the result set and display it
                    while ($recipe = mysqli_fetch_assoc($result_set)) { ?>
                        <div class="recipe-card"
                            onclick="window.location.href='view_recipe.php?id=<?php echo $recipe['RecipeID']; ?>'">
                            <!-- Displays the recipe image -->
                            <div class="recipe-image">
                                <img src="<?php echo htmlspecialchars($recipe['Image']); ?>" alt="Recipe Image">
                            </div>
                            <h2 class="recipe-title"><?php echo htmlspecialchars($recipe['Title']); ?></h2>
                        </div>
                    <?php }
                    
                    // Free the result set and close the database connection
                    mysqli_free_result($result_set);
                    db_disconnect($db);
                    ?>
                </div>
            </div>
        </div>

        <footer class="footer">
            <?php include("footer.php"); ?>
        </footer>
    </div>
</body>

</html>