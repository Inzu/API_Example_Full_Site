<?php

$pageTitle = "INZU - About";

//Load includes
require("lib/core/functions.php");
require("lib/core/config.php");  /// This is where your API Key is stored
require("template/template_start.php"); /// Your site template start

/*Page Content*/

//Get data from INZU for the "About" section
$inzu = INZU_GET("cms/about");

echo<<<EOD
<h2>About</h2>
<hr/><p class="article" >{$inzu->data[0]->about}</p>
EOD;

require("template/template_end.php");

?>