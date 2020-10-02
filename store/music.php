<?php


$pageTitle = "Inzu - Music Store";

session_start();


// Load Includes

require("../lib/core/functions.php");
require("../lib/core/config.php");  // This is where your API Key is stored 
require("../template/template_start.php"); // Your site template header


$ECOM_LOC = ECOM_LOC;
$ECOM_CURRENCY = ECOM_CURRENCY;

require("cart.php"); // Cart information  - requires page settings
require("nav.php"); // Store category navigation for right column - requires page settings


/*
	
We store information such as format and cat no is session variables so that when an item is added 
the correct product is displayed after the user is redirected back to the shop.

*/


// Get the format selected by the user and store in session variable 

$format = preg_replace("/[^a-zA-Z0-9_]/", "", @$_REQUEST['format']);

if ( $format ) $_SESSION['format'] = $format;

$format = @$_SESSION['format'];

// Cat no refers to a release's catalogue number - this is the same for all the formats in a release

$cat_no = preg_replace("/[^a-zA-Z0-9_]/", "", @$_REQUEST['cat_no']);

if ( $cat_no ) $_SESSION['cat_no'] = $cat_no;

// Set redirect back to music store after adding item

$_SESSION['page_state'] = "music.php";


// HTML

echo<<<EOD
<script type="text/javascript">

// HTML 5 audio play button

var playSound = {
	
	currentSound:null,
	currentSoundHTML:null,
	
	trigger: function(previewId) {
	
	
	if(this.currentSound && this.currentSoundId!=previewId){
		
	this.currentSound.pause();
	this.currentSoundHTML.innerHTML="PLAY";
	
	}
	
	newSound=document.getElementById('audiotag'+previewId);
	newSoundHTML=document.getElementById('control_btn'+previewId);
	
	if(newSoundHTML.innerHTML=="PLAY"){
    newSound.play();
	newSoundHTML.innerHTML="PAUSE";
	
	this.currentSoundId=previewId;
	this.currentSound=document.getElementById('audiotag'+previewId);
	this.currentSoundHTML=document.getElementById('control_btn'+previewId);
	
	newSound.onended = function() {
	newSound.pause();
	newSoundHTML.innerHTML="PLAY";
	};
	
	} else {
	newSound.pause();
	newSoundHTML.innerHTML="PLAY";
	}

	}
	
};

</script>

<h2>Store</h2>
    <hr/>
EOD;


// Featured Release


// If a release has been selected use "cat no" to get the data from Inzu otherwise just select the latest release

if ( $cat_no ) {
	
$inzu = INZU_GET("store/music", array("cat_no"=>$cat_no, "format"=>$format));

} else {
	
$inzu = INZU_GET("store/music", array("latest"=>"true", "format"=>$format));
	
}



/*
	
Format list - Get the list of formats available for this release and make links to change the format whilst passing the cat no in the URL.

*/

$format_array = explode(',', $inzu->data[0]->format_array); /// Turn comma separated format list into an array

foreach ( $format_array as $keys=>$val ) {
	
$format_links.=<<<EOD
<a href="music.php?cat_no={$inzu->data[0]->cat_no}&format={$val}" >$val</a>&nbsp;
EOD;

}

// Now create track list for the featured release and bundle information

$i=0;

foreach ( $inzu->data[0]->track as $track ) { 

// The track marked as "bundle" is used to retrieve information such as bundle price and bundle title

if ( $track->number == "bundle" ) {

// Create HTML for featured release bundle information

$featured=<<<EOD
<div>
    <img src="{$inzu->data[0]->image}" height="140" width="140"  class="shop_img" />
    <h1>{$track->title}</h1>
    {$track->artists}<br />
    {$inzu->data[0]->short_description}
</div>

<div class="shopPriceFeatured" ><strong>{$ECOM_CURRENCY}{$track->{'price_'.$ECOM_LOC}}</strong></div>
<div>Formats: $format_links</div>
<div class="buy_button" style="float:right" ><a href="item_add.php?item_code={$track->item_code}&quantity=1&price={$track->{'price_'.$ECOM_LOC}}">BUY</a></div>
EOD;

}



// Track list for featured release


// If a preview is available attach a Flash preview button

if ( $track->preview != "" ) {
	
$audio_button=<<<EOD

<script type="text/javascript">

var controlBtn = '<audio id="audiotag{$i}" preload="none"><source src="{$track->preview}" type="audio/mpeg"></audio><div class="item-btn item-preview"><div class="item-btn-txt" ><a href="javascript: playSound.trigger(\'{$i}\')"><span id="control_btn{$i}">PLAY</span></a></div></div>';

var myAudio = document.createElement('audio'); 

document.write(controlBtn); 

</script>
EOD;

} else {
	
$audio_button = NULL;

}


// Build track list leaving out the bundle

if ( $track->number != "bundle" ) {

// Only include buy button and price for each track if format is Digital

if ( $inzu->data[0]->format == "Digital" ) {

$track_price = "- <strong>{$ECOM_CURRENCY}{$track->{'price_'.$ECOM_LOC}}</strong>";

$buy=<<<EOD
<td width="39" align="left" ><div class="buy_button" style="float:right" ><a href="item_add.php?item_code={$track->item_code}&quantity=1&price={$track->{'price_'.$ECOM_LOC}}&loc=shop">BUY</a></div></td>
EOD;

}

$i++;

$track_list.=<<<EOD
<table width="100%" border="0" cellspacing="0" cellpadding="0" height="17">
  <tr>
    <td class="shopDes" >$i. {$track->title} $track_price</td>
    <td width="39" align="left" >$audio_button</td>
    $buy
  </tr>
</table>
EOD;


}

}

// End featured release

// List of first 16 available releases, only displaying bundle information

$inzu = INZU_GET("store/music", array("release"=>"true"));
	
foreach ( $inzu->data as $product ) { 

// Create format links

$format_links = NULL;

$format_array = explode(',', $product->format_array);

foreach ( $format_array as $keys=>$val ) {
	
$format_links.=<<<EOD
<a href="music.php?cat_no={$product->cat_no}&format={$val}" style="font-weight:normal">$val</a>&nbsp;
EOD;

}

$format_links=<<<EOD
<div class="section_heading shopLinkFormat" >
Formats: $format_links
</div>
EOD;



$more_releases.=<<<EOD
<div>
<div>
    <img src="{$product->image_thumb}" height="80" width="80"  class="shop_img" />
    <h2>{$product->title}</h2>
    <h4>{$product->artists}</h4>
    <span class="shopDes">{$product->short_description}<br />
    <strong>{$ECOM_CURRENCY}{$product->track[0]->{'price_'.$ECOM_LOC}}</strong><br />
    <a href="music.php?cat_no={$product->cat_no}&format={$product->format}"><strong>+ view tracks</strong></a></span>
</div>

	$format_links

    <div class="buy_button" style="margin-bottom:4px" ><a href="item_add.php?item_code={$product->track[0]->item_code}&quantity=1&price={$product->track[0]->{'price_'.$ECOM_LOC}}">BUY</a></div>
	<hr/>
</div>
EOD;


}


// Collate all data

echo<<<EOD
        $featured
        <div style="clear:both" >Track list</div>
        <hr/>
        $track_list
    <hr/>
    <div class="page_headingLarge shopHeading"><strong>More releases</strong></div>
<hr/>
$more_releases
EOD;


include("../template/template_end.php"); 


?>