<?php
// Force XAMPP to show errors instead of a blank page or 500 error
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// ====================================================================
// db.php - XAMPP Auto-Connect & Database Config
// ====================================================================

$host     = "127.0.0.1"; // 127.0.0.1 bypasses DNS issues in XAMPP
$user     = "root";      // Default XAMPP username
$password = "";          // Default XAMPP password is empty
$database = "Online bookshop";

// 1. Connect to XAMPP MySQL Server
$conn = mysqli_connect($host, $user, $password);

if (!$conn) {
    die("<b style='color:red;'>XAMPP MySQL Error:</b> Connection refused! Please open your XAMPP Control Panel and click 'Start' next to MySQL.");
}

// 2. Create Database if missing
$sql_db = "CREATE DATABASE IF NOT EXISTS " . $database;
if (!mysqli_query($conn, $sql_db)) {
    die("XAMPP Database Creation Error: " . mysqli_error($conn));
}

// 3. Select the database
if (!mysqli_select_db($conn, $database)) {
    die("XAMPP Database Selection Error: " . mysqli_error($conn));
}

// 4. Create 'contacts' table if missing
$sql_contacts = "CREATE TABLE IF NOT EXISTS contacts (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL,
    phone VARCHAR(20),
    message TEXT NOT NULL,
    submission_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP
)";
if (!mysqli_query($conn, $sql_contacts)) {
    die("XAMPP Table Error: " . mysqli_error($conn));
}

// Success message for confirmation
echo "<h3 style='color:green;'>✓ Success! XAMPP connected to MySQL flawlessly.</h3>";
echo "<p>Database '<b>$database</b>' and '<b>contacts</b>' table are ready to go!</p>";
?>
