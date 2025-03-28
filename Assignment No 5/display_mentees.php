<?php
include 'db.php';

$stmt = $conn->query("SELECT * FROM mentees");
$mentees = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>All Mentees</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <h2>Mentees List</h2>
        <table border="1">
            <tr>
                <th>Name</th>
                <th>Email</th>
                <th>Class</th>
                <th>Actions</th>
            </tr>
            <?php foreach ($mentees as $mentee): ?>
                <tr>
                    <td><?= $mentee['full_name'] ?></td>
                    <td><?= $mentee['email'] ?></td>
                    <td><?= $mentee['class'] ?></td>
                    <td>
                        <a href="update_mentee.php?email=<?= $mentee['email'] ?>">Edit</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </table>
    </div>
</body>
</html>
