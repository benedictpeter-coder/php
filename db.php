<?php
// ===================================================
// db.php - Connects & Auto-Creates Tables If Missing
// ===================================================

$host     = "localhost";
$user     = "root";
$password = "";
$database = "LagosLibrary";

// 1. Connect to MySQL Server
$conn = mysqli_connect($host, $user, $password);

if (!$conn) {
    die("MySQL Connection Failed: " . mysqli_connect_error());
}

// 2. Create Database if it doesn't exist
$sql_db = "CREATE DATABASE IF NOT EXISTS " . $database;
if (!mysqli_query($conn, $sql_db)) {
    die("Database Creation Error: " . mysqli_error($conn));
}

// 3. Select the database
if (!mysqli_select_db($conn, $database)) {
    die("Database Selection Error: " . mysqli_error($conn));
}

// 4. Create 'members' table if it doesn't exist
$sql_members = "CREATE TABLE IF NOT EXISTS members (
    id INT AUTO_INCREMENT PRIMARY KEY,
    full_name VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL,
    phone VARCHAR(20) NOT NULL,
    membership_type VARCHAR(50) NOT NULL,
    interests VARCHAR(255),
    additional_notes TEXT,
    membership_duration VARCHAR(20) NOT NULL,
    registration_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP
)";
if (!mysqli_query($conn, $sql_members)) {
    die("Members Table Error: " . mysqli_error($conn));
}

// 5. Create 'contacts' table if it doesn't exist
$sql_contacts = "CREATE TABLE IF NOT EXISTS contacts (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL,
    phone VARCHAR(20),
    message TEXT NOT NULL,
    submission_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP
)";
if (!mysqli_query($conn, $sql_contacts)) {
    die("Contacts Table Error: " . mysqli_error($conn));
}

// NOTE: Connection remains open and ready for your processing scripts!
?>