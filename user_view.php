<html>
<head>
</head>
<body>
<?php
$con = mysql_connect("localhost","root","");
if (!$con){
die("Can not connect: " . mysql_error());
}
mysql_select_db("tshirt_schema",$con);

if(isset($_POST['update'])){
$UpdateQuery = "UPDATE users SET UserID='$_POST[UserID]', Username='$_POST[username]', Password='$_POST[password]', Email='$_POST[email]', First_name='$_POST[fname]', Last_name='$_POST[lname]' WHERE UserID='$_POST[hidden]'";               
mysql_query($UpdateQuery, $con);
};

if(isset($_POST['delete'])){
$DeleteQuery = "DELETE FROM users WHERE UserID='$_POST[hidden]'";          
mysql_query($DeleteQuery, $con);
};

if(isset($_POST['add'])){
$AddQuery = "INSERT INTO users (UserID, Username, Password, Email, First_name, Last_name) VALUES ('$_POST[uuserid]','$_POST[uusername]','$_POST[upassword]','$_POST[uemail]','$_POST[ufirst]','$_POST[ulast]')";         
mysql_query($AddQuery, $con);
};



$sql = "SELECT * FROM users";
$myData = mysql_query($sql,$con);
echo "<table border=3>
<tr>
<th>User ID</th>
<th>Username</th>
<th>Password</th>
<th>Email</th>
<th>First Name</th>
<th>Last Name</th>
</tr>";
while($record = mysql_fetch_array($myData)){
echo "<form action=user_view.php method=post>";
echo "<tr>";
echo "<td>" . "<input type=text name=UserID value=" . $record['UserID'] . " </td>";
echo "<td>" . "<input type=text name=username value=" . $record['Username'] . " </td>";
echo "<td>" . "<input type=text name=password value=" . $record['Password'] . " </td>";
echo "<td>" . "<input type=text name=email value=" . $record['Email'] . " </td>";
echo "<td>" . "<input type=text name=fname value=" . $record['First_name'] . " </td>";
echo "<td>" . "<input type=text name=lname value=" . $record['Last_name'] . " </td>";
echo "<td>" . "<input type=hidden name=hidden value=" . $record['UserID'] . " </td>";
echo "<td>" . "<input type=submit name=update value=update" . " </td>";
echo "<td>" . "<input type=submit name=delete value=delete" . " </td>";
echo "</tr>";
echo "</form>";
}
echo "<form action=user_view.php method=post>";
echo "<tr>";
echo "<td><input type=text name=uuserid></td>";
echo "<td><input type=text name=uusername></td>";
echo "<td><input type=text name=upassword></td>";
echo "<td><input type=text name=uemail></td>";
echo "<td><input type=text name=ufirst></td>";
echo "<td><input type=text name=ulast></td>";
echo "<td>" . "<input type=submit name=add value=add" . " </td>";
echo "</form>";
echo "</table>";
mysql_close($con);

?>

</body>
</html>