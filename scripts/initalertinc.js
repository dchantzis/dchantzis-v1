// JavaScript Document
/*
initialize help button and helpcontent.
can be used for every page with ONE help button
*/

window.addEvent('domready', 
	function(){
		$('alertcontent').style.visibility="hidden";
		$('alertclosebutt').addEvent('click', function(e)
		{
			e.stop();
			$('content').fade(1);
			$('alertcontent').fade(0);
		});
	}
);