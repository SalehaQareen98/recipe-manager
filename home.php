<!-- <?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: index.php");
    exit;
}
?> -->
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recipe Manager</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="homestyles.css">
</head>

<body>
    <div class="content">

        <header class="header">
            <?php include("header.php"); ?>
        </header>

        <div class="main-container">
            <div class="title-image-container">
                <img src="images/title-img.jpg" alt="Recipe Image" class="title-img">
                <div class="title-text">
                    <h1>Welcome to Recipe Manager</h1>
                    <p>Explore delicious recipes</p>
                </div>
            </div>

            <div class="search-filter-section">
                <form id="search-form" class="search-bar" action="search.php" method="POST">
                    <input type="text" id="keyword" name="keyword" placeholder="Search recipes..." required>
                    <button type="submit" class="btn btn-primary">Search</button>
                </form>

                <form id="filter-form" class="filter-dropdown" action="filter.php" method="GET">
                    <select id="filter" name="filter">
                        <option value="">Filter Recipes</option>
                        <option value="Vegetarian">Vegetarian</option>
                        <option value="Non-Vegetarian">Non-Vegetarian</option>
                        <option value="15">Max Time: 15 minutes</option>
                        <option value="30">Max Time: 30 minutes</option>
                        <option value="60">Max Time: 1 hour</option>
                    </select>
                    <button type="submit" class="btn btn-secondary">Apply</button>
                </form>
            </div>

            <div class="recipes-listing">
                <!-- <h1 class="section-title">Your Recipes</h1>
                <div class="actions">
                    <a class="btn btn-primary" href="new.php">Create New Recipe</a>
                </div> -->
                <div class="recipe-cards-container">
                    <div class="recipe-card" onclick="window.location.href='new.php'">
                        <div class="recipe-image">
                            <img src="images/add-recipe-img.png" alt="Recipe Image">
                        </div>
                        <h2 class="recipe-title"> Add new Recipe</h2>
                        <!-- <p class="recipe-time">Click card to add a new recipe</p> -->
                    </div>
                    <?php
                    // PHP code to fetch and display recipes dynamically
                    require_once('database.php');
                    $db = db_connect();
                    $user_id = $_SESSION['user_id'];
                    $sql = "SELECT * FROM recipes WHERE UserID = '$user_id' ORDER BY TimeToCook ASC";
                    $result_set = mysqli_query($db, $sql);

                    while ($recipe = mysqli_fetch_assoc($result_set)) { ?>
                        <div class="recipe-card"
                            onclick="window.location.href='show.php?id=<?php echo $recipe['RecipeID']; ?>'">
                            <div class="recipe-image">
                                <img src="images/login-photo.jpg" alt="Recipe Image">
                            </div>
                            <h2 class="recipe-title"><?php echo htmlspecialchars($recipe['Title']); ?></h2>
                            <p class="recipe-time">Time to Cook: <?php echo htmlspecialchars($recipe['TimeToCook']); ?> </p>
                            <p class="recipe-vegetarian"><?php echo $recipe['Vegetarian'] ? "Vegetarian" : "Non-Vegetarian"; ?></p>
                            <p class="recipe-type">Type: <?php echo htmlspecialchars($recipe['Type']); ?></p>
                            <div class="card-actions">
                                <a class="btn btn-small" href="edit.php?id=<?php echo $recipe['RecipeID']; ?>">
                                    <i class="fa-solid fa-pen-to-square"></i> Edit  
                                </a>
                                <a class="btn btn-danger" href="delete.php?id=<?php echo $recipe['RecipeID']; ?>">
                                    <i class="fa-solid fa-trash-can"></i> Delete
                                </a>
                            </div>
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

        <script>
            // Handle the search form submission
            document.getElementById('search-form').addEventListener('submit', function (e) {
                e.preventDefault(); // Prevent the default form submission

                const formData = new FormData(this); // Get form data

                fetch('search.php', {
                    method: 'POST',
                    body: formData,
                })
                    .then(response => response.text())
                    .then(data => {
                        // Update the recipes list dynamically
                        document.querySelector('.recipe-cards-container').innerHTML = data;
                    })
                    .catch(error => console.error('Error:', error));
            });

            // Handle the filter form submission
            document.querySelector('.filter-dropdown').addEventListener('submit', function (e) {
                e.preventDefault(); // Prevent the default form submission

                const formData = new FormData(this); // Get form data

                fetch('filter.php?' + new URLSearchParams(formData), {
                    method: 'GET',
                })
                    .then(response => response.text())
                    .then(data => {
                        // Update the recipes list dynamically
                        document.querySelector('.recipe-cards-container').innerHTML = data;
                    })
                    .catch(error => console.error('Error:', error));
            });
        </script>
    </div>

</body>

</html>