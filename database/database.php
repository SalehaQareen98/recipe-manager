<?php
require_once('database/db_credentials.php'); // Include database credentials

// Function to connect to the database
function db_connect() {
    // Use mysqli to establish a connection
    $connection = mysqli_connect(DB_SERVER, DB_USER, DB_PASS, DB_NAME);
    
    // Check if connection was successful
    if (mysqli_connect_errno()) {
        $msg = "Database connection failed: ";
        $msg .= mysqli_connect_error();  // Get the error message
        $msg .= " (" . mysqli_connect_errno() . ")"; // Get the error number
        exit($msg); // Terminate the script and display the error
    }
    
    return $connection; // Return the database connection
}

// Function to disconnect from the database
function db_disconnect($connection) {
    if (isset($connection)) { // Check if the connection is active
        mysqli_close($connection); // Close the connection
    }
}
?>
