<?php
session_start();
include 'db.php';
$error = "";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $sql = "SELECT * FROM users WHERE username='$username' AND password='$password'";
    $result = $conn->query($sql);
    if ($result->num_rows == 1) {
        $_SESSION['username'] = $username;
        header("Location: dashboard.php");
        exit();
    } else {
        $error = "Wrong username or password!";
    }
}
?>
<!DOCTYPE html>
<html>
<head><title>Login - School System</title></head>
<body style="font-family:Arial; text-align:center; margin-top:100px;">
<h2>Lusaka Bright Future School</h2>
<h3>Login</h3>
<p style="color:red;"><?php echo $error; ?></p>
<form method="POST">
<input type="text" name="username" placeholder="Username" required><br><br>
<input type="password" name="password" placeholder="Password" required><br><br>
<button type="submit">Login</button>
</form>
<p>Try: admin / admin123</p>
</body>
</html>