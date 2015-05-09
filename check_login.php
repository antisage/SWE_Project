<?php

ob_start();

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

// Define $myusername and $mypassword
$myusername=$_POST['userField'];
$mypassword=$_POST['passField'];

// SQL Injection Protection! Unnecessary? Too Bad! :)
$myusername = stripslashes($myusername);
$mypassword = stripslashes($mypassword);
$myusername = mysql_real_escape_string($myusername);
$mypassword = mysql_real_escape_string($mypassword);


//Load specific part of db into $sql
$sql="SELECT * FROM $tbl_name WHERE Username='$myusername' and Password='$mypassword' and Admin=1";

$result=mysql_query($sql);
$count= mysql_num_rows($result);

if($count==1){
	header("location:admin_home.html");
}
else {
	//TAL   $sql = $mysqli->query("SELECT * FROM $tbl_name WHERE Username='$myusername' and Password='$mypassword'");
	$sql="SELECT * FROM $tbl_name WHERE Username='$myusername' and Password='$mypassword'";
	$result=mysql_query($sql);
	$count= mysql_num_rows($result);
	if($count==1){
		$_SESSION['username'] = $_POST['userField']; //saves username for the whole session
		header("location:user_home.php");
	}
	else {	
	header("location:index.php");
	}
}


ob_end_flush();
?>