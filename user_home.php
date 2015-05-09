<?php
session_start();
include_once("config.php");
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>User Home</title>
<link href="css/style2.css" rel="stylesheet" type="text/css">
</head>

<body>

<div id=”nav”>
      <a href="change_email.php">Change Email</a>
      <a href="index.php">Log Out</a>
      <?php
      echo $_SESSION['username'];
	  ?>
</div>

<div id="products-wrapper">
    <h1>Products</h1>
    <div class="products">
    <?php
    //current URL of the Page. cart_update.php redirects back to this URL
	//$current_url = base64_encode($url="http://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']);
	$current_url = 'user_home.php';
    
	$results = $mysqli->query("SELECT * FROM products ORDER BY id ASC");
    if ($results) { 
	
        //fetch results set as object and output HTML
        while($obj = $results->fetch_object())
        {
			echo '<div class="product">'; 
            echo '<form method="post" action="cart_update.php">';
			echo '<div class="product-thumb"><img src="images/'.$obj->img.'"></div>';
            echo '<div class="product-content"><h3>'.$obj->name.'</h3>';
            echo '<div class="product-desc">'.$obj->desc.'</div>';
            echo '<div class="product-info">';
			echo 'Price '.$currency.$obj->price.' | ';
            echo 'Qty <input type="text" name="product_qty" value="1" size="3" />';

            //Size Controls
            echo '<br><input type="radio" name="size" value="S">S';
            echo '<input type="radio" name="size" value="M">M';
            echo '<input type="radio" name="size" value="L">L';
            echo '<input type="radio" name="size" value="XL">XL';

			echo '<br><button class="add_to_cart">Add To Cart</button>';
			echo '</div></div>';
            echo '<input type="hidden" name="product_code" value="'.$obj->code.'" />';
            echo '<input type="hidden" name="type" value="add" />';
			echo '<input type="hidden" name="return_url" value="'.$current_url.'" />';
            echo '</form>';
            echo '</div>';
        }

    }
    ?>
    </div>
    
<div class="shopping-cart">
<h2>Your Shopping Cart</h2>
<?php
if(isset($_SESSION["products"]))
{
    $total = 0;
    $qtytotal = 0;
    $newtotal = 0;
    echo '<ol>';
    foreach ($_SESSION["products"] as $cart_itm)
    {
        echo '<li class="cart-itm">';
        echo '<span class="remove-itm"><a href="cart_update.php?removep='.$cart_itm["code"].'&return_url='.$current_url.'">&times;</a></span>';
        echo '<h3>'.$cart_itm["name"].'</h3>';
        echo '<div class="p-qty">Qty : '.$cart_itm["qty"].'</div>';
        echo '<div class="p-price">Price :'.$currency.$cart_itm["price"].'</div>';
        echo '</li>';
        $subtotal = ($cart_itm["price"]*$cart_itm["qty"]);
        $total = ($total + $subtotal);
        $qtytotal = $cart_itm["qty"];
        if ($qtytotal >= 50) {
            echo '<div class="discount-txt"> 15% off Applied!</div>';
            $newtotal = $total*.85;
        }
        else {
            $newtotal = $total;
        }
    }
    echo '</ol>';
	$_SESSION['shirts'] = $qtytotal;
	$_SESSION['cost'] = $newtotal;
    echo '<span class="check-out-txt"><strong>Total : '.$currency.number_format($newtotal, 2, '.', '').'</strong> <a href="shoppingCart.html">Check-out!</a></span>';
}else{
    echo 'Cart is empty';
}
?>
</div>
</div>
</body>
</html>