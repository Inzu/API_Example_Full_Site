<?php

session_start();

// Inputs

$item_code = preg_replace("/[^0-9]/", "", @$_GET['item_code']);
$cart = preg_replace("/[^a-z0-9,{};:\".]/", "", @$_COOKIE['cart']);

$cart_arr = unserialize($cart);

unset($cart_arr[$item_code]);

$count = count($cart_arr);

$cart = serialize($cart_arr);

// If there are no items completely clear cart cookie of any data

if ( $count == 0 ) {
	
	setcookie("cart", "", 0, "/");

} else {
	
	setcookie("cart", $cart, 0, "/");

}

header("Location: cart_edit.php");

?>