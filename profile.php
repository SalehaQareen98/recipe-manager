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
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f9;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }
        .profile {
            background-color: #fff;
            border: 1px solid #ddd;
            border-radius: 10px;
            padding: 20px;
            width: 300px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            text-align: center;
        }
        .profile h3 {
            margin: 10px 0;
            font-size: 24px;
        }
        .profile p {
            margin: 5px 0;
            color: #555;
        }
        .profile a {
            display: inline-block;
            margin-top: 15px;
            padding: 10px 15px;
            color: #fff;
            background-color: #007BFF;
            text-decoration: none;
            border-radius: 5px;
            transition: background-color 0.3s;
        }
        .profile a:hover {
            background-color: #0056b3;
        }
        .delete-btn {
            background-color: #FF3D00;
        }
        .delete-btn:hover {
            background-color: #D32F2F;
        }
    </style>
</head>
<body>
    <div class="profile">
        <h3><?php echo htmlspecialchars($name); ?></h3>
        <p>Email: <?php echo htmlspecialchars($email); ?></p>
        <a href="home.php?logout=<?php echo $userId; ?>" class="delete-btn">Logout</a>
    </div>
</body>
</html>
