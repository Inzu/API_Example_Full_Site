<?php

///Category navigation for store

//Create the cart 

$right_col=<<<EOD
<div class="right_col">
<h2>Your cart</h2>
<hr/>
	<div style="margin-bottom:2px;">$item_count Items</div>
	<div style="margin-bottom:2px"><strong>Total:</strong> {$ECOM_CURRENCY}{$totalprice}<br />
	<a href="$pay" target="_blank" >Checkout</a><br />
	<a href="cart_edit.php">Edit cart</a></div>
<hr/>
	<h2>Categories</h2>
<hr/>
EOD;


//Request data from INZU for store category list
$inzu = INZU_GET("store/categories");

foreach ( $inzu as $entry => $sub ) { 

//Music pages use a different display page
if ( $entry == "Music" ) {
	
$page_type = "music.php";

} else {
	
$page_type = "store.php";

}

$right_col .=<<<EOD
<a href="{$page_type}?category=$entry">{$entry}</a><br />
EOD;
}


///Add offer details
$inzu = INZU_GET("store/offers");

$right_col.=<<<EOD
<p>OFFER CODE:<br/>
<strong>{$inzu->data[0]->offer_code}</strong> for {$inzu->data[0]->percentage}% off.</p>
EOD;


?>