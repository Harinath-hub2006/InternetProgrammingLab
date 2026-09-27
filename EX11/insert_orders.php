<?php
include "db_connect.php";

$customer_name = $_POST['customer_name'];
$product_name  = $_POST['product_name'];
$quantity      = $_POST['quantity'];
$price         = $_POST['price'];

// Calculate total amount automatically
$total_amount  = $quantity * $price;

// Updated SQL query to include total_amount
$sql = "INSERT INTO orders (customer_name, product_name, quantity, price, total_amount) VALUES (?, ?, ?, ?, ?)";

$stmt = $conn->prepare($sql);
// "ssidd" stands for string, string, int, double, double
$stmt->bind_param("ssidd", $customer_name, $product_name, $quantity, $price, $total_amount);
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Order Status</title>
<style>
  body {
    font-family: Arial, sans-serif;
    background-color: #f2f2f2;
    margin: 0;
    padding: 0;
    display: flex;
    justify-content: center;
    align-items: center;
    min-height: 100vh;
  }
  .card {
    background: #ffffff;
    max-width: 400px;
    width: 100%;
    padding: 30px;
    border-radius: 8px;
    box-shadow: 0 4px 10px rgba(0,0,0,0.1);
    text-align: center;
  }
  h2 { color: #2d6cdf; margin-top: 0; }
  .success { color: #27ae60; font-weight: bold; margin-bottom: 20px; }
  .error { color: #e74c3c; font-weight: bold; margin-bottom: 20px; }
  .btn {
    display: inline-block;
    background-color: #2d6cdf;
    color: white;
    padding: 10px 20px;
    border-radius: 4px;
    text-decoration: none;
    font-weight: bold;
    margin-top: 15px;
  }
  .btn:hover { background-color: #1a52b8; }
</style>
</head>
<body>
<div class="card">
    <?php if ($stmt->execute()) { ?>
        <h2>Success</h2>
        <p class="success">Order placed successfully!</p>
        <p><strong>Total Amount Calculated:</strong> $<?php echo number_format($total_amount, 2); ?></p>
        <a href="view_orders.php" class="btn">View All Orders</a>
    <?php } else { ?>
        <h2>Error</h2>
        <p class="error"><?php echo "Error: " . htmlspecialchars($stmt->error); ?></p>
        <a href="index.html" class="btn">Try Again</a>
    <?php } ?>
</div>
</body>
</html>
<?php
$stmt->close();
$conn->close();
?>