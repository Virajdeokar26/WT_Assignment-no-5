<?php
include 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $full_name = $_POST['full_name'];
    $email = $_POST['email'];
    $class = $_POST['class'];
    $mentee_phone = $_POST['mentee_phone'];
    $parent_phone = $_POST['parent_phone'];
    $dob = $_POST['dob'];
    $gender = $_POST['gender'];
    $address = $_POST['address'];
    $skills = $_POST['skills'];
    $hobbies = $_POST['hobbies'];

    try {
        $sql = "INSERT INTO mentees (full_name, email, class, mentee_phone, parent_phone, dob, gender, address, skills, hobbies) 
                VALUES (:full_name, :email, :class, :mentee_phone, :parent_phone, :dob, :gender, :address, :skills, :hobbies)";
        $stmt = $conn->prepare($sql);
        $stmt->execute([
            ':full_name' => $full_name,
            ':email' => $email,
            ':class' => $class,
            ':mentee_phone' => $mentee_phone,
            ':parent_phone' => $parent_phone,
            ':dob' => $dob,
            ':gender' => $gender,
            ':address' => $address,
            ':skills' => $skills,
            ':hobbies' => $hobbies
        ]);
        echo "<script>alert('Mentee Added Successfully!');</script>";
    } catch (PDOException $e) {
        echo "<script>alert('Insertion Failed');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Mentee</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <h2>Add Mentee</h2>
        <form action="" method="POST">
            <label>Full Name:</label>
            <input type="text" name="full_name" required>

            <label>Email Address:</label>
            <input type="email" name="email" required>

            <label>Class:</label>
            <input type="text" name="class" required>

            <label>Mentee Phone No.:</label>
            <input type="tel" name="mentee_phone" required>

            <label>Parent's Phone No.:</label>
            <input type="tel" name="parent_phone" required>

            <label>Date of Birth:</label>
            <input type="date" name="dob" required>

            <label>Gender:</label>
            <div class="gender-options">
                <input type="radio" name="gender" value="Male" required> Male
                <input type="radio" name="gender" value="Female" required> Female
            </div>

            <label>Address:</label>
            <textarea name="address" required></textarea>

            <label>Skills:</label>
            <input type="text" name="skills" required>

            <label>Hobbies:</label>
            <input type="text" name="hobbies" required>

            <button type="submit">Add Mentee</button>
        </form>
        <a href="display_mentees.php">View All Mentees</a>
    </div>
</body>
</html>
