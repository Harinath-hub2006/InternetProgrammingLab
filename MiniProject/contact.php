<?php
require_once 'db.php';
$msg = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = trim($_POST['name']);
    $email = trim($_POST['email']);
    $message = trim($_POST['message']);

    $stmt = $pdo->prepare("INSERT INTO feedback (name, email, message) VALUES (?, ?, ?)");
    $stmt->execute([$name, $email, $message]);
    $msg = "<div class='alert alert-success'>Thank you for your feedback!</div>";
}
?>
<!DOCTYPE html>
<html>
<head><title>Contact & Feedback</title><link rel="stylesheet" href="style.css"></head>
<body>
    <?php include 'navbar.php'; ?>
    <div class="container" style="max-width:600px;">
        <div class="card">
            <h2>Contact Us / Send Feedback</h2>
            <br>
            <?php echo $msg; ?>
            <form method="POST">
                <div class="form-group">
                    <label>Your Name:</label>
                    <input type="text" name="name" required>
                </div>
                <div class="form-group">
                    <label>Your Email:</label>
                    <input type="email" name="email" required>
                </div>
                <div class="form-group">
                    <label>Message / Queries:</label>
                    <textarea name="message" rows="4" required></textarea>
                </div>
                <button type="submit" style="width:100%;">Submit Feedback</button>
            </form>
        </div>
    </div>
</body>
</html>