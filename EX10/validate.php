<?php
$errors = array();

// Collect and sanitize POST data
$username = isset($_POST['username']) ? trim($_POST['username']) : '';
$name = isset($_POST['name']) ? trim($_POST['name']) : '';
$email = isset($_POST['email']) ? trim($_POST['email']) : '';
$phone = isset($_POST['phone']) ? trim($_POST['phone']) : '';
$ccnumber = isset($_POST['ccnumber']) ? trim($_POST['ccnumber']) : '';

// Validate Email
if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $errors[] = "Invalid email format.";
}

// Validate Phone (10 digits)
if (!preg_match("/^[0-9]{10}$/", $phone)) {
    $errors[] = "Invalid phone number format.";
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Registration Result</title>
<style>
  body {
    font-family: Arial, sans-serif;
    background-color: #f2f2f2;
    margin: 0;
    padding: 40px;
    display: flex;
    justify-content: center;
    align-items: center;
    min-height: 100vh;
  }
  .result-card {
    background: #ffffff;
    max-width: 500px;
    width: 100%;
    padding: 30px;
    border-radius: 8px;
    box-shadow: 0 4px 10px rgba(0,0,0,0.1);
  }
  h2 {
    color: #2d6cdf;
    margin-top: 0;
    text-align: center;
  }
  .success {
    color: #27ae60;
    font-weight: bold;
    text-align: center;
    margin-bottom: 20px;
  }
  .error-list {
    color: #e74c3c;
    background: #fdf2f2;
    padding: 15px;
    border-radius: 4px;
    border: 1px solid #f5c6cb;
  }
  table {
    width: 100%;
    margin-top: 15px;
    border-collapse: collapse;
  }
  th, td {
    padding: 10px;
    border-bottom: 1px solid #ddd;
    text-align: left;
    font-size: 14px;
  }
  th {
    color: #555;
    width: 40%;
  }
  td {
    color: #333;
  }
  .back-btn {
    display: block;
    text-align: center;
    margin-top: 20px;
    color: #2d6cdf;
    text-decoration: none;
    font-weight: bold;
  }
  .back-btn:hover {
    text-decoration: underline;
  }
</style>
</head>
<body>

<div class="result-card">
    <?php if (empty($errors)): ?>
        <h2 class="success">Registration Successful!</h2>
        <p style="text-align: center; color: #555;">Here are the details you submitted:</p>
        
        <table>
            <tr>
                <th>Username:</th>
                <td><?php echo htmlspecialchars($username); ?></td>
            </tr>
            <tr>
                <th>Full Name:</th>
                <td><?php echo htmlspecialchars($name); ?></td>
            </tr>
            <tr>
                <th>Email Address:</th>
                <td><?php echo htmlspecialchars($email); ?></td>
            </tr>
            <tr>
                <th>Phone Number:</th>
                <td><?php echo htmlspecialchars($phone); ?></td>
            </tr>
            <tr>
                <th>Credit Card:</th>
                <td>****-****-****-<?php echo htmlspecialchars(substr($ccnumber, -4)); ?></td>
            </tr>
        </table>
    <?php else: ?>
        <h2>Registration Failed</h2>
        <div class="error-list">
            <?php foreach ($errors as $e) { echo "<p>• " . htmlspecialchars($e) . "</p>"; } ?>
        </div>
    <?php endif; ?>

    <a href="index.html" class="back-btn">&larr; Go Back to Form</a>
</div>

</body>
</html>