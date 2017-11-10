<?php

$pageTitle = "INZU - Home";

//Load includes
require("lib/core/functions.php");
require("lib/core/config.php");  /// This is where your API Key is stored
require("template/template_start.php"); /// Your site template start

/*Page Content*/

//Request data from INZU for the "Home" section
$inzu = INZU_GET("cms/home");

echo<<<EOD
<h2>Home</h2>
<hr/><img src="{$inzu->data[0]->image}" width="160" /><p class="article" >{$inzu->data[0]->entry}</p>
EOD;


require("template/template_end.php");

?>