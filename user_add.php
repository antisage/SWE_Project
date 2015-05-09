
<?php     

include('config2.php');


if($_REQUEST['username']=='' || $_REQUEST['email']=='' || $_REQUEST['password1']==''|| $_REQUEST['password2']=='')
{
	echo "Please Finish Enterting Information";
}
elseif($_REQUEST['password2'] != $_REQUEST['password1'])
	echo "Passwords do not match";
else
{
$sql="insert into users(Username,Email,Password,First_name,Last_name) values('".$_REQUEST['username']."', '".$_REQUEST['email']."', '".$_REQUEST['password1']."', '".$_REQUEST['firstname']."','".$_REQUEST['lastname']."')";

$res=mysql_query($sql);
if($res)
{
echo "User successfully inserted";
header("location:index.php");
}
else
{
echo "There is some problem in inserting user";
}
}
?>