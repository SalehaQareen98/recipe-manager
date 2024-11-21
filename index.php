<?php
// Include the database connection file
require_once('database.php');

// Start a session to manage user authentication
session_start();
// Check if the request method is POST (form submission)
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $db = db_connect(); // Database connection
    // Retrieve user-submitted email and password from the login form
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Sanitize the email input to prevent SQL injection
    $email = mysqli_real_escape_string($db, $email);

    // Query to find the user in the database by email
    $sql = "SELECT * FROM users WHERE Email = '$email'";
    $result = mysqli_query($db, $sql);
    // Check if a matching user record exists
    if ($result && mysqli_num_rows($result) > 0) {
        
        // Fetch the user record as an associative array
        $user = mysqli_fetch_assoc($result);


        // Verify the hashed password stored in the database with the user-entered password
        if (password_verify($password, $user['PasswordHash'])) {
            // Store user data in the session for authentication
            $_SESSION['user_id'] = $user['UserID']; // Store UserID
            $_SESSION['name'] = $user['Name'];     // Store user's name

            // Redirect to home after successful login
            header("Location: home.php");
            exit; // Stop further script execution
        } else {
            // Set an error message for invalid password
            $error_message = "Invalid password. Please try again.";
        }
    } else {
        // Set an error message if no user is found with the entered email
        $error_message = "No account found with this email. Please register.";
        header("location: registration.html");
    }
}
else {
    echo "<script>console.log('Inside else' );</script>";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css" />
    <title>Login</title>
</head>
<body>
    <div class="wrapper-container login-page" >
        <div class="container">
            <div class="form-box">
                <h1 class="form-title">Login</h1>

                <!-- Display error messages dynamically if they are set -->
                <?php if (isset($error_message)): ?>
                    <p class="error"><?php echo $error_message; ?></p>
                <?php endif; ?>

                <!-- Login form for user authentication -->
                <form method="POST" action="index.php">
                    <!-- Email input field -->
                    <div class="form-group">
                        <label class="label" for="email">Email:</label>
                        <input class="input" type="email" id="email" name="email" required placeholder="Enter your email">
                    </div>
                    <!-- Password input field -->
                    <div class="form-group">
                        <label class="label" for="password">Password:</label>
                        <input class="input" type="password" id="password" name="password" required placeholder="Enter your password">
                    </div>
                    <!-- Submit button to log in -->
                    <button class="login-button" type="submit">Login</button>
                    
                    <!-- Sign-up redirect -->
                    <button class="signup-button" type="button" onclick="window.location.href='registration.html';">Sign Up</button>
                </form>
            </div>
        </div>
    </div>
    
</body>
</html>
