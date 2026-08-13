<?php
require_once "db.php";

$success = false;
$errorMessage = "";
$name = "";

// Check if form was submitted using POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Safely retrieve form inputs with fallback values
    $name    = trim($_POST["name"] ?? '');
    $email   = trim($_POST["email"] ?? '');
    $phone   = trim($_POST["phone"] ?? '');
    $message = trim($_POST["message"] ?? '');

    // Basic validation for required fields
    if (!empty($name) && !empty($email) && !empty($message)) {

        // SQL query with placeholders
        $sql = "INSERT INTO contacts (name, email, phone, message) VALUES (?, ?, ?, ?)";
        $stmt = mysqli_prepare($conn, $sql);

        if ($stmt) {
            // Bind parameters ("ssss" = 4 string variables)
            mysqli_stmt_bind_param($stmt, "ssss", $name, $email, $phone, $message);

            // Execute the query
            if (mysqli_stmt_execute($stmt)) {
                $success = true;
            } else {
                $errorMessage = "Database insertion failed: " . mysqli_stmt_error($stmt);
            }

            mysqli_stmt_close($stmt);
        } else {
            $errorMessage = "Failed to prepare query: " . mysqli_error($conn);
        }

    } else {
        $errorMessage = "Please complete all required fields (Name, Email, and Message).";
    }

} else {
    $errorMessage = "Invalid request method. Please submit the form directly from the contact page.";
}

mysqli_close($conn);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Status - online bookshop</title>
    
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
    
    <link rel="stylesheet" href="style.css">
</head>
<body>

    <h1>Contact our online bookshop</h1>

    <nav>
        <a href="index.html">Home</a> |
        <a href="books.html">Books</a> |
        <a href="gallery.html">Gallery</a> |
        <a href="contact.html">Contact Us</a>
    </nav>

    <hr>

    <main style="text-align: center; padding: 30px 20px;">
        <?php if ($success): ?>
            <h2 style="color: #16a34a;">Message Sent Successfully!</h2>
            <p>Thank you, <strong><?php echo htmlspecialchars($name); ?></strong>.</p>
            <p>We have received your message and will respond to your email as soon as possible.</p>
            <br>
            <p>
                <a href="contact.html">Send Another Message</a> | 
                <a href="index.html">Back to Home Page</a>
            </p>
        <?php else: ?>
            <h2 style="color: #dc2626;">Submission Failed</h2>
            <p><?php echo htmlspecialchars($errorMessage); ?></p>
            <br>
            <p><a href="contact.html">Return to Contact Form</a></p>
        <?php endif; ?>
    </main>

    <footer>
        <p>&copy; 2026 online bookshop. All rights reserved.</p>
    </footer>

</body>
</html>