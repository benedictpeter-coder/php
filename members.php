<?php

require_once "db.php";

// Retrieve all members from the database
$sql = "SELECT * FROM members ORDER BY id DESC";
$result = mysqli_query($conn, $sql);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Library Members</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="style.css">
</head>

<body>

    <h1>Registered Library Members</h1>

    <nav>
        <a href="index.html">Home</a> |
        <a href="books.html">Books</a> |
        <a href="membership.html">Membership</a> |
        <a href="gallery.html">Gallery</a> |
        <a href="contact.html">Contact Us</a>
    </nav>

    <hr>

    <table>

        <caption>Library Membership Records</caption>

        <tr>
            <th>ID</th>
            <th>Full Name</th>
            <th>Email</th>
            <th>Phone</th>
            <th>Membership Type</th>
            <th>Interests</th>
            <th>Additional Notes</th>
            <th>Duration</th>
            <th>Registration Date</th>
        </tr>

        <?php

        if (mysqli_num_rows($result) > 0) {

            while ($row = mysqli_fetch_assoc($result)) {

        ?>

        <tr>

            <td><?php echo htmlspecialchars($row["id"]); ?></td>

            <td><?php echo htmlspecialchars($row["full_name"]); ?></td>

            <td><?php echo htmlspecialchars($row["email"]); ?></td>

            <td><?php echo htmlspecialchars($row["phone"]); ?></td>

            <td><?php echo htmlspecialchars($row["membership_type"]); ?></td>

            <td><?php echo htmlspecialchars($row["interests"]); ?></td>

            <td><?php echo htmlspecialchars($row["additional_notes"]); ?></td>

            <td><?php echo htmlspecialchars($row["membership_duration"]); ?></td>

            <td><?php echo htmlspecialchars($row["registration_date"]); ?></td>

        </tr>

        <?php

            }

        } else {

            echo "<tr>";
            echo "<td colspan='9'>No membership records found.</td>";
            echo "</tr>";

        }

        ?>

    </table>

    <br>

    <p>
        <a href="membership.html">Register a New Member</a>
    </p>

    <footer>
        <p>&copy; 2026 Lagos Library. All Rights Reserved.</p>
    </footer>

</body>
</html>

<?php

mysqli_close($conn);

?>