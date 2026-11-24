<?php
session_start();
if (!isset($_SESSION['username'])) { header("Location: index.php"); exit(); }
include 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $sid = $_POST['student_id'];
    $subject = $_POST['subject'];
    $marks = $_POST['marks'];
    $conn->query("INSERT INTO grades (student_id, subject, marks) VALUES ('$sid','$subject','$marks')");
}
$students = $conn->query("SELECT * FROM students");
$grades = $conn->query("SELECT grades.*, students.student_name FROM grades JOIN students ON grades.student_id = students.id");
?>
<!DOCTYPE html>
<html>
<head><title>Grades</title></head>
<body style="font-family:Arial; padding:20px;">
<h2>Grades Management</h2>
<a href="dashboard.php">Back to Dashboard</a><br><br>
<form method="POST">
<select name="student_id" required>
<option value="">Select Student</option>
<?php while($s = $students->fetch_assoc()) { ?>
<option value="<?php echo $s['id']; ?>"><?php echo $s['student_name']; ?> - <?php echo $s['grade']; ?></option>
<?php } ?>
</select>
<input type="text" name="subject" placeholder="Subject e.g. Maths" required>
<input type="number" name="marks" placeholder="Marks e.g. 85" required>
<button type="submit">Add Grade</button>
</form>
<br>
<table border="1" cellpadding="10">
<tr><th>Student</th><th>Subject</th><th>Marks</th></tr>
<?php while($row = $grades->fetch_assoc()) { ?>
<tr><td><?php echo $row['student_name']; ?></td><td><?php echo $row['subject']; ?></td><td><?php echo $row['marks']; ?>%</td></tr>
<?php } ?>
</table>
</body>
</html>