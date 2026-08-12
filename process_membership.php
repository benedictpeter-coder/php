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
    <title>Contact Status - Lagos Library</title>
    
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
    
    <!-- INTERNAL CSS -->
    <style>
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f4f6f9;
            color: #333333;
            line-height: 1.6;
            padding: 20px;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }

        header {
            text-align: center;
            padding: 20px 0 10px;
        }

        h1 {
            color: #1e293b;
            font-size: 2rem;
            margin-bottom: 10px;
        }

        nav {
            text-align: center;
            margin-bottom: 20px;
        }

        nav a {
            color: #2563eb;
            text-decoration: none;
            font-weight: 500;
            margin: 0 8px;
            transition: color 0.2s ease;
        }

        nav a:hover {
            color: #1d4ed8;
            text-decoration: underline;
        }

        hr {
            border: 0;
            height: 1px;
            background: #cbd5e1;
            margin-bottom: 30px;
        }

        .card {
            background-color: #ffffff;
            max-width: 550px;
            margin: 20px auto;
            padding: 35px 30px;
            border-radius: 10px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.08);
            text-align: center;
        }

        .status-icon {
            font-size: 48px;
            margin-bottom: 15px;
        }

        .success-title {
            color: #16a34a;
            font-size: 1.5rem;
            margin-bottom: 12px;
        }

        .error-title {
            color: #dc2626;
            font-size: 1.5rem;
            margin-bottom: 12px;
        }

        .card p {
            font-size: 1rem;
            color: #475569;
            margin-bottom: 10px;
        }

        .btn-group {
            margin-top: 25px;
        }

        .btn {
            display: inline-block;
            padding: 10px 20px;
            background-color: #2563eb;
            color: #ffffff;
            text-decoration: none;
            border-radius: 6px;
            font-weight: 500;
            transition: background-color 0.2s ease;
            margin: 5px;
        }

        .btn:hover {
            background-color: #1d4ed8;
        }

        .btn-secondary {
            background-color: #e2e8f0;
            color: #334155;
        }

        .btn-secondary:hover {
            background-color: #cbd5e1;
        }

        footer {
            margin-top: auto;
            text-align: center;
            padding: 20px 0 10px;
            font-size: 0.9rem;
            color: #64748b;
        }
    </style>
</head>
<body>

    <header>
        <h1>Contact Lagos Library</h1>
    </header>

    <nav>
        <a href="index.html">Home</a> |
        <a href="books.html">Books</a> |
        <a href="membership.html">Membership</a> |
        <a href="gallery.html">Gallery</a> |
        <a href="contact.html">Contact Us</a>
    </nav>

    <hr>

    <main>
        <div class="card">
            <?php if ($success): ?>
                <div class="status-icon">📩</div>
                <h2 class="success-title">Message Sent Successfully!</h2>
                <p>Thank you, <strong><?php echo htmlspecialchars($name); ?></strong>.</p>
                <p>We have received your message and will respond to your email as soon as possible.</p>
                
                <div class="btn-group">
                    <a href="contact.html" class="btn">Send Another Message</a>
                    <a href="index.html" class="btn btn-secondary">Home Page</a>
                </div>
            <?php else: ?>
                <div class="status-icon">⚠️</div>
                <h2 class="error-title">Submission Failed</h2>
                <p><?php echo htmlspecialchars($errorMessage); ?></p>

                <div class="btn-group">
                    <a href="contact.html" class="btn">Return to Contact Form</a>
                </div>
            <?php endif; ?>
        </div>
    </main>

    <footer>
        <p>&copy; 2026 Lagos Library. All rights reserved.</p>
    </footer>

</body>
</html>