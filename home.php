<!-- <?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: index.php");
    exit;
}
?> -->
<!-- landing page -->
<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="stylesheet" href="style.css" />
    <title>Online Recipe Manager</title>
    <a href="index.php">Login</a> | <a href="registration.php">Create an Account</a>

</head>

<body>
<div class="seacrh">
            <form class="search-bar" action="search.php" method="POST">
                <input type="text" id="keyword" name="keyword" placeholder="Search recipes..." required>
                <button type="submit">Search</button>
            </form>
        </div>

        <div class="filter-dropdown">
            <form action="filter.php" method="GET">
                <select id="filter" name="filter">
                    <option value="">Filter Recipes</option>
                    <option value="Vegetarian">Vegetarian</option>
                    <option value="Non-Vegetarian">Non-Vegetarian</option>
                    <option value="15">Max Time: 15 minutes</option>
                    <option value="30">Max Time: 30 minutes</option>
                    <option value="60">Max Time: 1 hour</option>
                </select>
                <button type="submit">Apply</button>
            </form>
        </div>
    <!-- Include the header -->
    <?php include("header.php");
    // Connect to the database
    require_once('database.php');

    $db = db_connect(); // Database connection
    $user_id = $_SESSION['user_id'];
    // Query to fetch recipes - VIEW
    $sql = "SELECT * FROM recipes WHERE UserID = '$user_id' ";
    $sql .= "ORDER BY TimeToCook ASC"; // Sort recipes by cooking time
    $result_set = mysqli_query($db, $sql); // Execute the query
    ?>

    <div id="content">
        <div class="subjects listing">
            <h1>Recipes</h1>

            <div class="actions">
                <a class="action" href="new.php">Create New Recipe</a>  <!-- REDIRECTS TO CREATE NEW RECIPE FORM -->
            </div>

            <table class="list">
                <tr>
                    <!-- <th>Recipe ID</th> -->
                    <th>Title</th>
                    <th>Time to Cook</th>
                    <th>Vegetarian</th>
                    <th>Type</th>
                    <th>&nbsp;</th>
                    <th>&nbsp;</th>
                    <th>&nbsp;</th>
                </tr>

                <!-- Process and display results -->
                <?php while ($recipe = mysqli_fetch_assoc($result_set)) { ?>
                    <tr>
                        <!-- <td><?php echo $recipe['RecipeID']; ?></td> -->
                        <td><?php echo $recipe['Title']; ?></td>
                        <td><?php echo $recipe['TimeToCook']; ?></td>
                        <td><?php echo $recipe['Vegetarian'] ? "Yes" : "No"; ?></td>
                        <td><?php echo $recipe['Type']; ?></td>
                        <!-- Send the RecipeID as a parameter -->
                        <td><a class="action" href="<?php echo "show.php?id=" . $recipe['RecipeID']; ?>">View</a></td>   <!-- REDIRECTS TO show.php -->
                        <td><a class="action" href="<?php echo "edit.php?id=" . $recipe['RecipeID']; ?>">Edit</a></td>  <!-- REDIRECTS TO edit.php -->
                        <td><a class="action" href="<?php echo "delete.php?id=" . $recipe['RecipeID']; ?>">Delete</a></td> <!-- REDIRECTS TO delete.php -->
                    </tr>
                <?php } ?>
            </table>
            

            <!-- Include the footer -->
            <?php include("footer.php"); ?>

</body>

</html>