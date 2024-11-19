<!DOCTYPE html>
<html lang="en">

<head>
  <link rel="stylesheet" href="style.css" />
</head>

<body>

  <?php
  // Connect to the database
  require_once('database.php');
  include "header.php";
  $db = db_connect();

  // Access the URL parameter
  if (!isset($_GET['id'])) { // Check if we get the recipe ID
    header("Location: index.php");
  }
  $id = $_GET['id'];

  // Prepare the query
  $sql = "SELECT * FROM recipes WHERE RecipeID = '$id'";
  $result_set = mysqli_query($db, $sql);
  $result = mysqli_fetch_assoc($result_set);

  ?>

  <!-- Display the recipe data -->
  <div id="content">

    <a class="back-link" href="index.php">Back to List</a>

    <div class="page show">

      <h1>Recipe: <?php echo htmlspecialchars($result['Title']); ?></h1>

      <div class="attributes">
        <dl>
          <dt>Time to Cook</dt>
          <dd><?php echo htmlspecialchars($result['TimeToCook']); ?></dd>
        </dl>
        <dl>
          <dt>Is Vegetarian</dt>
          <dd><?php echo $result['Vegetarian'] ? "Yes" : "No"; ?></dd>
        </dl>
        <dl>
          <dt>Ingredients</dt>
          <dd><?php echo nl2br(htmlspecialchars($result['Ingredients'])); ?></dd>
        </dl>
        <dl>
          <dt>Directions</dt>
          <dd><?php echo nl2br(htmlspecialchars($result['Directions'])); ?></dd>
        </dl>
        <dl>
          <dt>Type</dt>
          <dd><?php echo htmlspecialchars($result['Type']); ?></dd>
        </dl>
        <dl>
          <dt>Added By User ID</dt>
          <dd><?php echo htmlspecialchars($result['UserID']); ?></dd>
        </dl>
      </div>

    </div>

  </div>

  <?php include 'footer.php'; ?>
</body>

</html>
