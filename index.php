<?php
if (session_status() != PHP_SESSION_NONE) {
	
	//UNSET EVERYTHING EVVVVEERRTYYTHHIJNGNGNGSDF:FJl;j!!!!!1111 BURN IT DOWN
	session_unset();
    session_destroy();
	
	if (ini_get("session.use_cookies")) {
    $params = session_get_cookie_params();
    setcookie(session_name(), '', time() - 42000,
        $params["path"], $params["domain"],
        $params["secure"], $params["httponly"]
    );
}
	$keys = array();

	foreach($GLOBALS as $k => $v){
		$keys[] = $k;
	}
	
	for($t=1;$keys[$t];$t++){
		unset($$keys[$t]);
	}
	unset($k); unset($v); unset($t);
}
?>

<!DOCTYPE html>
<html>
<head>

  <meta charset="UTF-8">

  <title>Login</title>

  <link rel="stylesheet" href="css/reset.css">

<link rel="stylesheet" href="css/style.css" media="screen" type="text/css"/>

</head>

<body>

	<h1>Shirt Store</h1>

	<div class="wrapper">
        <form method="POST" id="login_form" action="check_login.php">
            <div class="avatar"><img src="images/Tshirt.gif">
            </div>
            
            <input name="userField" type="text" id="userField" placeholder="username">
            
            <div class="bar">
                <i></i>
            </div>
            
            <input name="passField" type="password"  id="passField" placeholder="password">
            
            <button>Log in</button>
            
         <div class="reg">  
         <a href="reg_user.html">Register Here</a>
         </div>
         
        </form>
	</div>

<script src="js/index.js"></script>

</body>
</html>