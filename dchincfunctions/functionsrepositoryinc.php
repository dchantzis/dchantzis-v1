<?php

function contactDCH($validationType)
{
	require_once('validate.class.php');

	$validator = new Validate();
	$explodeArr = array();
	$pageID = $_POST['pageid'];
	$errorsVarsArr = array();

	// read validation type (PHP or AJAX?)
	//if (isset($_GET['validationType'])){ $validationType = $_GET['validationType']; unset($_GET['validationType']); }
	//unset($_SESSION['errorformvalues']);
	$errorCode = NULL;

	//check if $_POST is set. If it's not set, then the form was not submitted normaly.
	if(!$validator->checkPost()){errorHandler(701,$validationType); exit;}
	else {} //all ok

	//check for CSRF (Cross Site Request Forgery)
	if(!$validator->checkCSRF($_POST["csrf"], CSRF_PASS_GEN.'submitcontactdch', $_POST['pageid'])){errorHandler(702,'ajax'); exit;} //error Redirect()
	else{ unset($_POST["csrf"]); unset($_POST["pageid"]); }//all ok

	//the array $arVals stores the names of all the values of the form
	$arVals = array("name"=>"","email"=>"","regarding"=>"","message"=>"","cc"=>"");
	//the array $arValsRequired stores the name of the values of the form that are required for the registration
	$arValsRequired = array("name"=>"","email"=>"","message"=>"");
	//the array $arValsMaxSize stores the names of all the values of the form and the maximum size that each value is allowed to have
	$arValsMaxSize = array("name"=>"100","email"=>"100","regarding"=>"100","message"=>CONTACT_MESSAGE_MAX_LENGTH);
	//the array $arValsValidations stores the names of the fields and the regular expression their values have to much with.
	$arValsValidations = array("email"=>"/\w+([-+.]\w+)*@\w+([-.]\w+)*\.\w+([-.]\w+)*/");

	if($_POST['cc']=='true'){$_POST['cc']='true';}
	else if($_POST['cc']=='false'){$_POST['cc']='false';}

	reset ($_POST);
	while (list($key, $val) = each ($_POST))
	{
		if (trim($val) == "") { $val = "NULL";}
		if ($key=='regarding'){if($val=='[regarding][not required]'){$val='NULL';}}
		$arVals[$key] = (get_magic_quotes_gpc()) ? $val : addslashes($val);
		$arVals[$key] = htmlentities($arVals[$key], ENT_QUOTES, "UTF-8");
		$arVals[$key] = trim($arVals[$key]);

		if ($val == "NULL"){ $_SESSION['formvalues'][$key] = NULL;}
		else
		{
			if($key!='message'){$_SESSION['formvalues'][$key] = strtolower($val);}
			else{$_SESSION['formvalues'][$key] = $val;}
		}//
	}//while
	unset($_POST);
	$arVals['submitiontimestamp'] = date("Y-m-d") . " " . date("H:i:s");

	reset($arVals);
	while (list($key, $val) = each ($arVals))
	{
		if($key!='reply'){$arVals[$key] = "'" . strtolower($arVals[$key]) . "'";}
		else{$arVals[$key] = "'" . $arVals[$key] . "'";}
	}//while

	$errorsVarsArr = $validator->ValidatePHP($arValsRequired, $arValsMaxSize, $arValsValidations);
	if($errorsVarsArr['errorCode'] != 0)
		{validateNsubmitXMLresponseContactDCH($errorsVarsArr,'','','index',$pageID);}

	if($errorsVarsArr['errorCode'] == 0)
	{
		$arVals=removeQuotes($arVals);
		sendEmail($arVals);
		validateNsubmitXMLresponseContactDCH('',$arVals,$insertID,'index',$pageID);
	}//if

}//contactDCH($validationType)

function sendEmail($emailVals)
{
	$emailVals['message'] = strtoupper($emailVals['name']).' (from '.$emailVals['email'].') '.' said, '
			."\r\n"
			."\r\n"
			. '"'.nl2br($emailVals['message']).'"';

	// If any lines are larger than 120 characters, we will use wordwrap()
	$emailVals['message'] = wordwrap($emailVals['message'],100);
	if(!isset($emailVals['regarding'])||($emailVals['regarding']=='null')){$emailVals['regarding']='[no subject] (message from dimitrioschantzis.com)';}
		else{$emailVals['regarding']=$emailVals['regarding'].' (message from dimitrioschantzis.com)';}

	// add additional headers...
	$headers = "From: mail@".SERVER_NAME."\r\n" .
	   "Reply-To: mail@".SERVER_NAME."\r\n" .
	   "X-Mailer: PHP/".phpversion();
	// Send the email...
	mail(DEFAULT_EMAIL,$emailVals['regarding'],$emailVals['message'],$headers);
	mail('chantzis.dimitrios@gmail.com',$emailVals['regarding'],$emailVals['message'],$headers);

	if($emailVals['cc']=='true')
	{
		$emailVals['message'] = 'Message you\'ve sent to info@dimitrioschantzis.com: '
			."\r\n"
			."\r\n"
			."\r\n"
			.$emailVals['message'];

		// Send the email...
		mail($emailVals['email'],$emailVals['regarding'],$emailVals['message'],$headers);
	}
}//sendEmail($emailVals)
?>
