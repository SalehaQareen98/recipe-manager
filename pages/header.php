<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Website header featuring the company logo, home navigation link, and logout option for user convenience.">
    <meta name="keywords" content="header, logo, home navigation, logout, user interface, website navigation">
    <title>Bon Appétit</title>
    <link rel="stylesheet" href="../style.css"> <!-- Link to your CSS file -->
</head>

<body>
    <header class="main-header">
        <!-- Container for the logo and title -->
        <div class="title-container">
            <!-- Section for the company logo -->
            <div class="logo-image">
            <!-- Displays the company logo with an alt text describing its appearance -->
                <img src="../images/logo.jpg" alt="Company Name Logo Looks Like a Flame">
            </div>
            <h1 class="header-title">Bon Appétit</h1>
        </div>
        <!-- Container for navigation links -->
        <div class="header-container">
            <div class="title">
                <a href="home_page.php" class="nav-link">Home</a> <!-- Home link -->
            </div>
         <!-- Navigation link to log the user out -->
            <div class="Logout">
                <a href="../server/logout.php" class="nav-link">Logout</a>
            </div>
        </div>
    </header>
</body>

</html>