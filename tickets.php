<?php

//Load includes
include("lib/core/config.php");  /// This is where your API Key is stored

$pageTitle = "INZU - Tickets";

$HEAD=<<<EOD
<link href="/lib/css/calendar.css" rel="stylesheet" type="text/css" />
EOD;

include("template/header.php"); /// Your site template header

/*Page Content*/


//Get venue ID
$entry_id = preg_replace("/[^0-9]/", "", @$_GET['id']);

//Request data from INZU about the selected venue
$json = file_get_contents("$api_base/booking/venue?api_key=$api_key&ticket_id=$entry_id");
$inzu = json_decode($json); 


//Get booking calendar script from inzu 
$inzu_date_selector = file_get_contents("$api_base/js/calendar/date_selector.js?api_key=$api_key&id=$entry_id&month_auto=true");



echo<<<EOD
<h2>Tickets</h2>

<h3>{$inzu->data[0]->title} - {$inzu->data[0]->location}</h3>
<div id="dateSelect">
<script type="text/javascript">

$inzu_date_selector

//Create a new calendar instance (including availability data)

var mySelector = new INZU_dateSelector({'location':'$loc','currency':'$currency','targetElem':'dateSelect','forward_btn':'/lib/img/month_fwd.png','backward_btn':'/lib/img/month_bwd.png','this_month':'hide'});

//targetElem refers to the HTML element ID where the calendar will be placed 

//mySelector is extended in ticket_form.js to interact with form for adding tickets

</script>
<script type="text/javascript" src="/lib/js/ticket_form.js"></script>
</div>


<div id="ticket-select" style="margin-top:16px;">

<form action="tickets_process.php" method="post">

<table width="100%" border="0" cellspacing="0" cellpadding="0" >

	<thead id="ticket-head">
		<tr>
			<th align="left">Tickets</th>
			<th width="72" align="center">Quantity</th>
			<th width="56" align="right">Price</th>
		</tr>
	</thead>
	
	<tfoot id="ticket-total">
		<tr>
			<td align="left"></td>
			<td align="center"><strong>Total:</strong></td>
			<td align="right" id="basketTotal">{$currency}0.00</td>
		</tr>
	</tfoot>
	
	<tbody id="ticket-selected">
		<tr>
			<td align="left">Please select a date from the calendar...</td>
			<td align="center"><input type="text" maxlength="3" style="width:20px;" /></td>
			<td align="right">{$currency}0.00</td>
		</tr>
	</tbody>

</table>

<input name="ticket_date" id="ticket_date" type="hidden"  />
<input name="variations" id="variations" type="hidden" />
<input name="dateSel" id="dateSel" type="hidden" />
<input name="" type="submit" style="float:right;margin-top:6px;margin-bottom:6px;" />

</form>

</div>

EOD;


include("template/footer.php"); /// Your site template header

?>