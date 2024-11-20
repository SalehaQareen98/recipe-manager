<?php
require_once('database.php');
$db = db_connect();
if (!$db) {
    die("Database connection failed: " . mysqli_connect_error());
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Capture and sanitize form data
    $name = mysqli_real_escape_string($db, trim($_POST['login']));
    $email = mysqli_real_escape_string($db, trim($_POST['email']));
    $password = trim($_POST['password']);

    // Hash the password and sanitize the hash
    $passwordHash = mysqli_real_escape_string($db, password_hash($password, PASSWORD_DEFAULT));

    // Construct the SQL query
    $sql = "INSERT INTO users (Name, Email, PasswordHash) VALUES ('$name', '$email', '$passwordHash')";

    // Execute the query
    if (mysqli_query($db, $sql)) {
        echo "<p>Registration successful! You can now <a href='index.php'>log in</a>.</p>";
    } else {
        // Handle errors (e.g., duplicate email)
        if (mysqli_errno($db) == 1062) {
            echo "<p style='color:red;'>This email is already registered. Please use a different email.</p>";
        } else {
            echo "<p>Error: " . mysqli_error($db) . "</p>";
        }
    }

    // Close the database connection
    db_disconnect($db);
} else {
    // Redirect if the request method is not POST
    header("Location: registration.html");
    exit;
}
?>
