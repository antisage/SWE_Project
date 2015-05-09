<html>
<head>
</head>
<body>
<button id="Button1" onClick="window.location.href='admin_home.html'"/><strong>Home Page</strong></button>
<?php
$con=mysqli_connect("localhost","root","","tshirt_schema");
// Check connection
if (mysqli_connect_errno()) {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
}

$result = mysqli_query($con,"SELECT * FROM orders");

echo "<table border='1'>
<tr>
<th>Order ID</th>
<th>User</th>
<th>Number of Shirts</th>
<th>Total Cost</th>
</tr>";

while($row = mysqli_fetch_array($result)) {
  echo "<tr>";
  echo "<td>" . $row['OrderID'] . "</td>";
  echo "<td>" . $row['User'] . "</td>";
  echo "<td>" . $row['Shirts'] . "</td>";
  echo "<td>" . $row['Cost'] . "</td>";
  echo "</tr>";
}

echo "</table>";

mysqli_close($con);
?> 
</body>
</html>