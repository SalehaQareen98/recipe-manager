<?php
session_start();
require_once('database.php');

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

$db = db_connect();

// Check if the recipe ID is set
if (!isset($_GET['id'])) {
    header("Location: login.php");
    exit;
}

$id = $_GET['id'];

// Fetch recipe details
$sql = "SELECT * FROM recipes WHERE RecipeID = $id";
$result_set = mysqli_query($db, $sql);
$result = mysqli_fetch_assoc($result_set);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recipe Details</title>
    <link rel="stylesheet" href="style.css">
    <script>
        async function confirmDelete(recipeID) {
            // Display confirmation dialog
            const userConfirmed = confirm("Are you sure you want to delete this recipe?");
            if (!userConfirmed) return;

            try {
                // Send DELETE request using Fetch API
                const response = await fetch("delete.php", {
                    method: "POST",
                    headers: {
                        "Content-Type": "application/x-www-form-urlencoded",
                    },
                    body: `id=${recipeID}`,
                });

                if (response.ok) {
                    alert("Recipe deleted successfully.");
                    window.location.href = "home.php"; // Redirect after successful deletion
                } else {
                    const errorText = await response.text();
                    alert("Error deleting recipe: " + errorText);
                }
            } catch (error) {
                alert("An error occurred. Please try again.");
                console.error("Error:", error);
            }
        }
    </script>
</head>

<body>
    <header>
        <?php include 'header.php'; ?>
    </header>

    <main>
        <div class="wrapper-container show-page">
            <div class="overlay"></div>
            <div class="container">
                <div class="form-box">
                    <div class="headr-container">
                        <div class="btns-container">
                            <a href="home.php" class="back-to-home-btn">Back to Home</a>
                            <div class="card-actions">
                                <a href="edit.php?id=<?php echo $result['RecipeID']; ?>" class="btn btn-edit">Edit</a>
                                <!-- Call confirmDelete() on click -->
                                <button class="btn btn-delete" onclick="confirmDelete(<?php echo $result['RecipeID']; ?>)">Delete</button>
                            </div>
                        </div>
                        <h1 class="recipe-title">Recipe: <?php echo htmlspecialchars($result['Title']); ?></h1>
                    </div>

                    <div class="recipe-details">
                        <h3>Type</h3>
                        <p><?php echo htmlspecialchars($result['Type']); ?></p>

                        <h3>Time to Cook</h3>
                        <p><?php echo htmlspecialchars($result['TimeToCook']); ?></p>

                        <h3>Is Vegetarian</h3>
                        <p><?php echo $result['Vegetarian'] ? "Yes" : "No"; ?></p>

                        <h3>Ingredients</h3>
                        <p><?php echo nl2br(htmlspecialchars($result['Ingredients'])); ?></p>

                        <h3>Directions</h3>
                        <p><?php echo nl2br(htmlspecialchars($result['Directions'])); ?></p>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <footer>
        <?php include 'footer.php'; ?>
    </footer>
</body>

</html>
