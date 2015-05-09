<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
        
	<title>Order Placement</title>
        
	<link href="css/style4.css" rel="stylesheet" type="text/css">
</head>

<body>

<?php 

include('config2.php');
session_start();

$user = $_SESSION['username'];
$shirts = $_SESSION['shirts'];
$cost = $_SESSION['cost'];

$sql="insert into orders(User,Shirts,Cost) values('$user','$shirts','$cost')";

$res=mysql_query($sql);
if($res)
{
echo "Order Placed!";
echo '<form action="index.php">';
echo '<input type="submit" value="Log Out">';
echo '</form>';
}
else
{
echo "There is a problem with your order";
}
?>
    <script src="js/index.js"></script>   
</body>
</html>