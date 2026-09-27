<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Library - Book List</title>
<style>
  body {
    font-family: Arial, sans-serif;
    background-color: #f2f2f2;
    margin: 0;
    padding: 40px;
  }
  .container {
    max-width: 850px;
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
    font-size: 24px;
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
  td:last-child {
    font-weight: bold;
    color: #27ae60;
  }
</style>
</head>
<body>

<div class="container">
  <h2>Library Book Details</h2>
  
  <?php
  // Load the XML file
  $xml = simplexml_load_file("books.xml") or die("Error: Cannot load XML file.");
  
  echo "<table>";
  echo "<tr><th>Title</th><th>Author</th><th>Year</th><th>Price</th></tr>";
  
  // Loop through each <book> element and display its details
  foreach ($xml->book as $book) {
      echo "<tr>";
      echo "<td>" . htmlspecialchars($book->title) . "</td>";
      echo "<td>" . htmlspecialchars($book->author) . "</td>";
      echo "<td>" . htmlspecialchars($book->year) . "</td>";
      echo "<td>$" . number_format((float)$book->price, 2) . "</td>";
      echo "</tr>";
  }
  
  echo "</table>";
  ?>
</div>

</body>
</html>