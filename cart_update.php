

<?php
session_start();
include_once("config.php");

//add item in shopping cart
if(isset($_POST["type"]) && $_POST["type"]=='add')
{
	//$product_code 	= $_POST["product_code"], FILTER_SANITIZE_STRING); //product code
	$product_code 	= $_POST["product_code"]; //product code
	//$product_qty 	= filter_var($_POST["product_qty"], FILTER_SANITIZE_NUMBER_INT); //product code
	$product_qty 	= $_POST["product_qty"];
	//$return_url 	= base64_decode($_POST["return_url"]); //return url
	$return_url = 'user_home.php';
	
    if($product_qty > 9001){
        die('<div align="center"><br/>That Quantity is not Allowed <br><a href="user_home.php">Back To Shop</a>.</div>');
    }

    if($product_qty < 0){
        die('<div align="center"><br/>That Quantity is not Allowed <br><a href="user_home.php">Back To Shop</a>.</div>');
    }


	//MySqli query - get details of item from db using product code
	$results = $mysqli->query("SELECT name,price FROM products WHERE code='$product_code' LIMIT 1");
	
	$obj = $results->fetch_object();
	
	if ($results) { //we have the product info 
		
		//prepare array for the session variable
		$new_product = array(array('name'=>$obj->name, 'code'=>$product_code, 'qty'=>$product_qty, 'price'=>$obj->price));
		
		if(isset($_SESSION["products"])) //if we have the session
		{
			$found = false; //set found item to false
			
			foreach ($_SESSION["products"] as $cart_itm) //loop through session array
			{
				if($cart_itm["code"] == $product_code){ //the item exist in array

					$product[] = array('name'=>$cart_itm["name"], 'code'=>$cart_itm["code"], 'qty'=>$product_qty, 'price'=>$cart_itm["price"]);
					$found = true;
				}else{
					//item doesn't exist in the list, just retrive old info and prepare array for session var
					$product[] = array('name'=>$cart_itm["name"], 'code'=>$cart_itm["code"], 'qty'=>$cart_itm["qty"], 'price'=>$cart_itm["price"]);
				}
			}
			
			if($found == false) //we didn't find item in array
			{
				//add new user item in array
				$_SESSION["products"] = array_merge($product, $new_product);
			}else{
				//found user item in array list, and increased the quantity
				$_SESSION["products"] = $product;
			}
			
		}else{
			//create a new session var if does not exist
			$_SESSION["products"] = $new_product;
		}
		
	}
	
	//redirect back to original page
	header('Location:'.$return_url);
}

//remove item from shopping cart
if(isset($_GET["removep"]) && isset($_GET["return_url"]) && isset($_SESSION["products"]))
{
	$product_code 	= $_GET["removep"]; //get the product code to remove
	//$return_url 	= base64_decode($_GET["return_url"]); //get return url
	$return_url 	= 'user_home.php';
	
	foreach ($_SESSION["products"] as $cart_itm) //loop through session array var
	{
		if($cart_itm["code"]!=$product_code){ //item does,t exist in the list
			$product[] = array('name'=>$cart_itm["name"], 'code'=>$cart_itm["code"], 'qty'=>$cart_itm["qty"], 'price'=>$cart_itm["price"]);
		}
		
		//create a new product list for cart
		$_SESSION["products"] = $product;
	}
	
	//redirect back to original page
	header('Location:'.$return_url);
}
?>