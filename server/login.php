<?php
// Include the database connection file
require_once('../database/database.php');

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
            header("Location: ../pages/home_page.php");
            exit; // Stop further script execution
        } else {
            // Show an alert for an invalid password
            echo "<script>
                    alert('Invalid password. Please try again.');
                    window.location.href = '../pages/login_page.php';
                    </script>";
            exit;
        }
    } else {
        // Show an alert if no user is found with the entered email
        echo "<script>
                alert('No account found with this email. Please sign-up.');
                window.location.href = '../pages/login_page.php';
                </script>";
        exit;
    }
}
?>
