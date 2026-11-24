<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: index.php");
    exit();
}
include 'db.php';
$total_students = $conn->query("SELECT COUNT(*) as total FROM students")->fetch_assoc()['total'];
$total_fees = $conn->query("SELECT SUM(amount_paid) as total FROM fees")->fetch_assoc()['total'];
if (!$total_fees) $total_fees = 0;
?>
<!DOCTYPE html>
<html>
<head><title>Dashboard</title></head>
<body style="font-family:Arial; padding:20px;">
<h2>Welcome, <?php echo $_SESSION['username']; ?> 👋</h2>
<h3>Dashboard</h3>
<p><b>Total Students:</b> <?php echo $total_students; ?></p>
<p><b>Total Fees Collected:</b> K <?php echo $total_fees; ?></p>
<br>
<a href="students.php">Manage Students</a> |
<a href="grades.php">Manage Grades</a> | 
<a href="attendance.php">Manage Attendance</a> |  
<a href="fees.php">Manage Fees</a> |  
<a href="logout.php">Logout</a>
</body>
</html>