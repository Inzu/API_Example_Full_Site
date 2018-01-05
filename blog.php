<?php

$pageTitle = "INZU - Blog";

//Load includes
require("lib/core/functions.php");
require("lib/core/config.php");  /// This is where your API Key is stored
require("template/template_start.php"); /// Your site template start

/*Page Content*/


//Get blog ID from from right column archive list if clicked
$entry_id = preg_replace("/[^0-9]/", "", @$_GET['entry_id']);


//Request data from INZU for the 32 latest "Blog" entries from the category set in the sitemap ordered by date and in ascending order.

$category = preg_replace("/[^a-zA-Z0-9]/", "", @$_GET['category']);

$arguments = array("page"=>"1", "page_rows"=>"32", "order"=>"date", "order_type"=>"ASC", "category"=>$category);
$inzu = INZU_GET("cms/blog", $arguments);


///Begin a loop that sorts the results into either the archive list or to be displayed on the page

$i=0;

foreach ($inzu->data as $entry) { 
	
$i++;

if( ( $i==1 && $entry_id=="") || ($entry_id == $entry->entry_id) ){ //Displays the first entry if an entry has not been selected from the archive

//Loop through the file attachments for the article

foreach ($entry->file_list as $file ){
$files.=<<<EOD
<div class="page_element">
{$file->description} - <a href="{$file->file}"/> Download</a>
</div>
EOD;
}


//Create the page and include the attachments

echo<<<EOD
<h2>Blog</h2>
<hr/><h2>{$entry->title}</h2>
<div class="article">
{$entry->article}
{$files}
</div>
EOD;

} else {

//If the entry is not being displayed it is added to the archive list

$archive.=<<<EOD
<div class="archive_row">
<div class="archive_list" ><a href="blog.php?entry_id={$entry->entry_id}">{$entry->title}</a></div>
</div>
EOD;

}
}


$right_col=<<<EOD
<h2>Blog Posts</h2>
<hr/>
$archive
EOD;



require("template/template_end.php");

?>
