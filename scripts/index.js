// JavaScript Document

var sectionBannerIDArr = new Array;
var sectionBannerSlideArr = new Array;
var preloadFlag = false;
var currentOpenSectionBannerSlider = '';
var contactMessageMaxLength = 2500;

window.addEvent('domready', function(){
	preloadImages();
	$('sender_name').addEvent('click',function(e){e.stop(); if($('sender_name').value=='[type your name][required]'){$('sender_name').value='';}});
	$('sender_email').addEvent('click',function(e){e.stop(); if($('sender_email').value=='[type your email][required]'){$('sender_email').value='';}});
	$('sender_regarding').addEvent('click',function(e){e.stop(); if($('sender_regarding').value=='[regarding][not required]'){$('sender_regarding').value='';}});
	$('sender_message').addEvent('click',function(e){e.stop(); if($('sender_message').value=='[type your message][required]'){$('sender_message').value='';}});
	$('sender_message').addEvent('focus',function(e){e.stop(); if($('sender_message').value=='[type your message][required]'){$('sender_message').value='';}});
	$('sender_message').addEvent('keyup',function(e){e.stop(); countChars('sender_message','scounter',contactMessageMaxLength);});
	$('sender_send').addEvent('click',function(e){e.stop(); alert("This is a demo site. To contact me please send an email the address: info@jamesdoe.com"); });
	//$('sender_send').addEvent('click',function(e){e.stop(); validateNsubmitMultipleValues(); });
	$('alertcontent').style.visibility="hidden";
	$('alertclosebutt').addEvent('click', function(e){e.stop(); $('sender_loader').fade(1); $('sender_loader').innerHTML=''; $('sender_loader').className='hidden'; $('alertcontent').className='hidden'; $('alertcontent').fade(0);});
	//$('printbutton').addEvent('click', function(e){e.stop(); if(window.print){window.print();}});
});
function newImage(arg)
{
	if (document.images) {
		rslt = new Image();
		rslt.src = arg;
		return rslt;
	}
}
function preloadImages()
{
	if (document.images) {
		homeSectionBanner = new Image(30,300);
		homeSectionBanner.src = "./layout/images/homesectionbanner.png";

		cvSectionBanner = new Image(30,300);
		cvSectionBanner.src = "./layout/images/cvsectionbanner.png";

		myWorkSectionBanner = new Image(30,300);
		myWorkSectionBanner.src = "./layout/images/myworksectionbanner.png";

		contactMeSectionBanner = new Image(30,300);
		contactMeSectionBanner.src = "./layout/images/contactmesectionbanner.png";

		siteBackGround = new Image(1024,768);
		siteBackGround.src = "./layout/images/background.gif";

		preloadFlag = true;
	}
}
function changeSectionBanner(sectionName)
{
	sectionName = String(sectionName);
	var sectionNameArr = sectionName.split('#');
	sectionName = sectionNameArr[1];
	var liID = '';
	switch(sectionName)
	{
		case 'homesectionanchor': liID+='home'; break;
		case 'cvsectionanchor': liID+='cv'; break;
		case 'worksectionanchor': liID+='mywork'; break;
		case 'contactsectionanchor': liID+='contactme'; break;
		default: liID+='mywork'; break;
	}
	if(liID != currentOpenSectionBannerSlider)
		{sectionBannersToggler(liID);}
}//changeSectionBanner
function initSectionBannersSliders()
{
	var liArr = $('sectionbanners').getElementsByTagName('li');
	var counter=0;
	var tempid, sectionBannerIDArrPointer, sbID;
	for (var i=0; i<liArr.length; i++){tempid=liArr[i].id.split('_'); if(tempid[0]=='sb'){sectionBannerIDArr[counter] = tempid[1]; counter++;}}
	for (var i=0; i<sectionBannerIDArr.length; i++)
	{
		sectionBannerIDArrPointer = i;
		sbID = sectionBannerIDArr[sectionBannerIDArrPointer];
		sectionBannerSlideArr[sbID] = new Fx.Slide('sb_'+sbID);
		sectionBannerSlideArr[sbID].hide();
	}//for
	sectionBannerSlideArr['home'].toggle();
	currentOpenSectionBannerSlider = 'home';
}//initSectionBannersSliders()
function sectionBannersToggler(sbID)
{
	for(var j=0; j<sectionBannerIDArr.length; j++)
		{ if(sectionBannerIDArr[j]!=sbID){ sectionBannerSlideArr[sectionBannerIDArr[j]].slideOut();} }
	sectionBannerSlideArr[sbID].toggle();
	currentOpenSectionBannerSlider = sbID;
}
