Make sure to change config.php and upload .sql file!

-settings of server index.php also has to be changed



Setting Up for localhost

<?php
$currency = '$';
$db_username = 'root';
$db_password = '';
$db_name = 'tshirt_schema';
$db_host = 'localhost';
$mysqli = new mysqli($db_host, $db_username, $db_password,$db_name)or die("cannot connect");
?>

Setting Up for Site
<?php
$currency = '$';
$db_username = 'dbadmin09swe3613';
$db_password = '567lkj294mrt';
$db_name = 'tshirt_schema';
$db_host = 'localhost';
$mysqli = new mysqli($db_host, $db_username, $db_password,$db_name)or die("cannot connect");
?>