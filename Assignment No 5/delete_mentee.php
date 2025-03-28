<?php
include 'db.php';

if (isset($_GET['email'])) {
    $email = $_GET['email'];

    // Delete mentee from the database
    $stmt = $conn->prepare("DELETE FROM mentees WHERE email = ?");
    $stmt->execute([$email]);

    echo "<script>alert('Mentee Deleted Successfully!'); window.location='display_mentees.php';</script>";
} else {
    echo "<script>alert('Invalid request!'); window.location='display_mentees.php';</script>";
}
?>
