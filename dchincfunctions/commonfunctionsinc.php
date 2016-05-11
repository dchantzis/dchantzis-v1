<?php
function validateNsubmitXMLresponse($errorCode,$fieldID,$fieldValue,$insertID,$valueType,$updateDate)
{
	//if($fieldID==''){$fieldID='null';}
	if($fieldValue==''){$fieldValue='null';}
	if($insertID==''){$insertID='null';}
	if($updateDate==''){$updateDate='null';}
	$response = '<?xml version="1.0" encoding="UTF-8" standalone="yes"?>' . '<response>';
	$response .= '<responsetype>'.'routine'.'</responsetype>'
				.'<valuetype>'.$valueType.'</valuetype>'
				.'<result>'.$errorCode.'</result>'
				.'<fieldid>'.$fieldID.'</fieldid>'
				.'<fieldvalue>'.$fieldValue.'</fieldvalue>'
				.'<insertid>'.$insertID.'</insertid>'
				.'<updatedate>'.$updateDate.'</updatedate>';
	$response .= '</response>';
	
	// generate the response
	if(ob_get_length()) { ob_clean(); }
	header('Content-Type: text/xml');
	echo $response;
}//validateNsubmitXMLresponse($errorCode,$fieldID,$fieldValue,$insertID,$valueType,$updateDate)

function validateNsubmitXMLresponseContactDCH($errorsVarsArr,$senderVarsArr,$insertID,$valueType,$pageID)
{
	if($insertID==''){$insertID = 'null';}
	if((!isset($senderVarsArr))||($senderVarsArr==''))
	{
		$senderVarsArr['name'] = 'null';
		$senderVarsArr['email'] = 'null';
		$senderVarsArr['regarding'] = 'null';
		$senderVarsArr['message'] = 'null';
		$senderVarsArr['cc'] = 'null';
	}
	if((!isset($errorsVarsArr))||($errorsVarsArr==''))
	{
		$errorsVarsArr['errorCode'] = 0;
		$errorsVarsArr['errorFieldID'] = 'null';
		$errorsVarsArr['errorFieldValue'] = 'null';
	}
	$response = '<?xml version="1.0" encoding="UTF-8" standalone="yes"?>' . '<response>';
	$response .= '<responsetype>'.'routine'.'</responsetype>'
				.'<valuetype>'.$valueType.'</valuetype>'
				.'<result>'.$errorsVarsArr['errorCode'].'</result>'
				.'<fieldid>'.$errorsVarsArr['errorFieldID'].'</fieldid>'
				.'<fieldvalue>'.$errorsVarsArr['errorFieldValue'].'</fieldvalue>'
				.'<insertid>'.$insertID.'</insertid>'
				.'<sendername>'.$senderVarsArr['name'].'</sendername>'
				.'<senderemail>'.$senderVarsArr['email'].'</senderemail>'
				.'<senderregarding>'.$senderVarsArr['regarding'].'</senderregarding>'
				.'<sendermessage>'.$senderVarsArr['message'].'</sendermessage>'
				.'<sendercc>'.$senderVarsArr['cc'].'</sendercc>'
				.'<pageid>'.$pageID.'</pageid>';
	$response .= '</response>';
	
	// generate the response
	if(ob_get_length()) { ob_clean(); }
	header('Content-Type: text/xml');
	echo $response;
}//validateNsubmitXMLresponseContactDCH($errorsVarsArr,$senderVarsArr,$insertID,$valueType,$pageID)
function errorReportXMLresponse($errorCode,$dbError,$message,$fieldValue,$fieldID,$valueType)
{
	if($fieldValue==''){$fieldValue='null';}
	if($fieldID==''){$fieldID='null';}
	if($valueType==''){$valueType='null';}
	if($dbError==''){$dbError='null';}
	
	$response = '<?xml version="1.0" encoding="UTF-8" standalone="yes"?>' . '<response>';
	$response .= '<responsetype>'.'errorreporter'.'</responsetype>'
				.'<errorcode>'.$errorCode.'</errorcode>'
				.'<message>'.$message.'</message>'
				.'<databaseerror>'.$dbError.'</databaseerror>'
				.'<fieldid>'.$fieldID.'</fieldid>'
				.'<fieldvalue>'.$fieldValue.'</fieldvalue>'
				.'<result>1</result>'
				.'<valuetype>'.$valueType.'</valuetype>';
	$response .='</response>';
	
	// generate the response
	if(ob_get_length()) { ob_clean(); }
	header('Content-Type: text/xml');
	echo $response;
	exit;
}//errorReportXMLresponse($errorCode,$message,$fieldValue,$fieldID,$valueType)

function errorHandler($errorCode,$validationType)
{
	$message = variousMessages($errorCode);
	
	$errArray['entryType']='error';
	$errArray['valueType']='-';
	$errArray['validationType']=$validationType;
	$errArray['errorCode']=$errorCode;
	$errArray['message']=$message;
	$errArray['query']='-';
	$errArray['dbError']='-';
	
	if($validationType=='ajax')
		{errorReportXMLresponse($errorCode,'',$message,'','','');}
	elseif($validationType=='php')
		{}
}//errorHandler($errorCode,$validationType)

function variousMessages($code)
{	
	if(!preg_match("/^[0-9]([0-9]*)/",$code)){ $code = NULL; 	$error = "";}
	else { 	$error = ""; }//do nothing. ALL OK
	
	$message = "";
	switch($code)
	{
		case 101:
			$message = $error."Please fill out all the requested fields.";
			break;
		case 102:
			$message = $error."The fields are too long for our database.";
			break;
		case 103:
			$message = $error."Unaccepted field value.";
			break;
		case 104:
			$message = $error."";
			break;
		case 701:
			$message = $error."Form was not submitted normally. Post value was not used.";
			break;
		case 702:
			$message = $error."Form was not submitted normally. CSRF error.";
			break;
		case 703:
			$message = $error."Values have been injected.";
			break;
		default:
			break;
	}//switch
	
	return $message;
}//errorMessages()

//removeQuotes($arVals)
function removeQuotes($arVals)
{
	reset($arVals);
	while (list($key, $val) = each ($arVals))
	{
		$arVals[$key] = substr($val,1,-1);
	}//while
	return $arVals;
}//removeQuotes()

//$ar_values --> array with values
//$from_str --> change this string
//$to_str -->with this
//example: convert_ar_vals($ar_values, "NULL", "*unspecified*")
function convertArVals($arVals, $fromStr, $toStr)
{
	reset ($arVals);
	while(list($key, $val) = each ($arVals))
	{
		if($val == strtoupper($fromStr) || $val == strtolower($fromStr)) 
		{
			$val = $toStr; 
			$arVals[$key] = $val;
		}//if
	}//while
	return $arVals;
}//convert_ar_vals($ar_values, $from_str, $to_str)

function convertTimeStamp($dateStr,$dateType)
{
	if($dateType=='full')
	{
		$monthNames = array( '1'=>'January','01'=>'January','2'=>'February','02'=>'February',
			'3'=>'March','03'=>'March','4'=>'April','04'=>'April','5'=>'May','05'=>'May',
			'6'=>'June','06'=>'June','7'=>'July','07'=>'July','8'=>'August','08'=>'August',
			'9'=>'September','09'=>'September','10'=>'October','11'=>'November','12'=>'December');
	}elseif($dateType=='short')
	{
		$monthNames = array( '1'=>'Jan','01'=>'Jan','2'=>'Feb','02'=>'Feb',
			'3'=>'Mar','03'=>'Mar','4'=>'Apr','04'=>'Apr','5'=>'May','05'=>'May',
			'6'=>'June','06'=>'June','7'=>'July','07'=>'July','8'=>'Aug','08'=>'Aug',
			'9'=>'Sept','09'=>'Sept','10'=>'Oct','11'=>'Nov','12'=>'Dec');
	}elseif($dateType=='reallyshort')
	{
		$monthNames = array( '1'=>'01','01'=>'01','2'=>'02','02'=>'02',
			'3'=>'03','03'=>'03','4'=>'04','04'=>'04','5'=>'05','05'=>'05',
			'6'=>'06','06'=>'06','7'=>'07','07'=>'07','8'=>'08','08'=>'08',
			'9'=>'09','09'=>'09','10'=>'10','11'=>'11','12'=>'12');		
	}elseif($dateType=='shortdaynmonth')
	{
		$monthNames = array( '1'=>'Jan','01'=>'Jan','2'=>'Feb','02'=>'Feb',
			'3'=>'Mar','03'=>'Mar','4'=>'Apr','04'=>'Apr','5'=>'May','05'=>'May',
			'6'=>'June','06'=>'June','7'=>'July','07'=>'July','8'=>'Aug','08'=>'Aug',
			'9'=>'Sept','09'=>'Sept','10'=>'Oct','11'=>'Nov','12'=>'Dec');
	}elseif($dateType=='reallylong')
	{
		$monthNames = array( '1'=>'January','01'=>'January','2'=>'February','02'=>'February',
			'3'=>'March','03'=>'March','4'=>'April','04'=>'April','5'=>'May','05'=>'May',
			'6'=>'June','06'=>'June','7'=>'July','07'=>'July','8'=>'August','08'=>'August',
			'9'=>'September','09'=>'September','10'=>'October','11'=>'November','12'=>'December');
	}
	
	$dateStr = str_replace(' ','-',$dateStr);
	$dateStr = str_replace(':','-',$dateStr);
	$explodeDateArr = explode('-',$dateStr);
	
	reset($monthNames);
	while (list($key, $val) = each ($monthNames)) { if($key==$explodeDateArr[1]){ $explodeDateArr[1] = $val; } }//
	$dateStr = $explodeDateArr[1].' '.$explodeDateArr[2].' '.$explodeDateArr[0].', '.$explodeDateArr[3].':'.$explodeDateArr[4];
	if($dateType=='reallyshort')
		{$dateStr = $explodeDateArr[1].'.'.$explodeDateArr[2].'.'.$explodeDateArr[0];}
	if($dateType=='shortdaynmonth')
		{$dateStr = $explodeDateArr[2].' '.$explodeDateArr[1].' '.substr($explodeDateArr[0],2,2);}
	if($dateType=='reallylong')
		{$dateStr = $explodeDateArr[1].' '.$explodeDateArr[2].', '.$explodeDateArr[0].' at '.$explodeDateArr[3].':'.$explodeDateArr[4];}
	return $dateStr;
}//convertTimeStamp($dateStr,$dateType)

function strReplaceCount($search,$replace,$subject,$times)
{
	$subjectOriginal=$subject;
	$len=strlen($search);    
	$pos=0;
	
	for($i=1; $i<=$times; $i++)
	{
		$pos=strpos($subject,$search,$pos);
        if($pos!==false)
		{
			$subject = substr($subjectOriginal,0,$pos);
			$subject .= $replace;
			$subject .= substr($subjectOriginal,$pos+$len);
			$subjectOriginal = $subject;
        }//if
		else{break;}
    }//for
    return($subject);
}//strReplaceCount

function checkCookiesAvailability($errVars)
{
	error_reporting (E_ALL ^ E_WARNING ^ E_NOTICE);
	setcookie ('test', 'test', time() + 60000);
	if (!empty($_COOKIE['test'])) 
	{
		if(isset($errVars['javascriptEnabled'])){ 
			if($errVars['javascriptEnabled']!='1'){redirects(0,'');}
		}
		else{}
	}//"Cookies are enabled on your browser"
	else if(!isset($_COOKIE['test']))
	{ 
		if(!isset($errVars['javascriptEnabled']))
		{
			redirects(20,'?e='.hash('sha256', "cookies"));
		}
		else{}
	}
}//checkCookies()
?>