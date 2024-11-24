<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../style.css" />
    <title>Login</title>
</head>

<body>
    <header class="main-header">
        <div class="title-container">
            <div class="logo-image">
                <img src="../images/logo.jpg" alt="Recipe Image">
            </div>
            <h1 class="header-title">Bon Appétit</h1>
        </div>
        <div class="header-container">
            <div class="user-profile">
                <a href="registration_page.html" class="nav-link">Sign Up</a>
            </div>
        </div>
    </header>
    <div class="wrapper-container login-page">
        <div class="overlay"></div>
        <div class="container">
            <div class="form-box">
                <h1 class="form-title">Login</h1>

                <!-- Display error messages dynamically if they are set -->
                <?php if (isset($error_message)): ?>
                    <p class="error"><?php echo $error_message; ?></p>
                <?php endif; ?>

                <!-- Login form for user authentication -->
                <form method="POST" action="../server/login.php">
                    <!-- Email input field -->
                    <div class="form-group">
                        <label class="label" for="email">Email:</label>
                        <input class="input" type="email" id="email" name="email" required
                            placeholder="Enter your email">
                    </div>
                    <!-- Password input field -->
                    <div class="form-group">
                        <label class="label" for="password">Password:</label>
                        <input class="input" type="password" id="password" name="password" required
                            placeholder="Enter your password">
                    </div>
                    <!-- Submit button to log in -->
                    <button class="login-button" type="submit">Login</button>

                    <!-- Sign-up redirect -->
                    <button class="signup-button" type="button"
                        onclick="window.location.href='registration_page.html';">Sign
                        Up</button>
                </form>
            </div>
        </div>
    </div>
    <footer>
        <?php include 'footer.php'; ?>
    </footer>

</body>

</html>