<?php

//Get cart cookie
$cart = preg_replace("/[^a-z0-9,{};:\".]/", "", @$_COOKIE["cart"]);

$item_array = array(); //Used on the edit cart page

if ( $cart ) {

//Turn cookie into PHP array
$cart_arr = unserialize($cart);

$pay = "https://payments.inzu.net/?item_code"; //Base checkout url

$item_count = 0;
$totalprice = 0;

//Cycle through cart array and create totals for quantity and price
foreach( $cart_arr as $item =>$val ) {

$item_count += $cart_arr[$item]['quantity'];
$totalprice += $cart_arr[$item]['price'] * $cart_arr[$item]['quantity'];

	for ( $i=0; $i < $cart_arr[$item]['quantity']; $i++) {
		
	$pay .= "=".$item;
	
	array_push($item_array, $item);
	
	}

}


$item_array = implode(",", $item_array);

//This is the callback page that users will return to when the order is complete
$pay .= "&callback=http://www.mysite.com/shop/shop.php?order=complete";  
$pay .= "&loc=".$ECOM_LOC;  //Optionally add currency location (set in config.php)

} else { 
	
$totalprice = 0;
$item_count = 0;

}

$totalprice = number_format($totalprice, 2, '.', ',');

?>