<%@ page contentType="text/html;charset=UTF-8" language="java" %>
<!DOCTYPE html>
<html>
<head>
<title>Place Order</title>
<style>
body {
font-family: sans-serif;
background-color: aliceblue;
color: slategray;
margin: 0;
display: flex;
flex-direction: column;
align-items: center;
justify-content: center;
min-height: 100vh;
}
.container {
background-color: white;
padding: 30px;
border-radius: 8px;
box-shadow: 0 4px 12px lightgray;
width: 100%;
max-width: 500px;
box-sizing: border-box;
}
h2 {
color: steelblue;
border-bottom: 2px solid lightsteelblue;
padding-bottom: 8px;
margin-top: 0;
}
a {
color: cornflowerblue;
text-decoration: none;
font-weight: bold;
margin-bottom: 15px;
display: inline-block;
}
a:hover {
text-decoration: underline;
}
input[type="text"],
input[type="password"],
input[type="number"],
input[type="date"],
textarea {
width: 100%;
padding: 10px;
margin-top: 6px;
margin-bottom: 16px;
border: 1px solid lightgray;
border-radius: 4px;
box-sizing: border-box;
font-size: 14px;
}
input[readonly] {
background-color: whitesmoke;
}
input[type="submit"] {
background-color: cornflowerblue;
color: white;
padding: 12px 20px;
border: none;
border-radius: 4px;
cursor: pointer;
font-size: 16px;
width: 100%;
}
input[type="submit"]:hover {
background-color: royalblue;
}
</style>
<script>
function calculateTotal() {
let quantity = document.getElementById("quantity").value;
let price = document.getElementById("price").value;
let totalField = document.getElementById("totalAmountDisplay");
   
if (quantity && price) {
let total = (parseFloat(quantity) * parseFloat(price)).toFixed(2);
totalField.value = total;
} else {
totalField.value = "";
}
}
</script>
</head>
<body>
<div class="container">
<h2>Enter Order Details</h2>
<a href="viewOrders.jsp">View All Orders</a>
<form action="AddOrderServlet" method="post">
<label>Customer Name:</label>
<input type="text" name="customerName" required/>
<label>Password:</label>
<input type="password" name="password" required/>
<label>Product Name:</label>
<input type="text" name="productName" required/>
<label>Quantity:</label>
<input type="number" id="quantity" name="quantity" min="1" required oninput="calculateTotal()"/>
<label>Price (per unit):</label>
<input type="number" id="price" name="price" step="0.01" required oninput="calculateTotal()"/>
<label>Total Amount:</label>
<input type="text" id="totalAmountDisplay" readonly/>
<label>Order Date:</label>
<input type="date" name="orderDate" required/>
<label>Address:</label>
<textarea name="address" rows="3"></textarea>
<input type="submit" value="Place Order"/>
</form>
</div>
</body>
</html>