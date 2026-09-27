<?php
require_once 'db.php';
$msg = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = trim($_POST['full_name']);
    $email = trim($_POST['email']);
    $pass = $_POST['password'];
    $role = $_POST['role'];

    try {
        $stmt = $pdo->prepare("INSERT INTO users (full_name, email, password, role) VALUES (?, ?, ?, ?)");
        $stmt->execute([$name, $email, $pass, $role]);
        $msg = "<div class='alert alert-success'>Registration successful! <a href='login.php'>Login here</a></div>";
    } catch (PDOException $e) {
        $msg = "<div class='alert alert-danger'>Email already registered.</div>";
    }
}
?>
<!DOCTYPE html>
<html>
<head><title>Register</title><link rel="stylesheet" href="style.css"></head>
<body>
    <?php include 'navbar.php'; ?>
    <div class="container" style="max-width:400px; margin-top:50px;">
        <div class="card">
            <h2>User Registration</h2>
            <br>
            <?php echo $msg; ?>
            <form method="POST">
                <div class="form-group"><label>Full Name:</label><input type="text" name="full_name" required></div>
                <div class="form-group"><label>Email:</label><input type="email" name="email" required></div>
                <div class="form-group"><label>Password:</label><input type="password" name="password" required></div>
                <div class="form-group">
                    <label>Role:</label>
                    <select name="role">
                        <option value="student">Student</option>
                        <option value="admin">Admin</option>
                    </select>
                </div>
                <button type="submit" style="width:100%;">Register</button>
            </form>
        </div>
    </div>
</body>
</html>