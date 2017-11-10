<?php

$pageTitle = "INZU - Testimonials";

//Load includes
require("lib/core/functions.php");
require("lib/core/config.php");  /// This is where your API Key is stored
require("template/template_start.php"); /// Your site template start

/*Page Content*/

$entry_id = preg_replace("/[^0-9]/", "", @$_GET['id']);

//Request data from INZU from the "Testimonials" section
$inzu = INZU_GET("cms/testimonials", array("entry_id"=>$entry_id));

echo<<<EOD
<h2>Testimonials</h2>
<hr/><p class="article" >{$inzu->data[0]->testimonial}</p>
EOD;


require("template/template_end.php");

?>