<?php
session_start();
if (!isset($_SESSION['username'])) { header("Location: index.php"); exit(); }
include 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $sid = $_POST['student_id'];
    $date = $_POST['attendance_date'];
    $status = $_POST['status'];
    $conn->query("INSERT INTO attendance (student_id, attendance_date, status) VALUES ('$sid','$date','$status')");
}
$students = $conn->query("SELECT * FROM students");
$records = $conn->query("SELECT attendance.*, students.student_name FROM attendance JOIN students ON attendance.student_id = students.id ORDER BY attendance.attendance_date DESC");
?>
<!DOCTYPE html>
<html>
<head><title>Attendance</title></head>
<body style="font-family:Arial; padding:20px;">
<h2>Attendance Management</h2>
<a href="dashboard.php">Back to Dashboard</a><br><br>
<form method="POST">
<select name="student_id" required>
<option value="">Select Student</option>
<?php while($s = $students->fetch_assoc()) { ?>
<option value="<?php echo $s['id']; ?>"><?php echo $s['student_name']; ?> - <?php echo $s['grade']; ?></option>
<?php } ?>
</select>
<input type="date" name="attendance_date" required>
<select name="status" required>
<option value="Present">Present</option>
<option value="Absent">Absent</option>
<option value="Late">Late</option>
</select>
<button type="submit">Mark Attendance</button>
</form>
<br>
<table border="1" cellpadding="10">
<tr><th>Student</th><th>Date</th><th>Status</th></tr>
<?php while($row = $records->fetch_assoc()) { ?>
<tr><td><?php echo $row['student_name']; ?></td><td><?php echo $row['attendance_date']; ?></td><td><?php echo $row['status']; ?></td></tr>
<?php } ?>
</table>
</body>
</html>