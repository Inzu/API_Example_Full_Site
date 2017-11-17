<?php

$pageTitle = "INZU - Store";

//Load includes
require("../lib/core/functions.php");
require("../lib/core/config.php");  /// This is where your API Key is stored
require("../template/template_start.php"); /// Your site template header

session_start();

/*Page Settings*/
$ECOM_LOC = ECOM_LOC;
$ECOM_CURRENCY = ECOM_CURRENCY;

require("cart.php"); /// Cart information  - requires page settings
require("nav.php"); /// Store category navigation for right column - requires page settings

$_SESSION['page_state'] = "store.php";


//Get the category selected by the user and store in session variable 

$category = preg_replace("/[^a-zA-Z0-9[:blank:][:space:]_]/", "", @$_REQUEST['category']);

if ( $category ) $_SESSION['category'] = $category;
$category = @$_SESSION['category'];

if ( $category == "Music" ) header("Location: music.php");

/*Page Content*/

echo<<<EOD
<h2>Store</h2>
<hr/>
EOD;

//Request data from INZU for the selected category
$inzu = INZU_GET("store/product", array("category"=>$category));

//A loop for each product
$i = 0;

foreach ( $inzu->data as $product ) { 

$i++;

$variations = NULL;
$price = NULL;

$title = $product->title;

//A second loop if the product has variations

if ( !$product->item_code ) {
	
	foreach ( $product->item as $item ) { 
		
		///Build variations drop down
		if( $item->variation_name != "" ) {
			
		$variations .= "<option value=\"{$item->item_code},{$item->{'price_'.$ECOM_LOC}}\">{$item->variation_name} - {$ECOM_CURRENCY}{$item->{'price_'.$ECOM_LOC}}</option>";
		
		}
		
	}

$price.=<<<EOD
<select name="variation">
$variations
</select>
EOD;

$title = $item->title;

//End variations

} else {
	
$price=<<<EOD
<input name="item_code" type="hidden" value="{$product->item_code}" />
<input name="price" type="hidden" value="{$product->{'price_'.$ECOM_LOC}}" />
{$ECOM_CURRENCY}{$product->{'price_'.$ECOM_LOC}}
EOD;

}


//Item display

echo<<<EOD
<div>
    <form action="item_add.php" method="post" name="form_main">
    <div>
        <img src="{$product->image_thumb}" height="80" width="80"  class="shop_img"  border="0" />
        <h4>{$title}</h4>
        <span class="shopDes" >{$product->description}</span><br>
        $price
    </div>
    <input type="submit" value="Buy"  />
    <hr/>
    </form>
</div>
EOD;


}


if ( $i < 1 ) {
	
echo<<<EOD
<h2>No merchandise is currently available.</h2>
EOD;

}

include("../template/template_end.php"); 

?>
