<?php


$pageTitle = "INZU - Contact";


// Load Includes

require("lib/core/functions.php");
require("lib/core/config.php");  // This is where your API Key is stored
require("template/template_start.php"); // Your site template start


// Request data from INZU from the "Contact" section

$inzu = INZU_GET("cms/contact");


// HTML

foreach($inzu->data as $entry) {
	
$contacts.=<<<EOD
<h2>{$entry->title}</h2>
{$entry->contact}
EOD;

}


echo<<<EOD
<h2>Contact</h2>
<hr/>
$contacts
EOD;


require("template/template_end.php");


?>