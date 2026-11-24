<?php
session_start();
if (!isset($_SESSION['username'])) { header("Location: index.php"); exit(); }
include 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['student_name'];
    $grade = $_POST['grade'];
    $gender = $_POST['gender'];
    $phone = $_POST['parent_phone'];
    $sql = "INSERT INTO students (student_name, grade, gender, parent_phone, date_added) VALUES ('$name','$grade','$gender','$phone', CURDATE())";
    $conn->query($sql);
}
$students = $conn->query("SELECT * FROM students");
?>
<!DOCTYPE html>
<html>
<head><title>Students</title></head>
<body style="font-family:Arial; padding:20px;">
<h2>Manage Students</h2>
<a href="dashboard.php">Back to Dashboard</a><br><br>
<form method="POST">
<input type="text" name="student_name" placeholder="Student Name" required>
<input type="text" name="grade" placeholder="Grade e.g. Grade 10" required>
<select name="gender"><option>Male</option><option>Female</option></select>
<input type="text" name="parent_phone" placeholder="Parent Phone" required>
<button type="submit">Add Student</button>
</form>
<br>
<table border="1" cellpadding="10">
<tr><th>ID</th><th>Name</th><th>Grade</th><th>Gender</th><th>Parent Phone</th></tr>
<?php while($row = $students->fetch_assoc()) { ?>
<tr><td><?php echo $row['id']; ?></td><td><?php echo $row['student_name']; ?></td><td><?php echo $row['grade']; ?></td><td><?php echo $row['gender']; ?></td><td><?php echo $row['parent_phone']; ?></td></tr>
<?php } ?>
</table>
</body>
</html>