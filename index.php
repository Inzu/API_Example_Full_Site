<?php
	
$pageTitle = "INZU - Home";	

//Load includes
require("lib/core/functions.php"); 
require("lib/core/config.php");  /// This is where your API Key and API Password is stored
require("template/template_start.php"); /// Your site template start


/*Page Content*/


//Request data from INZU for the "Home" section

$inzu = INZU_GET("/cms/home");

echo<<<EOD
<h2>Home</h2>
<hr/><p class="article" >{$inzu->data[0]->entry}</p>
EOD;



//Get the latest "Event" entry

$inzu = INZU_GET("/cms/events", array("latest"=>"true"));

echo<<<EOD
<div>
<img src="{$inzu->data[0]->image}" width="477"/>
<h2>{$inzu->data[0]->title}</h2>
<hr/><span class="main_body">{$inzu->data[0]->description}</span>
<hr/>
</div>
EOD;



//Get the latest "video" entry
$inzu = INZU_GET("/cms/video", array("latest"=>"true"));

echo<<<EOD
<div>
{$inzu->data[0]->video}
<h2>{$inzu->data[0]->title}</h2>
<hr/><span class="main_body">{$inzu->data[0]->description}</span>
<hr/></div>
EOD;



////Newsletter sign up

//Get email from sign-up form if sent
$email = preg_replace("/[^a-zA-Z0-9@._-]/", "",$_POST['email']); 

if($email){

//Send e-mail to INZU	- your newsletter key is generated in the Newsletter admin suite

if (eregi("^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$",  $_POST['email'])){ /// Checks the e-mail is valid

$data = array ('key' => 'be3393d40f5d5e97daab27a91ea9ftn', 'email' => $email);

$data = http_build_query($data);
$opts = array('http' =>
    array(
        'method'  => 'POST',
        'header'  => 'Content-type: application/x-www-form-urlencoded',
        'content' => $data
    )
);

$context  = stream_context_create($opts);
$result = file_get_contents('https://secure.inzu.net/newsletter/join.html', false, $context);


$message = "<strong>E-mail submitted.</strong><br />Thank you for joining the mailing list.";

} else {
$message="Please submit a valid e-mail address.";
}

} else {
$message="Join our mailing list.";
}

echo<<<EOD
<form name="form_main" action="index.php" method="post"  >
<div style="margin-top:8px"><h4>NEWSLETTER</h4>
<div>
<p>$message</p>
<input  name="email" type="text" value="E-mail address" onFocus="if(this.value=='E-mail address'){this.value=''}"; ><br />
<input type="submit" value="Join">
</div>
</div>
</form>
EOD;


include("template/template_end.php"); 

?>