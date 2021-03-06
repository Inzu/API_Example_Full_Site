<?php

$pageTitle = "Inzu - Legal";

// Load Includes

require("lib/core/functions.php");
require("lib/core/config.php");  // This is where your API Key is stored
require("template/template_start.php"); // Your site template start

// Inputs

$entry_id = preg_replace("/[^0-9]/", "", @$_GET['entry_id']);

// Request data from Inzu from the "Legal" section

$inzu = INZU_GET("cms/legal", array("entry_id"=>$entry_id));

// HTML

echo<<<EOD
<h2>Privacy Policy</h2>
<hr/>
<p class="article" >{$inzu->data[0]->entry}</p>
EOD;

require("template/template_end.php");

?>