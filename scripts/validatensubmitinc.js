// validatensubmitinc.js
/*
contains functions:
///////////////////
validateNsubmit(fieldID)
sendXMLRequestValidateNsubmit(type)
readResponseValidateNsubmit()
errorMessages(element, fieldID, errorCode)
*/

// when set to true, display detailed error messages
var showErrors = true;
// initialize the validation requests cache
var validateNsubmitCache = new Array();
var validateNsubmitServerAddress;
var tempStrArr = new Array();

// the function handles the validation for any form field
function validateNsubmit(fieldID) {}//validateNsubmit(fieldID)

function validateNsubmitMultipleValues()
{
	$('#sender_send').click(function(e){ e.preventDefault(); alert("This is a demo site. To contact me please send an email the address: info@dimitrioschantzis.com"); });
	return 0;
	// holds the remote server address (for validations)
	validateNsubmitServerAddress = "./dchincfunctions/functionsinc.php?type=";
	var csrf = null;
	var sendername = null;
	var senderemail = null;
	var senderregarding = null;
	var sendermessage = null;
	var sendercc = null;

	frmID = $('contactfrm');
	loaderID = $('sender_loader');
	message = $('sender_failed');

	frmID.style.display='none';
	loaderID.style.display='block';
	loaderID.innerHTML='<div><img class="loaderimg" src="./layout/images/biggerloader.gif" />Loading... </div>';

	switch(document.body.className)
	{
		case "index":
			validateNsubmitServerAddress +="1";
			sendername = $('sender_name').value;
			senderemail = $('sender_email').value;
			senderregarding = $('sender_regarding').value;
			sendermessage = $('sender_message').value;
			sendercc = $('sender_cc').checked;
			csrf = $('csrf').innerHTML;
			csrf += 'submitcontactdch';
			break;
		default:
			break;
	}//switch

	// only continue if xmlHttp isn't void
	if (xmlHttp)
	{
		// if we received non-null parameters, we add them to cache in the
		// form of the query string to be sent to the server for validation
		if((sendername!='')&&(sendername!='[type your name][required]')&&
			(senderemail!='')&&(senderemail!='[type your email][required]')&&
			(sendermessage!='')&&(sendermessage!='[type your message][required]'))
		{
			// encode values for safely adding them to an HTTP request query string
			switch(document.body.className)
			{
				case "index":
					sendername = encodeURIComponent(sendername);
					senderemail = encodeURIComponent(senderemail);
					senderregarding = encodeURIComponent(senderregarding);
					sendermessage = encodeURIComponent(sendermessage);
					sendercc = encodeURIComponent(sendercc);
					csrf = encodeURIComponent(csrf);
					validateNsubmitCache.push("name="+sendername+"&email="+senderemail+"&regarding="+senderregarding+"&message="+sendermessage+"&cc="+sendercc+"&csrf="+csrf+"&pageid=index");
					break;
				default:
					break;
			}//switch
			message.className='hidden';
			message.innerHTML='';
			sendXMLRequestValidateNsubmit('multipleValues');
		}//if
		else{
			message.innerHTML = 'Error: please fill the required fields';
			message.className = 'error';
			loaderID.innerHTML='';
			loaderID.style.display='none';
			frmID.style.display='block';
		}
	}//if
}//validateNsubmitMultipleValues()

function sendXMLRequestValidateNsubmit(type)
{
	// try to connect to the server
	try
	{
		// continue only if the XMLHttpRequest object isn't busy
		// and the cache is not empty
		if ((xmlHttp.readyState == 4 || xmlHttp.readyState == 0) && validateNsubmitCache.length > 0)
		{
			// get a new set of parameters from the cache
			var cacheEntry = validateNsubmitCache.shift();
			// make a server request to validate the extracted data
			xmlHttp.open("POST", validateNsubmitServerAddress, true);
			xmlHttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
			if(type=='singleValue'){xmlHttp.onreadystatechange = handleRequestStateChangeValidateNSubmit;}
			else if(type=='multipleValues'){xmlHttp.onreadystatechange = handleRequestStateChangeValidateNSubmitMultipleValues;}
			xmlHttp.send(cacheEntry);
		}//if
	}//try
	catch (e)
	{
		// display an error when failing to connect to the server
		displayError(e.toString(), "submit");
	}//catch
}//sendXMLRequestValidateNsubmit(type)

// read server's response
function readResponseValidateNsubmit() {}//readResponseValidateNsubmit()

function readResponseValidateNsubmitMultipleValues()
{
	// retrieve the server's response
	var response = xmlHttp.responseText;
	// server error?
	if (response.indexOf("ERRNO") >= 0 || response.indexOf("error:") >= 0 || response.length == 0){throw(response.length == 0 ? "Server error." : response);}
	// get response in XML format (assume the response is valid XML)
	responseXml = xmlHttp.responseXML;
	// get the document element
	xmlDoc = responseXml.documentElement;

	responsetype = xmlDoc.getElementsByTagName("responsetype")[0].firstChild.data;
	if(responsetype!='routine'){errorReporter(); return 0;}//error
	else{}//OK

	newSenderName = xmlDoc.getElementsByTagName("sendername")[0].firstChild.data;
	newSenderEmail = xmlDoc.getElementsByTagName("senderemail")[0].firstChild.data;
	newSenderRegarding = xmlDoc.getElementsByTagName("senderregarding")[0].firstChild.data;
	newSenderMessage = xmlDoc.getElementsByTagName("sendermessage")[0].firstChild.data;
	newSenderCC = xmlDoc.getElementsByTagName("sendercc")[0].firstChild.data;
	if(newSenderRegarding=='null'){newSenderRegarding='-';}
	if(newSenderCC=='true'){newSenderCC="<li class='scc'>*A copy of this message has been send to the email that you've provided.</li>"}
	else if(newSenderCC=='false'){newSenderCC=''}

	valueType = xmlDoc.getElementsByTagName("valuetype")[0].firstChild.data;
	result = xmlDoc.getElementsByTagName("result")[0].firstChild.data;
	fieldID = xmlDoc.getElementsByTagName("fieldid")[0].firstChild.data;
	fieldValue = xmlDoc.getElementsByTagName("fieldvalue")[0].firstChild.data;
	insertID = xmlDoc.getElementsByTagName("insertid")[0].firstChild.data;

	pageID = xmlDoc.getElementsByTagName("pageid")[0].firstChild.data;

	// find the HTML element that displays the error
	message = $('sender_failed');
	// show the error or hide the error
	message.className = (result == "0") ? "hidden" : "error";

	frmID = $('contactfrm');
	loaderID = $('sender_loader');

	switch(pageID)
	{
		case 'index':
			if(result!=0){
				//validation error occured
				loaderID.innerHTML='';
				loaderID.style.display='none';
				frmID.style.display='block';
				errorMessages(message, fieldID, result);
			}else if(result==0){
				//all ok
				loaderID.innerHTML='';
				loaderID.style.display='none';

				var sentEmail = new Element ('div', {
					'id': 'sentemail',
					'html': "<div id='secb'><img src='./layout/images/closebutttransparent.png' id='sentemailclosebutton' title='Close sent email' alt='close sent email'/></div><div id='sentemailbanner'>Your message has been sent successfully</div><ul id='sentemailcontent'><li class='sname'>Name: <span class='green'>"+newSenderName+"</span></li><li class='semail'>E-Mail: <span class='green'>"+newSenderEmail+"</span></li><li class='sregarding'>Regarding: <span class='green'>"+newSenderRegarding+"</span></li><li class='smessage'>Message: <div id='sentemailmessage'>"+nl2br(newSenderMessage)+"</div></li>"+newSenderCC+"</ul>"
				});
				$('sentemailanchor').appendChild(sentEmail);

				$('sentemailclosebutton').addEvent('click',function(e)
				{e.stop();
					$('sentemail').dispose();
					$('sender_name').value='[type your name][required]';
					$('sender_email').value='[type your email][required]';
					$('sender_regarding').value='[regarding][not required]';
					$('sender_message').value='[type your message][required]';
					$('scounter').innerHTML=contactMessageMaxLength;
					frmID.style.display='block';
				});
			}
			break;
		default:
			break;
	}//switch

	sendXMLRequestValidateNsubmit('multipleValues');
}//readResponseValidateNsubmitMultipleValues()

//errorMessages()
function errorMessages(element, fieldID, errorCode)
{
	var $errVals = new Array();
	$errVals[101] = "Please type a "+fieldID+".";
	$errVals[102] = "Please type a shorter "+fieldID+".";
	$errVals[103] = "Please type a valid "+fieldID+".";
	$errVals[104] = "This "+fieldID+" already exists.";

	$errVals[201] = "This "+fieldID+" already exists in this category.";
	$errVals[202] = "An image with this "+fieldID+" already exists.";
	$errVals[205] = "Please name your new category first.";

	element.innerHTML = $errVals[errorCode];
}//errorMessages(element, fieldID, errorCode)
