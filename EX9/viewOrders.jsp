<%@ page contentType="text/html;charset=UTF-8" language="java" %>
<%@ page import="java.util.List" %>
<%@ page import="com.shopping.model.Order" %>
<%@ page import="com.shopping.dao.OrderDAO" %>
<!DOCTYPE html>
<html>
<head>
<title>Order Details</title>
<style>
body {
font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Helvetica, Arial, sans-serif;
background: linear-gradient(135deg, #f8fafc 0%, #e2e8f0 100%);
color: #334155;
margin: 0;
padding: 40px 20px;
display: flex;
flex-direction: column;
align-items: center;
min-height: 100vh;
box-sizing: border-box;
-webkit-font-smoothing: antialiased;
}
.main-wrapper {
background-color: #ffffff;
padding: 40px;
border-radius: 16px;
box-shadow: 0 10px 25px -5px rgba(15, 23, 42, 0.08), 0 8px 10px -6px rgba(15, 23, 42, 0.08);
width: 100%;
max-width: 1100px;
box-sizing: border-box;
}
h2 {
color: #0f172a;
margin-top: 0;
font-size: 24px;
font-weight: 700;
letter-spacing: -0.025em;
margin-bottom: 12px;
}
a {
color: #2563eb;
text-decoration: none;
font-weight: 600;
font-size: 14px;
display: inline-block;
transition: color 0.2s;
}
a:hover {
color: #1d4ed8;
text-decoration: underline;
}
table { 
border-collapse: collapse; 
width: 100%; 
margin-top: 20px;
background-color: #ffffff;
border-radius: 8px;
overflow: hidden;
border: 1px solid #f1f5f9;
}
th, td { 
padding: 14px 16px; 
text-align: left; 
font-size: 14px;
}
th { 
background-color: #1e293b; 
color: white; 
font-weight: 600;
letter-spacing: 0.025em;
border: none;
}
td { 
border-bottom: 1px solid #f1f5f9; 
color: #334155; 
}
tr:last-child td {
border-bottom: none;
}
tr:nth-child(even) {
background-color: #f8fafc;
}
tr:hover {
background-color: #f1f5f9;
}
</style>
</head>
<body>
<div class="main-wrapper">
<h2>All Orders</h2>
<a href="orderForm.jsp">Place a New Order</a>
<table>
<tr>
<th>Order ID</th><th>Customer</th><th>Product</th><th>Qty</th>
<th>Price</th><th>Total</th><th>Date</th><th>Address</th>
</tr>
<%
OrderDAO dao = new OrderDAO();
List<Order> orders = dao.getAllOrders();
for (Order o : orders) {
%>
<tr>
<td><%= o.getOrderId() %></td>
<td><%= o.getCustomerName() %></td>
<td><%= o.getProductName() %></td>
<td><%= o.getQuantity() %></td>
<td><%= o.getPrice() %></td>
<td><%= o.getTotalAmount() %></td>
<td><%= o.getOrderDate() %></td>
<td><%= o.getAddress() %></td>
</tr>
<%
}
%>
</table>
</div>
</body>
</html>