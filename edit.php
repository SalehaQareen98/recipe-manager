<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: index.php");
    exit;
}

require_once('database.php');
$db = db_connect();

include 'header.php';

// Check if the RecipeID is provided
if (!isset($_GET['id'])) {
    header("Location: index.php"); // Redirect to index if no ID is provided
}

$id = $_GET['id']; // Get the RecipeID from the URL

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Process the form submission

    // Access the recipe information from the form
    $title = $_POST['title'];
    $time_to_cook = $_POST['time_to_cook'];
    $vegetarian = $_POST['vegetarian'];
    $ingredients = $_POST['ingredients'];
    $directions = $_POST['directions'];
    $type = $_POST['type'];

    // Update the recipe with the new information
    $sql = "UPDATE recipes SET 
            Title = '$title', 
            TimeToCook = '$time_to_cook', 
            Vegetarian = $vegetarian, 
            Ingredients = '$ingredients', 
            Directions = '$directions', 
            Type = '$type' 
            WHERE RecipeID = $id";
    $result = mysqli_query($db, $sql);

    // Redirect to the show page
    header("Location: show.php?id=$id");
} else {
    // Display the recipe information in the form
    $sql = "SELECT * FROM recipes WHERE RecipeID = $id";
    $result_set = mysqli_query($db, $sql);
    $result = mysqli_fetch_assoc($result_set); // Fetch the recipe data
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Recipe</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <div class="wrapper-container edit-page">
    <div class="overlay"></div>
        <div class="container">
            <div class="form-box">
                <h1 class="form-title">Edit Recipe</h1>
                <form action="<?php echo 'edit.php?id=' . $result['RecipeID']; ?>" method="post">

                    <h2>Recipe Details</h2>

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