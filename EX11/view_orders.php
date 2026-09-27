<?php
include "db_connect.php";

// Fetch up to 10 recent orders, including total amount and date
$sql = "SELECT order_id, customer_name, product_name, quantity, price, total_amount, order_date 
        FROM orders 
        ORDER BY order_date DESC 
        LIMIT 10";
$result = $conn->query($sql);
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>All Orders</title>
<style>
  body {
    font-family: Arial, sans-serif;
    background-color: #f2f2f2;
    margin: 0;
    padding: 40px;
  }
  .container {
    max-width: 950px;
    margin: 0 auto;
    background: #ffffff;
    padding: 30px;
    border-radius: 8px;
    box-shadow: 0 4px 10px rgba(0,0,0,0.1);
  }
  h2 {
    color: #2d6cdf;
    margin-top: 0;
    text-align: center;
    margin-bottom: 20px;
  }
  table {
    width: 100%;
    border-collapse: collapse;
    margin-top: 10px;
  }
  th, td {
    padding: 12px;
    border-bottom: 1px solid #ddd;
    text-align: left;
    font-size: 14px;
  }
  th {
    background-color: #2d6cdf;
    color: white;
  }
  tr:hover {
    background-color: #f9f9f9;
  }
  .no-orders {
    text-align: center;
    color: #777;
    padding: 20px;
  }
  .action-container {
    text-align: center;
    margin-top: 25px;
  }
  .btn {
    display: inline-block;
    background-color: #2d6cdf;
    color: white;
    padding: 10px 20px;
    border-radius: 4px;
    text-decoration: none;
    font-weight: bold;
  }
  .btn:hover { background-color: #1a52b8; }
</style>
</head>
<body>

<div class="container">
  <h2>Recent Orders</h2>
  <table>
    <tr>
      <th>Order ID</th>
      <th>Customer</th>
      <th>Product</th>
      <th>Qty</th>
      <th>Price</th>
      <th>Total Amount</th>
      <th>Order Date</th>
    </tr>
    <?php if ($result && $result->num_rows > 0) { ?>
      <?php while ($row = $result->fetch_assoc()) { ?>
        <tr>
          <td><?php echo htmlspecialchars($row['order_id']); ?></td>
          <td><?php echo htmlspecialchars($row['customer_name']); ?></td>
          <td><?php echo htmlspecialchars($row['product_name']); ?></td>
          <td><?php echo htmlspecialchars($row['quantity']); ?></td>
          <td>$<?php echo number_format($row['price'], 2); ?></td>
          <td><strong>$<?php echo number_format($row['total_amount'], 2); ?></strong></td>
          <td><?php echo htmlspecialchars($row['order_date']); ?></td>
        </tr>
      <?php } ?>
    <?php } else { ?>
      <tr><td colspan="7" class="no-orders">No orders found. Please place an order first.</td></tr>
    <?php } ?>
  </table>

  <div class="action-container">
    <a href="index.html" class="btn">&larr; Place Another Order</a>
  </div>
</div>

</body>
</html>
<?php 
if (isset($conn) && $conn) {
    $conn->close();
} 
?>