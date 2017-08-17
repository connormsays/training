<?php
require('../site.php');
require('../db.php');
if(isset($_POST['card']))
{

	$card = $mysqli->real_escape_string($_POST['card']);
	$cust = $mysqli->real_escape_string($_POST['customer']);
	$act = $mysqli->real_escape_string($_POST['act']);
	switch($act)
	{

	case "change":
	try
	{
	\Stripe\Stripe::setApiKey($site->getSetting('stripe_secret'));
	$customer = Stripe\Customer::retrieve($cust);
	$customer->default_source=$card;
	$customer->save(); 
	echo "Done";
	}
	catch(Exception $e)
	{
		echo $e;
	}
	break;

	case "delete":
	try
	{
	\Stripe\Stripe::setApiKey($site->getSetting('stripe_secret'));
	$customer = Stripe\Customer::retrieve($cust);
	$customer->sources->retrieve($card)->delete();
	echo "Done";
	}
	catch(Exception $e)
	{
		echo $e;
	}
	break;

	}


}