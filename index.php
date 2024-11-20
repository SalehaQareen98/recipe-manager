<!-- landing page -->
<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="stylesheet" href="style.css" />
    <title>Online Recipe Manager</title>
    <a href="login.php">Login</a> | <a href="register.php">Create an Account</a>

</head>

<body>
    <!-- Include the header -->
    <?php include("header.php");
    // Connect to the database
    require_once('database.php');

    $db = db_connect(); // Database connection
    
    // Query to fetch recipes
    $sql = "SELECT * FROM recipes ";
    $sql .= "ORDER BY TimeToCook ASC"; // Sort recipes by cooking time
    $result_set = mysqli_query($db, $sql); // Execute the query
    ?>

    <div id="content">
        <div class="subjects listing">
            <h1>Recipes</h1>

            <div class="actions">
                <a class="action" href="new.php">Create New Recipe</a>
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
                        <td><a class="action" href="<?php echo "show.php?id=" . $recipe['RecipeID']; ?>">View</a></td>
                        <td><a class="action" href="<?php echo "edit.php?id=" . $recipe['RecipeID']; ?>">Edit</a></td>
                        <td><a class="action" href="<?php echo "delete.php?id=" . $recipe['RecipeID']; ?>">Delete</a></td>
                    </tr>
                <?php } ?>
            </table>
            

            <!-- Include the footer -->
            <?php include("footer.php"); ?>

</body>

</html>