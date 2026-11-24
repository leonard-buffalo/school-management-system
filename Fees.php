<?php
session_start();
if (!isset($_SESSION['username'])) { header("Location: index.php"); exit(); }
include 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $sid = $_POST['student_id'];
    $amount = $_POST['amount_paid'];
    $conn->query("INSERT INTO fees (student_id, amount_paid, payment_date) VALUES ('$sid','$amount', CURDATE())");
}
$students = $conn->query("SELECT * FROM students");
$fees = $conn->query("SELECT fees.*, students.student_name FROM fees JOIN students ON fees.student_id = students.id");
?>
<!DOCTYPE html>
<html>
<head><title>Fees</title></head>
<body style="font-family:Arial; padding:20px;">
<h2>Fees Management</h2>
<a href="dashboard.php">Back to Dashboard</a><br><br>
<form method="POST">
<select name="student_id" required>
<option value="">Select Student</option>
<?php while($s = $students->fetch_assoc()) { ?>
<option value="<?php echo $s['id']; ?>"><?php echo $s['student_name']; ?> - <?php echo $s['grade']; ?></option>
<?php } ?>
</select>
<input type="number" name="amount_paid" placeholder="Amount e.g. 500" required>
<button type="submit">Record Payment</button>
</form>
<br>
<table border="1" cellpadding="10">
<tr><th>Student</th><th>Amount</th><th>Date</th></tr>
<?php while($row = $fees->fetch_assoc()) { ?>
<tr><td><?php echo $row['student_name']; ?></td><td>K <?php echo $row['amount_paid']; ?></td><td><?php echo $row['payment_date']; ?></td></tr>
<?php } ?>
</table>
</body>
</html>