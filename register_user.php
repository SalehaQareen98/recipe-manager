<?php
require_once('database.php');
$db = db_connect();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Capture form data
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Hash the password for secure storage
    $passwordHash = password_hash($password, PASSWORD_DEFAULT);

    // Insert the user into the database
    $stmt = $db->prepare("INSERT INTO users (Name, Email, PasswordHash) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $name, $email, $passwordHash);

    if ($stmt->execute()) {
        echo "<p>Registration successful! You can now <a href='login.php'>log in</a>.</p>";
    } else {
        if ($db->errno == 1062) {
            echo "<p style='color:red;'>This email is already registered. Please use a different email.</p>";
        } else {
            echo "<p>Error: " . $db->error . "</p>";
        }
    }

    $stmt->close();
    db_disconnect($db);
} else {
    header("Location: register.php");
    exit;
}
?>
