<?php
session_start();

//load functions
require("dchconfiginc.php");
require("functionsrepositoryinc.php");
require("commonfunctionsinc.php");

reset($_GET); //resets the pointer to the $_GET table
if(isset($_GET['type']))
{ 
	if(!preg_match("/^[0-9]([0-9]*)/",$_GET['type'])){$_GET['type'] = NULL; }
	else{$get_type = $_GET['type']; }
	unset($_GET['type']);
}else { $get_type = NULL; }

switch($get_type)
{
	case 1:
		contactDCH('ajax');
		break;
	default:
		//IMPORTANT TO HAVE NO ACTION
		return -1;
		break;
}//switch

//function with different headers for redirection purposes
function redirects($r_id,$flags)
{
	if(!preg_match("/^[0-9]([0-9]*)/",$r_id)){ $r_id = NULL; }
	else {}//do nothing. ALL OK
	
	switch($r_id)
	{
		case 0:
			header("Location: ./index.php".$flags);
			exit;
			break;
		default:
			//do nothing
			break;
	}//switch
}//Redirects()
?>