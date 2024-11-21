<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bon Appétit</title>
    <link rel="stylesheet" href="style.css"> <!-- Link to your CSS file -->
</head>
<body>
    <header class="main-header">
        <div class="title">
            <a href="home.php" class="home-link">Home</a> <!-- Home link -->
            <h1>Bon Appétit</h1>
        </div>

        <form class="search-bar" action="search.php" method="POST">
            <input type="text" id="keyword" name="keyword" placeholder="Search recipes..." required>
            <button type="submit">Search</button>
        </form>

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

        <div class="user-profile">
            <a href="profile.php">                  <!-- create profile/dashboard.php -->
                <img src="profile-icon.png" alt="User Profile" class="profile-icon">
            </a>
        </div>
    </header>
</body>
</html>
