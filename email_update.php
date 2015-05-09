<?php
session_start();
include_once("config2.php");

$email1 = $_POST['email1'];
$email2 = $_POST['email2'];

$username = $_SESSION['username'];
$username = stripslashes($username);
$username = mysql_real_escape_string($username);

if($email1 != $email2)
header('Location: change_email.php');

$sql = "UPDATE users SET Email='$email1' WHERE Username = '$username'";

$res=mysql_query($sql);
if($res)
{
echo "Email Updated!";
header("location:user_home.php");
}
else
{
echo "There is some problem updating email";
}

?>