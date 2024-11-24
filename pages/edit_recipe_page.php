<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login_page.php");
    exit;
}

require_once('../database/database.php');
$db = db_connect();

// Check if the RecipeID is provided
if (!isset($_GET['id'])) {
    header("Location: login_page.php"); // Redirect to login if no ID is provided
    exit;
}

$id = $_GET['id']; // Get the RecipeID from the URL

// Fetch current recipe data
$sql = "SELECT * FROM recipes WHERE RecipeID = $id";
$result_set = mysqli_query($db, $sql);
$result = mysqli_fetch_assoc($result_set); // Fetch the recipe data
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Recipe</title>
    <link rel="stylesheet" href="../style.css">
    <script src="../script.js"></script>
</head>

<body>
    <header>
        <?php include 'header.php'; ?>
    </header>
    <div class="wrapper-container edit-page">
        <div class="overlay"></div>
        <div class="container">
            <div class="form-box">
                <h1 class="form-title">Edit Recipe</h1>
                <form action="../server/edit_recipe.php?id=<?php echo $result['RecipeID']; ?>" method="post"
                    enctype="multipart/form-data">

                    <!-- Image Upload Section -->
                    <div class="form-group">
                        <label class="label" for="image">Recipe Image</label>
                        <input type="file" name="image" id="image" onchange="previewImage(event)">
                        <p>Current Image: <img id="image-preview"
                                src="<?php echo $result['Image'] ? htmlspecialchars($result['Image']) : '../uploads/placeholder.jpg'; ?>"
                                alt="Current Recipe Image"></p>
                    </div>

                    <div class="form-group">
                        <label class="label" for="title">Title</label>
                        <input class="input" type="text" id="title" name="title" value="<?php echo $result['Title']; ?>"
                            required />
                    </div>

                    <div class="form-group">
                        <label class="label" for="time_to_cook">Time to Cook</label>
                        <input class="input" type="text" id="time_to_cook" name="time_to_cook"
                            value="<?php echo $result['TimeToCook']; ?>" required />
                    </div>

                    <div class="form-group">
                        <label class="label" for="vegetarian">Is Vegetarian</label>
                        <select class="select" id="vegetarian" name="vegetarian" required>
                            <option value="1" <?php echo $result['Vegetarian'] == 1 ? 'selected' : ''; ?>>Yes</option>
                            <option value="0" <?php echo $result['Vegetarian'] == 0 ? 'selected' : ''; ?>>No</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label class="label" for="ingredients">Ingredients</label>
                        <textarea class="textbox" id="ingredients" name="ingredients" rows="5"
                            required><?php echo $result['Ingredients']; ?></textarea>
                    </div>

                    <div class="form-group">
                        <label class="label" for="directions">Directions</label>
                        <textarea class="textbox" id="directions" name="directions" rows="10"
                            required><?php echo $result['Directions']; ?></textarea>
                    </div>

                    <div class="form-group">
                        <label class="label" for="type">Type</label>
                        <select class="select" id="type" name="type" required>
                            <option value="Appetizer" <?php echo $result['Type'] == 'Appetizer' ? 'selected' : ''; ?>>
                                Appetizer</option>
                            <option value="Main Course" <?php echo $result['Type'] == 'Main Course' ? 'selected' : ''; ?>>
                                Main Course</option>
                            <option value="Dessert" <?php echo $result['Type'] == 'Dessert' ? 'selected' : ''; ?>>Dessert
                            </option>
                            <option value="Drinks" <?php echo $result['Type'] == 'Drinks' ? 'selected' : ''; ?>>Drinks
                            </option>
                        </select>
                    </div>

                    <div id="operations">
                        <button class="signup-button" type="submit">Save Changes</button>
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