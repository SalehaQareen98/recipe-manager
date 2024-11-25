<?php
// Start the session to track user authentication and session data
session_start();
// Check if the user is logged in by verifying 'user_id' in the session
if (!isset($_SESSION['user_id'])) {
        // Redirect the user to the login page if not authenticated
    header("Location: login_page.php");
    exit; // Stop further execution to ensure redirection
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description"
        content="Create a new recipe with ease. Add a title, cooking time, ingredients, directions, and recipe type. Upload and preview images, and specify if it's vegetarian.">
    <meta name="keywords"
        content="create recipe, new recipe, recipe creation, upload recipe image, preview recipe, title field, cooking time, vegetarian option, ingredients, directions, recipe type">
    <title>Create New Recipe</title>
    <link rel="stylesheet" href="../style.css">
    <script src="../script.js"></script>

</head>

<body>

    <?php include 'header.php'; ?>

<!-- Main wrapper for the Create Recipe page -->
    <div class="wrapper-container create-page">
        <div class="overlay"></div>
        <div class="container">
            <div class="form-box">
                <h1 class="form-title">Create New Recipe</h1>

                <!-- Form to collect recipe details -->
                <form action="../server/create_recipe.php" method="POST" enctype="multipart/form-data">
                    <!-- Image Upload and Preview -->
                    <div class="form-group">
                        <label class="label" for="recipe_image">Upload Recipe Image</label>
                        <input class="input" type="file" id="recipe_image" name="recipe_image" accept="image/*"
                            onchange="previewImage(event)" />
                        <img id="image-preview" src="../uploads/placeholder.jpg" alt="Image Preview" />
                    </div>

                      <!-- Input field for the recipe title -->                    <div class="form-group">
                        <label class="label" for="title">Recipe Title</label>
                        <input class="input" type="text" id="title" name="title" required />
                    </div>

                   <!-- Input field for the time required to cook the recipe -->
                    <div class="form-group">
                        <label class="label" for="time_to_cook">Time to Cook</label>
                        <input class="input" type="text" id="time_to_cook" name="time_to_cook" required />
                    </div>

                     <!-- Dropdown to specify whether the recipe is vegetarian -->
                    <div class="form-group">
                        <label class="label" for="vegetarian">Is Vegetarian</label>
                        <select class="select" id="vegetarian" name="vegetarian" required>
                            <option value="1">Yes</option>
                            <option value="0">No</option>
                        </select>
                    </div>

                    <!-- Text area for listing the recipe ingredients -->
                    <div class="form-group">
                        <label class="label" for="ingredients">Ingredients</label>
                        <textarea class="textbox" id="ingredients" name="ingredients" rows="5" required></textarea>
                    </div>

                    <!-- Text area for writing the recipe directions -->
                    <div class="form-group">
                        <label class="label" for="directions">Directions</label>
                        <textarea class="textbox" id="directions" name="directions" rows="10" required></textarea>
                    </div>

                         <!-- Dropdown for selecting the type of recipe (e.g., Main Course, Dessert) -->                    <div class="form-group">
                        <label class="label" for="type">Recipe Type</label>
                        <select class="select" id="type" name="type" required>
                            <option value="Appetizer">Appetizer</option>
                            <option value="Main Course">Main Course</option>
                            <option value="Dessert">Dessert</option>
                            <option value="Drinks">Drinks</option>
                        </select>
                    </div>

                     <!-- Buttons for submitting the form or navigating back to the homepage -->
                    <div id="operations">
                        <button class="signup-button" type="submit">Create Recipe</button>
                        <button type="button" class="back-button" onclick="location.href='home_page.php'">Back to
                            Home</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <footer>
        <?php include 'footer.php'; ?>
    </footer>

</body>

</html>