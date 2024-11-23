<?php
require_once('../database/database.php');

try {
    $db = db_connect();
    if (!$db) {
        die("Database connection failed: " . mysqli_connect_error());
    }

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        // Capture and sanitize form data
        $name = mysqli_real_escape_string($db, trim($_POST['login']));
        $email = mysqli_real_escape_string($db, trim($_POST['email']));
        $password = trim($_POST['password']);

        // Hash the password
        $passwordHash = mysqli_real_escape_string($db, password_hash($password, PASSWORD_DEFAULT));

        // Construct the SQL query
        $sql = "INSERT INTO users (Name, Email, PasswordHash) VALUES ('$name', '$email', '$passwordHash')";

        // Execute the query
        mysqli_query($db, $sql);

        // Redirect to the login page on success
        header("Location: ../pages/login_page.php");
        exit;
    } else {
        // Redirect if the request method is not POST
        header("Location: ../pages/registration_page.html");
        exit;
    }
} catch (mysqli_sql_exception $e) {
    // Handle duplicate entry error
    if ($e->getCode() == 1062) {
        echo "<script>
            alert('$email is already registered. Please use a different email.');
            window.location.href = '../pages/registration_page.html';
        </script>";
    } else {
        // Handle other errors
        echo "<p>Error: " . $e->getMessage() . "</p>";
    }
} finally {
    // Close the database connection
    if (isset($db)) {
        db_disconnect($db);
    }
}
?>
