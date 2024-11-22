<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: index.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create New Recipe</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

    <?php include 'header.php'; ?>

    <div class="wrapper-container create-page">
        <div class="container">
            <div class="form-box">
                <h1 class="form-title">Create New Recipe</h1>

                <form action="create.php" method="POST">

                    <h2>Recipe Details</h2>

                    <div class="form-group">
                        <label class="label" for="title">Recipe Title</label>
                        <input class="input" type="text" id="title" name="title" required />
                    </div>

                    <div class="form-group">
                        <label class="label" for="time_to_cook">Time to Cook</label>
                        <input class="input" type="text" id="time_to_cook" name="time_to_cook" required />
                    </div>

                    <div class="form-group">
                        <label class="label" for="vegetarian">Is Vegetarian</label>
                        <select class="select" id="vegetarian" name="vegetarian" required>
                            <option value="1">Yes</option>
                            <option value="0">No</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label class="label" for="ingredients">Ingredients</label>
                        <textarea class="textbox" id="ingredients" name="ingredients" rows="5" required></textarea>
                    </div>

                    <div class="form-group">
                        <label class="label" for="directions">Directions</label>
                        <textarea class="textbox" id="directions" name="directions" rows="10" required></textarea>
                    </div>

                    <div class="form-group">
                        <label class="label" for="type">Recipe Type</label>
                        <select class="select" id="type" name="type" required>
                            <option value="Appetizer">Appetizer</option>
                            <option value="Main Course">Main Course</option>
                            <option value="Dessert">Dessert</option>
                            <option value="Drinks">Drinks</option>
                        </select>
                    </div>

                    <div id="operations">
                        <button class="signup-button" type="submit">Create Recipe</button>
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
