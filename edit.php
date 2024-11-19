<?php
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

<div id="content">
    <a class="back-link" href="index.php">Back to List</a>

    <div class="page edit">
        <h1>Edit Recipe</h1>

        <form action="<?php echo 'edit.php?id=' . $result['RecipeID']; ?>" method="post">
            <dl>
                <dt>Title</dt>
                <dd><input type="text" name="title" value="<?php echo $result['Title']; ?>" required /></dd>
            </dl>
            <dl>
                <dt>Time to Cook</dt>
                <dd><input type="text" name="time_to_cook" value="<?php echo $result['TimeToCook']; ?>" required /></dd>
            </dl>
            <dl>
                <dt>Is Vegetarian</dt>
                <dd>
                    <select name="vegetarian" required>
                        <option value="1" <?php echo $result['Vegetarian'] == 1 ? 'selected' : ''; ?>>Yes</option>
                        <option value="0" <?php echo $result['Vegetarian'] == 0 ? 'selected' : ''; ?>>No</option>
                    </select>
                </dd>
            </dl>
            <dl>
                <dt>Ingredients</dt>
                <dd><textarea name="ingredients" rows="5" required><?php echo $result['Ingredients']; ?></textarea></dd>
            </dl>
            <dl>
                <dt>Directions</dt>
                <dd><textarea name="directions" rows="10" required><?php echo $result['Directions']; ?></textarea></dd>
            </dl>
            <dl>
                <dt>Type</dt>
                <dd>
                    <select name="type" required>
                        <option value="Appetizer" <?php echo $result['Type'] == 'Appetizer' ? 'selected' : ''; ?>>
                            Appetizer</option>
                        <option value="Main Course" <?php echo $result['Type'] == 'Main Course' ? 'selected' : ''; ?>>Main
                            Course</option>
                        <option value="Dessert" <?php echo $result['Type'] == 'Dessert' ? 'selected' : ''; ?>>Dessert
                        </option>
                        <option value="Drinks" <?php echo $result['Type'] == 'Drinks' ? 'selected' : ''; ?>>Drinks
                        </option>
                    </select>
                </dd>
            </dl>

            <div id="operations">
                <input type="submit" value="Edit Recipe" />
            </div>
        </form>
    </div>
</div>



<?php include 'footer.php'; ?>