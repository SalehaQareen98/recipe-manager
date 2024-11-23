<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login_page.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recipe Manager</title>
    <link rel="stylesheet" href="../home_page_styles.css">
    <script src="../script.js"></script>
</head>

<body>
    <div class="content">
        <header class="header">
            <?php include("header.php"); ?>
        </header>

        <div class="main-container">
            <div class="title-image-container">
                <img src="../images/title-img.jpg" alt="Recipe Image" class="title-img">
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

                <div class="center-button">
                    <button class="add-recipe-button" onclick="window.location.href='new_recipe_page.php'">Add
                        Recipe</button>
                </div>

                <!-- Filter form with onSubmit attribute -->
                <form id="filter-form" class="filter-dropdown" action="../server/filter_recipes.php" method="GET"
                    onsubmit="handleFilterFormSubmit(event)">
                    <select id="filter" name="filter">
                        <option value="">Filter Recipes</option>
                        <option value="Vegetarian">Vegetarian</option>
                        <option value="Non-Vegetarian">Non-Vegetarian</option>
                        <option value="15">Max Time: 15 minutes</option>
                        <option value="30">Max Time: 30 minutes</option>
                        <option value="60">Max Time: 1 hour</option>
                    </select>
                    <div class="button-wrapper">
                        <button type="submit" class="orange-button">Apply</button>
                        <button type="button" class="green-button" onclick="resetFilterForm()">Reset</button>
                    </div>
                </form>
            </div>

            <div class="sub-heading">
                <h1>My Recipes</h1>
            </div>

            <div class="recipes-listing">
                <div class="recipe-cards-container">
                    <?php
                    require_once('../database/database.php');
                    $db = db_connect();
                    $user_id = $_SESSION['user_id'];
                    $sql = "SELECT * FROM recipes WHERE UserID = '$user_id' ORDER BY TimeToCook ASC";
                    $result_set = mysqli_query($db, $sql);

                    while ($recipe = mysqli_fetch_assoc($result_set)) { ?>
                        <div class="recipe-card"
                            onclick="window.location.href='view_recipe.php?id=<?php echo $recipe['RecipeID']; ?>'">
                            <div class="recipe-image">
                                <img src="<?php echo htmlspecialchars($recipe['Image']); ?>" alt="Recipe Image">
                            </div>
                            <h2 class="recipe-title"><?php echo htmlspecialchars($recipe['Title']); ?></h2>
                        </div>
                    <?php }

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