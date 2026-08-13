<?php
require_once "db.php";

// Query to retrieve all contact messages in reverse chronological order
$sql = "SELECT * FROM contacts ORDER BY id DESC";
$result = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Messages - online bookshop</title>
    
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
    
    <link rel="stylesheet" href="style.css">
</head>
<body>

    <h1>Submitted Contact Messages</h1>

    <nav>
        <a href="index.html">Home</a> |
        <a href="books.html">Books</a> |
       
        <a href="gallery.html">Gallery</a> |
        <a href="contact.html">Contact Us</a>
    </nav>

    <hr>

    <table>
        <caption>Received Messages</caption>
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Email</th>
                <th>Phone</th>
                <th>Message</th>
                <th>Date Received</th>
            </tr>
        </thead>
        <tbody>
            <?php
            if ($result && mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
            ?>
                    <tr>
                        <td><?php echo htmlspecialchars($row["id"]); ?></td>
                        <td><?php echo htmlspecialchars($row["name"]); ?></td>
                        <td><?php echo htmlspecialchars($row["email"]); ?></td>
                        <td><?php echo htmlspecialchars($row["phone"] ? $row["phone"] : "N/A"); ?></td>
                        <td style="text-align: left;"><?php echo nl2br(htmlspecialchars($row["message"])); ?></td>
                        <td><?php echo htmlspecialchars($row["submission_date"]); ?></td>
                    </tr>
            <?php
                }
            } else {
                echo "<tr><td colspan='6'>No contact messages found.</td></tr>";
            }
            ?>
        </tbody>
    </table>

    <br>

    <p style="text-align: center;">
        <a href="contact.html">Send a New Message</a>
    </p>

    <footer>
        <p>&copy; 2026 online bookshop. All rights reserved.</p>
    </footer>

</body>
</html>

<?php
// Close the database connection
mysqli_close($conn);
?>