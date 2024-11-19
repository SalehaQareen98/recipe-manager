<!DOCTYPE html>
<html lang="en">
<head>
  <link rel="stylesheet" href="style.css" />
  <title>Create New Recipe</title>
</head>
<body>
  
<?php include 'header.php'; ?>

<div id="content">

  <a class="back-link" href="<?php echo 'index.php'; ?>">Back to List</a>

  <div class="new-recipe">
    <h1>Create New Recipe</h1>

    <form action="create.php" method="POST">
      <dl>
        <dt>Recipe Title</dt>
        <dd><input type="text" name="title" required /></dd>
      </dl>
      <dl>
        <dt>Time to Cook</dt>
        <dd><input type="text" name="time_to_cook" required /></dd>
      </dl>
      <dl>
        <dt>Is Vegetarian</dt>
        <dd>
          <select name="vegetarian" required>
            <option value="1">Yes</option>
            <option value="0">No</option>
          </select>
        </dd>
      </dl>
      <dl>
        <dt>Ingredients</dt>
        <dd><textarea name="ingredients" rows="5" required></textarea></dd>
      </dl>
      <dl>
        <dt>Directions</dt>
        <dd><textarea name="directions" rows="10" required></textarea></dd>
      </dl>
      <dl>
        <dt>Recipe Type</dt>
        <dd>
          <select name="type" required>
            <option value="Appetizer">Appetizer</option>
            <option value="Main Course">Main Course</option>
            <option value="Dessert">Dessert</option>
            <option value="Drinks">Drinks</option>
          </select>
        </dd>
      </dl>
      <div id="operations">
        <input type="submit" value="Create Recipe" />
      </div>
    </form>
  </div>

</div>

<?php include 'footer.php'; 
?>
</body>
</html>
