<?php
require_once 'db.php';
$error = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = trim($_POST['email']);
    $password = $_POST['password'];

    $stmt = $pdo->prepare("SELECT * FROM users WHERE email = ?");
    $stmt->execute([$email]);
    $user = $stmt->fetch();

    if ($user && $password === $user['password']) {
        // Clear old session data and set fresh role data
        session_unset();
        $_SESSION['user_id'] = $user['user_id'];
        $_SESSION['full_name'] = $user['full_name'];
        $_SESSION['role'] = $user['role'];

        // Redirect based on role
        if ($user['role'] === 'admin') {
            header("Location: admin_dashboard.php");
        } else {
            header("Location: student_dashboard.php");
        }
        exit;
    } else {
        $error = "Invalid email or password.";
    }
}
?>
<!DOCTYPE html>
<html>
<head><title>Login</title><link rel="stylesheet" href="style.css"></head>
<body>
    <?php include 'navbar.php'; ?>
    <div class="container" style="max-width:400px; margin-top:50px;">
        <div class="card">
            <h2>Portal Login</h2>
            <br>
            <?php if($error): ?><div class="alert alert-danger"><?php echo $error; ?></div><?php endif; ?>
            <form method="POST">
                <div class="form-group"><label>Email:</label><input type="email" name="email" required></div>
                <div class="form-group"><label>Password:</label><input type="password" name="password" required></div>
                <button type="submit" style="width:100%;">Login</button>
            </form>
        </div>
    </div>
</body>
</html>