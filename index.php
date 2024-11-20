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
    <title>Login</title>
</head>
<body>
    <h1>Login</h1>

    <!-- Display error messages dynamically if they are set -->
    <?php if (isset($error_message)): ?>
        <p style="color: red;"><?php echo $error_message; ?></p>
    <?php endif; ?>

    <!-- Login form for user authentication -->
    <form method="POST" action="index.php">
        <!-- Email input field -->
        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required><br><br>

        <!-- Password input field -->
        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required><br><br>

        <!-- Submit button to log in -->
        <button type="submit">Login</button>
    </form>
    <button onclick="window.location.href='registration.html';">Sign-Up</button>

</body>
</html>
