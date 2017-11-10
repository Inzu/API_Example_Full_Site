<?php

session_start();

$item_code = preg_replace("/[^a-z0-9_]/", "", @$_REQUEST['item_code']);
$quantity = preg_replace("/[^0-9]/", "", @$_REQUEST['quantity']);

$cart = preg_replace("/[^a-z0-9,{};:\".]/", "", @$_COOKIE["cart"]);
$cart = unserialize($cart);


//Increase quantity
foreach ( $cart as $item => $val ) {

if( $item == $item_code ) $cart[$item]['quantity'] = $quantity;

}

//Remove item
if ( $quantity == 0 ) unset($cart[$item_code]);

//If there are no items completely clear cart cookie of any data
$count = count($cart);

$cart = serialize($cart);

if ($count == 0 ) {
	
setcookie("cart", "", 0, "/");

} else {
	
setcookie("cart", $cart, 0, "/");

}

header("Location: cart_edit.php");


?>
