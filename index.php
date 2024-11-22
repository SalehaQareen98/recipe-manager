<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bon Appétit</title>
    <link rel="stylesheet" href="style.css">
</head>

<header class="main-header">
        <div class="title-container">
            <div class="logo-image">
                <img src="images/logo.jpg" alt="Recipe Image">
            </div>
            <h1 class="header-title">Bon Appétit</h1>
        </div>
        <div class="header-container">
            <div class="title">
                <a href="login.php" class="nav-link">Login</a>
            </div>
    
            <div class="user-profile">
                <a href="registration.html" class="nav-link">Sign Up</a>
            </div>

        </div>   
    </header>

<div class="overview-container">
    <div class="img-section">
        <img src="images/overview-img.jpg" alt="Recipe Manager" class="overview-image">
        <h2 class="img-title">Welcome to Recipe Manager!</h2>
        <p class="img-description">
            Recipe Manager is your personalized digital cookbook, where you can create, organize, and store your favorite recipes. 
            Whether you're a home cook, a professional chef, or a food enthusiast, our platform simplifies and elevates your culinary experience.
        </p>
    </div>

    <div class="features-section">
        <h3>Why Choose Recipe Manager?</h3>
        <ul class="features-list">
            <li><strong>Create Recipes:</strong> Craft your own culinary masterpieces with an easy-to-use recipe editor.</li>
            <li><strong>Organize by Category:</strong> Categorize recipes by type, cuisine, or occasion.</li>
            <li><strong>Access Anytime:</strong> Store recipes securely and access them anywhere, on any device.</li>
            <li><strong>Explore Recipes:</strong> Browse and explore community recipes for inspiration.</li>
        </ul>
    </div>

    <div class="recipe-overview-section">
        <h3>Explore the Recipe Page</h3>
        <p>
            On the recipe page, you can view detailed information about your favorite recipes, including ingredients, cooking time, 
            and step-by-step directions. Each recipe page also allows you to edit or delete your recipes as needed, making it the perfect 
            tool for refining your culinary creations.
        </p>
        <p>
            Discover recipes shared by others or keep your personal collection private—it's entirely up to you!
        </p>
    </div>

    <div class="cta-section">
        <h3>Get Started Today!</h3>
        <p>Sign up now to create your account or log in to access your personalized recipe collection.</p>
        <div class="cta-buttons">
            <a href="registration.html" class="btn btn-signup">Sign Up</a>
            <a href="login.php" class="btn btn-login">Login</a>
        </div>
    </div>
</div>

<?php include 'footer.php'; ?>