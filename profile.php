<?php
// Start session
session_start();

// Include database connection
require_once('database.php');

// Establish database connection
$conn = db_connect();

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

// Get user ID from session
$userId = (int) $_SESSION['user_id'];

// Fetch the user's profile data
$sql = "SELECT Name, Email FROM users WHERE UserID = '$userId'";
$result = mysqli_query($conn, $sql) or die("Query failed: " . mysqli_error($conn));

if (mysqli_num_rows($result) > 0) {
    $user = mysqli_fetch_assoc($result);
    $name = $user['Name'];
    $email = $user['Email'];
} else {
    $name = "Unknown User";
    $email = "No Email Found";
}

// Close the database connection
db_disconnect($conn);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile Card</title>
    
</head>
<body>
    <div class="profile">
        <h3><?php echo htmlspecialchars($name); ?></h3>
        <p>Email: <?php echo htmlspecialchars($email); ?></p>
        <a href="home.php?logout=<?php echo $userId; ?>" class="delete-btn">Logout</a>
    </div>
</body>
</html>
