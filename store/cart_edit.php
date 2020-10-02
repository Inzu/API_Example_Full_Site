<?php


$pageTitle = "Inzu - Edit Cart";


// Load Includes

include("../lib/core/functions.php");
include("../lib/core/config.php");  // This is where your API Key is stored
include("../template/template_start.php"); // Your site template header

$ECOM_LOC = ECOM_LOC;
$ECOM_CURRENCY = ECOM_CURRENCY;

require("cart.php"); /// Cart information  - requires page settings
require("nav.php"); /// Store category navigation for right column - requires page settings


// HTML

echo<<<EOD
<h2>Shop</h2>
<hr/>
EOD;

// Check if there are any items in the cart - item_array is created in cart.php

if ( $item_array ) {

// Request data from Inzu for the items in the cart based on the item array (a list of item codes)

$inzu = INZU_GET("store/cart", array("item_array"=>$item_array));

// Create a table for each item to allow removal and quantity change

$i = 0;

foreach ( $inzu->data as $item ) { 

$i++;

echo<<<EOD
<form  name="form_{$i}" id="form_main" method="post" action="item_quantity.php"  style="margin: 0px; padding: 0px;">
<input name="item_code" type="hidden" value="{$item->item_code}" />
<table cellspacing="0" cellpadding="0" width="445" >
    <tr>
        <td align="left" valign="middle" width="265" >{$item->title}</td>
        <td align="right" valign="middle" width="50">{$ECOM_CURRENCY}{$item->{'price_'.$ECOM_LOC}}</td>
        <td align="right" valign="middle" width="8"></td>
        <td align="left" valgin="middle" width="30"><input name="quantity" type="text" value="{$item->quantity}" size="2" maxlength="2" style="width:20px"></td>
        <td align="right" valgin="middle">
        <a href="javascript:document.form_{$i}.submit();">EDIT</a>&nbsp;<a href="item_remove.php?item_code={$item->item_code}">REMOVE</a></td>
    </tr>
</table>
</form>
<hr/>
EOD;

}

echo<<<EOD
<table border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td align="right" valign="middle" width="315">Total:&nbsp; {$ECOM_CURRENCY}{$totalprice}</td>
	   <td align="right" valign="middle" width="8"></td>
    <td align="left" valign="middle"> {$item_count} Items</td>
  </tr>
</table>
EOD;

} else {

// If there are no items in the cart

$item_count = "0";
$totalprice = "0";

echo "<div>You have no items in your cart.</div>";

}

$totalprice = number_format($totalprice, 2, '.', ',');

include("../template/template_end.php"); 


?>