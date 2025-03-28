<?php
include 'db.php';

if (isset($_GET['email'])) {
    $email = $_GET['email'];
    $stmt = $conn->prepare("SELECT * FROM mentees WHERE email = ?");
    $stmt->execute([$email]);
    $mentee = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$mentee) {
        die("Mentee not found!");
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['update'])) {
    $full_name = $_POST['full_name'];
    $email = $_POST['email']; // Email should not be updated if it's a primary key
    $class = $_POST['class'];
    $mentee_phone = $_POST['mentee_phone'];
    $parent_phone = $_POST['parent_phone'];
    $dob = $_POST['dob'];
    $gender = $_POST['gender'];
    $address = $_POST['address'];
    $skills = $_POST['skills'];
    $hobbies = $_POST['hobbies'];

    // Update query
    $stmt = $conn->prepare("UPDATE mentees SET 
        full_name = ?, 
        class = ?, 
        mentee_phone = ?, 
        parent_phone = ?, 
        dob = ?, 
        gender = ?, 
        address = ?, 
        skills = ?, 
        hobbies = ? 
        WHERE email = ?");
    
    $stmt->execute([$full_name, $class, $mentee_phone, $parent_phone, $dob, $gender, $address, $skills, $hobbies, $email]);

    echo "<script>alert('Mentee Updated Successfully!'); window.location='display_mentees.php';</script>";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Mentee</title>
    <link rel="stylesheet" href="style.css">
    <script>
        function confirmDelete(email) {
            if (confirm("Are you sure you want to delete this mentee?")) {
                window.location.href = "delete_mentee.php?email=" + email;
            }
        }
    </script>
</head>
<body>
    <div class="container">
        <h2>Update Mentee</h2>
        <form action="" method="POST">
            <label>Full Name:</label>
            <input type="text" name="full_name" value="<?= htmlspecialchars($mentee['full_name']) ?>" required>

            <label>Email Address:</label>
            <input type="email" name="email" value="<?= htmlspecialchars($mentee['email']) ?>" readonly> <!-- Email should not be editable -->

            <label>Class:</label>
            <input type="text" name="class" value="<?= htmlspecialchars($mentee['class']) ?>" required>

            <label>Mentee Phone No.:</label>
            <input type="tel" name="mentee_phone" value="<?= htmlspecialchars($mentee['mentee_phone']) ?>" required>

            <label>Parent's Phone No.:</label>
            <input type="tel" name="parent_phone" value="<?= htmlspecialchars($mentee['parent_phone']) ?>" required>

            <label>Date of Birth:</label>
            <input type="date" name="dob" value="<?= htmlspecialchars($mentee['dob']) ?>" required>

            <label>Gender:</label>
            <div class="gender-options">
                <input type="radio" name="gender" value="Male" <?= $mentee['gender'] == 'Male' ? 'checked' : '' ?> required> Male
                <input type="radio" name="gender" value="Female" <?= $mentee['gender'] == 'Female' ? 'checked' : '' ?> required> Female
            </div>

            <label>Address:</label>
            <textarea name="address" required><?= htmlspecialchars($mentee['address']) ?></textarea>

            <label>Skills:</label>
            <input type="text" name="skills" value="<?= htmlspecialchars($mentee['skills']) ?>" required>

            <label>Hobbies:</label>
            <input type="text" name="hobbies" value="<?= htmlspecialchars($mentee['hobbies']) ?>" required>

            <button type="submit" name="update">Update Mentee</button>
            <button type="button" onclick="confirmDelete('<?= htmlspecialchars($mentee['email']) ?>')" class="delete-btn">Delete Mentee</button>
            <a href="add_mentee.php">Add a mentee</a>
        </form>
    </div>
</body>
</html>
