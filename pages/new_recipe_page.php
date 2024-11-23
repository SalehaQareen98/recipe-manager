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
    <title>Create New Recipe</title>
    <link rel="stylesheet" href="../style.css">
    <script>
        function previewImage(event) {
            const imagePreview = document.getElementById('image-preview');
            const file = event.target.files[0];
            if (file) {
                imagePreview.src = URL.createObjectURL(file);
                imagePreview.style.display = 'block';
            } else {
                imagePreview.src = '../uploads/placeholder.jpg'; // Reset to placeholder if no file
            }
        }
    </script>
    
</head>

<body>

    <?php include 'header.php'; ?>

    <div class="wrapper-container create-page">
        <div class="overlay"></div>
        <div class="container">
            <div class="form-box">
                <h1 class="form-title">Create New Recipe</h1>

                <form action="../server/create_recipe.php" method="POST" enctype="multipart/form-data">
                    <!-- Image Upload and Preview -->
                    <div class="form-group">
                        <label class="label" for="recipe_image">Upload Recipe Image</label>
                        <input class="input" type="file" id="recipe_image" name="recipe_image" accept="image/*" onchange="previewImage(event)" />
                        <img id="image-preview" src="../uploads/placeholder.jpg" alt="Image Preview" />
                    </div>

                    <!-- Title Field -->
                    <div class="form-group">
                        <label class="label" for="title">Recipe Title</label>
                        <input class="input" type="text" id="title" name="title" required />
                    </div>

                    <!-- Time to Cook -->
                    <div class="form-group">
                        <label class="label" for="time_to_cook">Time to Cook</label>
                        <input class="input" type="text" id="time_to_cook" name="time_to_cook" required />
                    </div>

                    <!-- Vegetarian Option -->
                    <div class="form-group">
                        <label class="label" for="vegetarian">Is Vegetarian</label>
                        <select class="select" id="vegetarian" name="vegetarian" required>
                            <option value="1">Yes</option>
                            <option value="0">No</option>
                        </select>
                    </div>

                    <!-- Ingredients -->
                    <div class="form-group">
                        <label class="label" for="ingredients">Ingredients</label>
                        <textarea class="textbox" id="ingredients" name="ingredients" rows="5" required></textarea>
                    </div>

                    <!-- Directions -->
                    <div class="form-group">
                        <label class="label" for="directions">Directions</label>
                        <textarea class="textbox" id="directions" name="directions" rows="10" required></textarea>
                    </div>

                    <!-- Recipe Type -->
                    <div class="form-group">
                        <label class="label" for="type">Recipe Type</label>
                        <select class="select" id="type" name="type" required>
                            <option value="Appetizer">Appetizer</option>
                            <option value="Main Course">Main Course</option>
                            <option value="Dessert">Dessert</option>
                            <option value="Drinks">Drinks</option>
                        </select>
                    </div>

                    <!-- Buttons -->
                    <div id="operations">
                        <button class="signup-button" type="submit">Create Recipe</button>
                        <button type="button" class="back-button" onclick="location.href='home_page.php'">Back to Home</button>
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
