<?php


$pageTitle = "Inzu - Links";


// Load Includes

require("lib/core/functions.php");
require("lib/core/config.php");  // This is where your API Key is stored
require("template/template_start.php"); // Your site template start


// Request data from Inzu for the "Links" archive

$inzu = INZU_GET("cms/links");


// HTML

echo<<<EOD
<h2>Links</h2>
<hr/>
EOD;

foreach ( $inzu->data as $entry ) { 

echo<<<EOD
<p><img src="{$entry->image}" width="60" /></p>
Link: <a href="{$entry->HTML_link}">{$entry->HTML_link}</h2>
EOD;

}


require("template/template_end.php");


?>