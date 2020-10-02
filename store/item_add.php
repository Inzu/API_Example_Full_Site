<?php


session_start();


// The cart info is stored in a two dimensional serialised array using a cookie called "cart"

$cart = preg_replace("/[^a-z0-9,{};:\".]/", "", @$_COOKIE["cart"]); 

$item_code = preg_replace("/[^a-z0-9_]/", "", @$_REQUEST['item_code']);
$price = preg_replace("/[^a-z0-9._]/", "", @$_REQUEST['price']);


// For items with variations

$variation = preg_replace("/[^a-z0-9._,]/", "", @$_REQUEST['variation']);

if ($variation) {
		
	$variation = explode(",", $variation);
	$item_code = $variation[0];
	$price = $variation[1];

}


// Use this session variable to forward user back to the page they were on when selecting an item

if ( !$_SESSION['page_state'] ) $_SESSION['page_state'] = "store.php";

$_SESSION['page_state'] = $_SESSION['page_state']."?category=".$_SESSION['category'];


// If no items in cart add item to cart cookie and forward to 

if ( !$cart ) {

	$cart = array();
	
	$cart[$item_code]['quantity'] = 1;
	$cart[$item_code]['price'] = $price;
	
	$cart = serialize($cart);
	setcookie("cart", $cart, 0, "/");
	
	header("Location: ".$_SESSION['page_state']); 

} else {

	$cart = unserialize($cart);
	
	
	// Increase quantity if item already exists
	
	foreach( $cart as $item =>$val ) {
	
		if ( $item == $item_code) $cart[$item]['quantity']++;

	}

	// Otherwise add new entry 
	
	if ( !$cart[$item_code] ) {
			
		$cart[$item_code]['quantity'] = 1;
		$cart[$item_code]['price'] = $price;

	}

	
	$cart = serialize($cart);
	
	setcookie("cart", $cart, 0, "/");
	
	header("Location: ".$_SESSION['page_state']);
	 
}


?>