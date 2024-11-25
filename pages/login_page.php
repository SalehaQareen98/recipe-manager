<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description"
        content="Login or sign up to access your personalized dashboard and manage your account securely. Enjoy a simple and fast registration and login process with enhanced security.">
    <meta name="keywords"
        content="login, sign up, register, secure login, account access, user registration, personalized dashboard, secure account management, sign in">
    <link rel="stylesheet" href="../style.css" />
    <title>Login</title>
</head>

<body>
    <header class="main-header">
        <!-- Container for the website logo and title -->
        <div class="title-container">
            <div class="logo-image">
        <!-- Displays the website logo with alt text for accessibility -->
                <img src="../images/logo.jpg" alt="Company Name Logo Looks Like a Flame">
            </div>
            <h1 class="header-title">Bon Appétit</h1>
        </div>
        <!-- Container for navigation links -->
        <div class="header-container">
            <div class="user-profile">
            <!-- Link to the registration page for users to sign up -->
                <a href="registration_page.html" class="nav-link">Sign Up</a>
            </div>
        </div>
    </header>
    <div class="wrapper-container login-page">
        <div class="overlay"></div>
        <div class="container">
            <!-- Box containing the login form -->
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