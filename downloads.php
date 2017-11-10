<?php


$pageTitle = "INZU - Downloads";

//Load includes
require("lib/core/functions.php");
require("lib/core/config.php");  /// This is where your API Key is stored
require("template/template_start.php"); /// Your site template start


//Get ID from right column archive list if clicked
$entry_id = preg_replace("/[^0-9]/", "", @$_GET['id']);


/*Page Content*/

//Request data from INZU for the 100 latest "Download" entries, ordered by date and in ascending order.

$arguments = array("page"=>"1", "page_rows"=>"100", "order"=>"date", "order_type"=>"ASC");
$inzu = INZU_GET("cms/downloads", $arguments);


///We now begin a loop that sorts the results into either the archive list or to be displayed on the page

$i=0;

foreach ( $inzu->data as $entry ) { 
	
$i++;

if( ( $i == 1 && $entry_id == "" ) || ( $entry_id == $entry->entry_id ) ){ //Displays the first entry if an entry has not been selected from the archive

echo<<<EOD
<h2>Downloads</h2>
<hr/>
<p><img src="{$entry->image}" width="60"  /></p>
<h2>{$entry->title}</h2>
<h3>Description</h3>
{$entry->description}
<h3>File</h3>
<a href="{$entry->file_link}">Click to download</a>
EOD;

} else {

//Create archive

$date = intval($entry->date);
$date = date("M jS :: Y",$date);

$archive.=<<<EOD
<div class="archive_row">
<div class="archive_list" ><a href="downloads.php?id={$entry->entry_id}">{$entry->title}</a> $date</div>
</div>
EOD;

}
}


$right_col=<<<EOD
<h2>Archive</h2>
<hr/>
$archive
EOD;



require("template/template_end.php");


?>