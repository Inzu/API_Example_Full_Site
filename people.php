<?php

$pageTitle = "INZU - People";

//Load includes
require("lib/core/functions.php");
require("lib/core/config.php");  /// This is where your API Key is stored
require("template/template_start.php"); /// Your site template start


/*Page Content*/

//Get the entry id
$entry_id = preg_replace("/[^0-9]/", "", @$_GET['entry_id']);

//Request data from INZU from the "People" section
$inzu = INZU_GET("cms/people", array("entry_id"=>$entry_id));


echo<<<EOD
<h2>People</h2>
<hr/>
<h3>Name</h3>
<p>{$inzu->data[0]->name}</p>

<h3>Department</h3>
<p>{$inzu->data[0]->department}</p>

<h3>Role</h3>
<p>{$inzu->data[0]->role}</p>

<h3>E-mail</h3>
<p>{$inzu->data[0]->email}</p>
EOD;


require("template/template_end.php");

?>
