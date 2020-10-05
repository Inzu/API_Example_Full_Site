<?php

$pageTitle = "Inzu - Tickets";

// Load Includes

require("lib/core/functions.php");
require("lib/core/config.php");  // This is where your API Key is stored

// Set before header template

$HEAD = '<link href="/lib/css/calendar.css" rel="stylesheet" type="text/css" />';

require("template/template_start.php"); // Your site template start

// Inputs

$entry_id = preg_replace("/[^0-9]/", "", @$_GET['entry_id']);

// Request data from Inzu about the selected venue

$arguments = array("venue_id"=>$entry_id);
$inzu = INZU_GET("booking/venue", $arguments);

// Get booking calendar script from inzu 

$arguments = array("venue_id"=>$entry_id, "month_auto"=>"true");
$inzu_date_selector = INZU_GET("js/calendar/calendar.js", $arguments, "raw");

$ECOM_LOC = ECOM_LOC;
$ECOM_CURRENCY = ECOM_CURRENCY;

// HTML

echo<<<EOD
<h2>Tickets</h2>
<h3>{$inzu->data[0]->title} - {$inzu->data[0]->location}</h3>
<div id="dateSelect">
	<script type="text/javascript">
	
	$inzu_date_selector
	
	/* 
	
	Create a new calendar instance (including availability data)
		
	- targetElem refers to the HTML element ID where the calendar will be placed
	- calendar is extended in booking_form.js to interact with form for adding tickets
	
	*/
	
	var calendar = new INZU_calendar({'location':'$ECOM_LOC','currency':'$ECOM_CURRENCY','targetElem':'dateSelect','forward_btn':'/lib/img/month_fwd.png','backward_btn':'/lib/img/month_bwd.png'});
	
	
	</script>
	<script type="text/javascript" src="/lib/js/booking_form.js"></script>
</div>
<div id="booking-select" style="margin-top:16px;">
	<form action="booking_process.php" method="post">
	<table width="100%" border="0" cellspacing="0" cellpadding="0" >
		<thead id="booking-head">
			<tr>
				<th align="left">Tickets</th>
				<th width="72" align="center">Quantity</th>
				<th width="56" align="right">Price</th>
			</tr>
		</thead>
		<tfoot id="booking-total">
			<tr>
				<td align="left"></td>
				<td align="center"><strong>Total:</strong></td>
				<td align="right" id="basketTotal">{$ECOM_CURRENCY}0.00</td>
			</tr>
		</tfoot>
		<tbody id="booking-selected">
			<tr>
				<td align="left">Please select a date from the calendar...</td>
				<td align="center"><input type="text" maxlength="3" style="width:20px;" /></td>
				<td align="right">{$ECOM_CURRENCY}0.00</td>
			</tr>
		</tbody>
	</table>
	<input name="booking_date" id="booking_date" type="hidden"  />
	<input name="variations" id="variations" type="hidden" />
	<input name="dateSel" id="dateSel" type="hidden" />
	<input name="" type="submit" style="float:right;margin-top:6px;margin-bottom:6px;" />
	</form>
</div>
EOD;

require("template/template_end.php");

?>