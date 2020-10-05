<?php
	
$pageTitle = "Inzu - Home";	

// Load Includes

require("lib/core/functions.php"); 
require("lib/core/config.php");  // This is where your API Key and API Password is stored
require("template/template_start.php"); // Your site template start

// Request data from Inzu for the "Home" section

$inzu = INZU_GET("/cms/home");

// HTML

echo<<<EOD
<h2>Home</h2>
<hr/><p class="article" >{$inzu->data[0]->entry}</p>
EOD;

// Get the latest "Event" entry

$inzu = INZU_GET("/cms/events", array("latest"=>"true"));

echo<<<EOD
<div>
<img src="{$inzu->data[0]->image}" width="477"/>
<h2>{$inzu->data[0]->title}</h2>
<hr/><span class="main_body">{$inzu->data[0]->description}</span>
<hr/>
</div>
EOD;

// Get the latest "video" entry

$inzu = INZU_GET("/cms/video", array("latest"=>"true"));

echo<<<EOD
<div>
{$inzu->data[0]->video}
<h2>{$inzu->data[0]->title}</h2>
<hr/><span class="main_body">{$inzu->data[0]->description}</span>
<hr/></div>
EOD;

// Newsletter Sign-up

$email = preg_replace("/[^a-zA-Z0-9@._-]/", "", @$_POST['email']); 

if ($email) {

	// Check the e-mail is valid
	
	if ( filter_var($email, FILTER_VALIDATE_EMAIL) ){ 
	
	// Send e-mail to Inzu to add to your mailing-list
	
	$result  = INZU_POST("newsletter/subscribe", array("email"=>$email));
	
		if ( $result->status == "posted" ) {
		 
		$message = "<strong>E-mail submitted!</strong><br/>Thank you for joining the mailing list.";
		
		} else {
			
		$message = "<strong>An error occurred!</strong><br/>Please try again.";
			
		}
	
	} else {
		
	$message = "Please submit a valid e-mail address!";
	
	}

} else {
	
$message = "Join our mailing list.";

}

echo<<<EOD
<form name="form_main" action="index.php" method="post">
	<div style="margin-top:8px">
		<h4>NEWSLETTER</h4>
		<div>
		<p>$message</p>
		<input  name="email" type="text" value="E-mail address" onFocus="if(this.value=='E-mail address'){this.value=''}"; ><br/>
		<input type="submit" value="Join">
	</div>
	</div>
</form>
EOD;

include("template/template_end.php"); 

?>