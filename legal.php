<?php

$pageTitle = "INZU - Legal";

//Load includes
require("lib/core/functions.php");
require("lib/core/config.php");  /// This is where your API Key is stored
require("template/template_start.php"); /// Your site template start


/*Page Content*/

$entry_id = preg_replace("/[^0-9]/", "", @$_GET['entry_id']);

//Request data from INZU from the "Legal" section
$inzu = INZU_GET("cms/legal", array("entry_id"=>$entry_id));

echo<<<EOD
<h2>Privacy Policy</h2>
<hr/><p class="article" >{$inzu->data[0]->entry}</p>
EOD;


require("template/template_end.php");

?>
