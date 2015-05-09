<?php
session_start();

//Variables
$host="localhost"; // Host name
$username="root"; // Mysql username
$password=""; // Mysql password
$db_name="tshirt_schema"; // Database name
$tbl_name="users"; // Table name

// Connect to server and select databse.
mysql_connect("$host", "$username", "$password")or die("cannot connect");
mysql_select_db("$db_name")or die("cannot select DB");
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
        
	<title>Page Title</title>
        
	<link href="css/style.css" rel="stylesheet" type="text/css">
</head>

<body>
<h1></h1>

<form name="change_email" action="email_update.php" method="post">
    	<table width="400" border="0">
    		<tr>
    			<td colspan="2"><p><strong>Registration Form</strong></p></td>
    		</tr>
    	<tr>
    		<td>Old Email:</td>
            <?php
			$username = $_SESSION['username'];
			$username = stripslashes($username);
			$username = mysql_real_escape_string($username);
			
			$sql="SELECT Email FROM $tbl_name WHERE Username='$username'";

			$result= mysql_query($sql);
			
			echo '<td>';
			echo mysql_result($result, 0);
			?> 
    	</tr>
    	<tr>
    		<td>New Email:</td>
    		<td><input type="text" name="email1" /></td>
    	</tr>
        <tr>
    		<td>Confirm New Email:</td>
    		<td><input type="text" name="email2" /></td>
    	</tr>
        <td><input type="submit" value="Update" /></td>
    
    <script src="js/index.js"></script>   
</body>
</html>