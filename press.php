<?php

$pageTitle = "Inzu - Press";

// Load Includes

require("lib/core/functions.php");
require("lib/core/config.php");  // This is where your API Key is stored
require("template/template_start.php"); // Your site template start

// Inputs

$entry_id = preg_replace("/[^0-9]/", "", @$_GET['entry_id']);

// Request data from Inzu from the "Press" section

$inzu = INZU_GET("cms/press", array("entry_id"=>$entry_id));

// HTML

echo<<<EOD
<h2>Press</h2>
<hr/><p class="article" >{$inzu->data[0]->description}</p>
<a href="{$inzu->data[0]->HTML_link}">{$inzu->data[0]->HTML_link}</a>
EOD;

require("template/template_end.php");

?>