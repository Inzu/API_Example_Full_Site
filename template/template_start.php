<?php

/*
This is an example website template header file. You may compeltely change this to suit your needs.
*/	

$navigation = site_map();

?>	


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title><?php echo $pageTitle;?></title>
<link href="/lib/css/main.css" rel="stylesheet" type="text/css" />
<link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet" type="text/css">
<?php echo $HEAD; ?>
</head>
<body>

<div id="shell">
	
	<div id="header">
	<a id="logo" href="/index.php"><img src="/lib/img/logo.png"  border="0" width="130"/></a>
	
	<div id="search">
	<form method="post" action="search.php">
	<input type="text" name="search">
	<input type="submit" value="search">
	</form>		
	</div>	
	
	</div>
	<div id="left_col">
		<div id="nav_main">
		<?php echo $navigation;?>
		</div>
	</div>
	
	<div id="central_col">

