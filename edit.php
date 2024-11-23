<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

require_once('database.php');
$db = db_connect();

include 'header.php';

// Check if the RecipeID is provided
if (!isset($_GET['id'])) {
    header("Location: login.php"); // Redirect to index if no ID is provided
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

    // Handle image upload
    $imagePath = $result['Image']; // Default to current image path if no new image is uploaded
    if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
        // Process the uploaded image
        $targetDir = "uploads/"; // Set the target directory
        $targetFile = $targetDir . basename($_FILES['image']['name']);
        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));

        // Check if the file is an actual image
        if (getimagesize($_FILES['image']['tmp_name']) === false) {
            echo "File is not an image.";
            $uploadOk = 0;
        }

        // Check file size (limit to 2MB for example)
        if ($_FILES['image']['size'] > 2000000) {
            echo "Sorry, your file is too large.";
            $uploadOk = 0;
        }

        // Allow certain file formats
        if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif") {
            echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
            $uploadOk = 0;
        }

        // Check if the file was uploaded
        if ($uploadOk == 1 && move_uploaded_file($_FILES['image']['tmp_name'], $targetFile)) {
            $imagePath = $targetFile; // Update image path if upload is successful
        } else {
            echo "Sorry, there was an error uploading your file.";
        }
    }

    // Update the recipe with the new information and image
    $sql = "UPDATE recipes SET 
            Title = '$title', 
            TimeToCook = '$time_to_cook', 
            Vegetarian = $vegetarian, 
            Ingredients = '$ingredients', 
            Directions = '$directions', 
            Type = '$type', 
            Image = '$imagePath' 
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

    <script>
        function previewImage(event) {
            const imagePreview = document.getElementById('image-preview');
            const file = event.target.files[0];
            if (file) {
                imagePreview.src = URL.createObjectURL(file);
                imagePreview.style.display = 'block';
            } else {
                imagePreview.src = 'uploads/placeholder.jpg'; // Reset to placeholder if no file
            }
        }
    </script>
</head>

<body>
    <div class="wrapper-container edit-page">
        <div class="overlay"></div>
        <div class="container">
            <div class="form-box">
                <h1 class="form-title">Edit Recipe</h1>
                <form action="<?php echo 'edit.php?id=' . $result['RecipeID']; ?>" method="post"
                    enctype="multipart/form-data">

                    <h2>Recipe Details</h2>

                    <!-- Image Upload Section -->
                    <div class="form-group">
                        <label class="label" for="image">Recipe Image</label>
                        <input type="file" name="image" id="image" onchange="previewImage(event)">
                        <p>Current Image: <img id="image-preview"
                                src="<?php echo $result['Image'] ? htmlspecialchars($result['Image']) : 'uploads/placeholder.jpg'; ?>"
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
                        <button type="button" class="back-button"
                            onclick="location.href='../recipe-manager/home.php'">Back to Home</button>
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