<?php
	###################################################################################
	header("Expires: Thu, 17 May 2001 10:17:17 GMT");    // Date in the past
  	header ("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT"); // always modified
	header ("Cache-Control: no-cache, must-revalidate");  // HTTP/1.1
	header ("Pragma: no-cache");                          // HTTP/1.0
	header ("Content-type: text/html; charset=utf-8");
	###################################################################################

	session_start(); //start session
	session_regenerate_id(true); //regenerate session id
	//regenerate session id if PHP version is lower thatn 5.1.0
	if(!version_compare(phpversion(),"5.1.0",">=")){ setcookie( session_name(), session_id(), ini_get("session.cookie_lifetime"), "/" );}

	require("./dchincfunctions/functionsinc.php");
	//checkCookiesAvailability('');

	$csrf_password_generator = hash('sha256', "index").CSRF_PASS_GEN;
	if (isset($_GET["flg"])) {$flg = $_GET["flg"];}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>dimitrios chantzis</title>
<script type="text/javascript" src="./scripts/mootools/mootools.js"></script>
<script type="text/javascript" src="./scripts/commonajaxfunctionsinc.js"></script>
<script type="text/javascript" src="./scripts/commonfunctionsinc.js"></script>
<script type="text/javascript" src="./scripts/index.js"></script>
<script type="text/javascript" src="./scripts/thw.js"></script>
<script type="text/javascript" src="./scripts/initalertinc.js"></script>
<script type="text/javascript" src="./scripts/validatensubmitinc.js"></script>
<script type="text/javascript" src="./scripts/php.js"></script>
<style type="text/css" media="screen">
	@import url(./layout/css/index.css);
</style>
<link rel="stylesheet" rev="stylesheet" href="./layout/css/printout.css" type="text/css" media="print" />
<style type="text/css">
#sidebar {
	/* Netscape 4, IE 4.x-5.0/Win and other lesser browsers will use this */
  position:absolute;left:0;top:0;width:100%;height:79px;z-index:100;;
}
body > div#sidebar {
  /* used by Opera 5+, Netscape6+/Mozilla, Konqueror, Safari, OmniWeb 4.5+, iCab, ICEbrowser */
  position: fixed;
}
</style>
<!--[if gte IE 5.5]>
<![if lt IE 7]>
<style type="text/css">
div#sidebar {
  /* IE5.5+/Win - this is more specific than the IE 5.0 version */
	left: expression( ( 0 + ( ignoreMe2 = document.documentElement.scrollLeft ? document.documentElement.scrollLeft : document.body.scrollLeft ) ) + 'px' );
	top: expression( ( 0 + ( ignoreMe = document.documentElement.scrollTop ? document.documentElement.scrollTop : document.body.scrollTop ) ) + 'px' );
	height:80px;
	width:100%
}
</style>
<![endif]>
<![endif]-->
</head>

<body class='index'>
	<div id='wrapper'>
    	<!--<div id='topline'></div>-->
    	<div id='inkstain01'></div>
        <div id='inkstain02'></div>
        <div id='sidebar'>
        	<div id='mainbanner'><img id='mainbannerlogo' src='./layout/images/dchlogo_v.png' alt='dimitrios chantzis' /></div>
            <ul id='navigation'>
            	<li id='lastupdated'>Last Updated: <span class='green'>20.05.09</span></li>
                <li class='separator'></li>
                <li class='email'>
                	<a href='mailto:info@dimitrioschantzis.com' title='Email me' class='emailme'>
                    info <br />
                    <span class='green'>at</span> <br />
                    dimitrioschantzis <br />
                    <span class='green'>dot</span> <br />
                	</a>
                </li>
                <li class='separator'></li>
                <li id='homelink'><a href='#homesectionanchor' id='home' class='mainnavi' title='Home Section'>Home</a></li>
                <li id='cvlink'><a href='#cvsectionanchor' id='cv' class='mainnavi' title='Curriculum Vitae'>C.V.</a></li>
                <li id='worklink'><a href='#worksectionanchor' id='work' class='mainnavi' title='Selected Work'>My Work</a></li>
                <li id='contactlink'><a href='#contactsectionanchor' id='contact' class='mainnavi' title='Contact Me'>Contact Me</a></li>
            </ul>
            <!--<span id='printbutton'><img src='./layout/images/print.gif' alt='print button' title='Print Portfolio'/></span>-->
        	<ul id='sectionbanners'>
            	<li id='sb_home'><img src='./layout/images/homesectionbanner.png' alt='home section'></li>
            	<li id='sb_cv'><img src='./layout/images/cvsectionbanner.png' alt='cv section'></li>
                <li id='sb_mywork'><img src='./layout/images/myworksectionbanner.png' alt='work section'></li>
                <li id='sb_contactme'><img src='./layout/images/contactmesectionbanner.png' alt='contact section'></li>
            </ul>
        </div>
        <div id='reallybigline'><div id='logo'><img src='./layout/images/dchlogoblack.png' alt='dimitrios chantzis'/></div></div>
        <div id='content'>
            <a name='homesectionanchor' id='homesectionanchor' class='anchors'>+</a>
        	<div class='sections' id='homesection'>
            	<span clas='sectiontitle'>[home]</span>
                <div id='welcometext'>Welcome to my porfolio!</div>
                <div id='gotocv'><a href='#cvsectionanchor' class='secnavi' title='Go to C.V.'>next</a></div>
          </div>
            <div class='buffer'>&nbsp;<div id='inkstain05'></div></div>
            <a name='cvsectionanchor' id='cvsectionanchor' class='anchors'>+</a>
        	<div class='sections' id='cvsection'>
                <span clas='sectiontitle'>[c.v.]</span>
            	<div id='inkstain03'></div>
                <div id='cvtext'>
                	you can download my c.v. from
                    <a href='http://dchantzis-v4.nfshost.com/dimitrios_chantzis_resume.pdf' class='secnavi' title='English C.V.' target='_blank'>here</a><span class='language'></span>
                </div>
                <div id='gotohome'><a href='#homesectionanchor' class='secnavi' title='Go to Home'>back</a></div>
                <div id='gotowork'><a href='#worksectionanchor' class='secnavi' title='Go to My Work'>next</a></div>
          </div>
            <div class='buffer'>&nbsp;<div id='inkstain06'></div></div>
            <a name='worksectionanchor' id='worksectionanchor' class='anchors'>+</a>
            <div class='sections' id='worksection'>
            	<span class='sectiontitle'>[my work]</span>
            	<div id='inkstain04'></div>
                <div id='inkstain08'></div>
                <div id='inkstain09'></div>
                <div id='inkstain10'></div>
                <div id='inkstain11'></div>
                <div id='inkstain13'></div>
                <a id='dimitrioschantzis' class='anchors'></a>
				<ul class='selectedwork' id='dimitrioschantzis'>
                    <li class='subnavigation'>
                    	<a href='#cvsectionanchor' class='secnavi' title='Go to C.V.'>back</a>
                    	<a href='#jamesdoev3anchor' class='secnavi' title='Go to My Next Work'>next</a>
                    </li>
					<li class='thumbnail'><img src='./layout/images/dimitrioschantzis/dimitrioschantzis.png' title='thumbnail'/></li>
                	<li class='title'>Dimitrios Chantzis Projects Portfolio</li>
                    <li class='year'>Year: <span class='green'>2009</span></li>
                    <li class='client'><span class='green'>Personal Website</span></li>
                    <li class='line'></li>
                    <li class='technologies'>technologies: <span>XHTML, PHP, AJAX, CSS</span></li>
                    <li class='description'>This website!!</li>
                    <li class='urls'>Git repository available: <a href="https://github.com/dchantzis/dchantzis-v1">here</a></li>
                    <li class='urls'>Current version available: <a href='http://www.dimitrioschantzis.com' title='Go to dimitrioschantzis.com' target='_blank'>here</a></li>
                    <li class='screenshots'></li>
                </ul>
                <a id='jamesdoev3anchor' class='anchors'>+</a>
				<ul class='selectedwork' id='jamesdoev3'>
                    <li class='subnavigation'>
                       <a href='#worksectionanchor' class='secnavi' title='Go to My Previous Work'>back</a>
                       <a href='#paperreviewanchor' class='secnavi' title='Go to My Next Work'>next</a>
                    </li>
					<li class='thumbnail'><img src='./layout/images/jamesdoeversion3/jamesdoeversion3.png' title='thumbnail'/></li>
                	<li class='title'>James Doe: Portfolio (Version 3.0)</li>
                    <li class='year'>year: <span class='green'>2009</span></li>
                    <li class='client'><span class='green'>Personal Website</span></li>
                    <li class='line'></li>
                    <li class='technologies'>technologies: <span>XHTML, PHP, AJAX (Mootools library), CSS, XML, MySql</span></li>
                    <li class='description'>
                    	Web application for the display of illustrations and other images in general.
                        Visitors of this site can view images, browse images by their tags and read the site's blog, as well as add comments to the blog entries.
 						<br />
                        The system features an site managing mode, where the administrator can:
                        <ul>
                        	<li>Create, update and delete image <b>categories</b> that will store all the site's albums.</li>
                            <li>Create, update and delete image <b>albums</b>. Each on can be transferred to a different category. These albums will store all the site's images.</li>
                            <li>Upload, delete <b>images</b> to each album and edit their information. Each image can be transferred to a different album. Images can be tagged.</li>
                            <li>Create, update and delete blog <b>posts</b>, and upload images to each of them. The administrator can also add and delete blog comments.</li>
                        	<li>Edit his personal information page.</li>
                            <li>Select which albums will be visible to visitors.</li>
                        </ul>
                       	<br />
                    	The system also includes an action log where all the users actions are recorded, as well as a notifier for new comments.
                        <br />
                        This application also demonstrates ways of securing a web
application according to the instructions provided by the OWASP (Open Web Application
Security Project) community and carefully designed algorithms.
						<br /><br />
                        This system has no relation to its previous versions (<a href='#jamesdoev2anchor' title='Go to Version 2.0'>here</a> and <a href='#jamesdoev1anchor' title='Go to Version 1.0'>here</a>)
                    </li>
                    <li class='urls'>Git repository available: <a href='https://github.com/dchantzis/jamesdoe-v3' title='Go to Version 3.0' target='_blank'>here</a></li>
                    <li class='urls'>Website available: <a href='http://jamesdoe-v3.nfshost.com' title='Go to Version 3.0' target='_blank'>here</a></li>
                    <li class='urls'>Current version available: <a href='http://www.jamesdoe.com' title='Go to jamesdoe.com' target='_blank'>here</a></li>
                    <li class='screenshots'></li>
                </ul>
                <a id='paperreviewanchor' class='anchors'>+</a>
				<ul class='selectedwork' id='paperreview'>
                    <li class='subnavigation'>
                    	<a href='#jamesdoev3anchor' class='secnavi' title='Go to My Previous Work'>back</a>
                        <a href='#jamesdoev2anchor' class='secnavi' title='Go to My Next Work'>next</a>
                    </li>
					<li class='thumbnail'><img src='./layout/images/paperreview/paperreview.png' title='thumbnail'/></li>
                	<li class='title'>Conference Management Web Application (PapersReview)</li>
                    <li class='year'>Year: <span class='green'>2008</span></li>
                    <li class='client'><span class='green'>Dissertation</span></li>
                    <li class='line'></li>
                    <li class='technologies'>technologies: <span>XHTML, PHP, AJAX, CSS, MySql, UML</span></li>
                    <li class='description'>
                    Web application for the review and administration of the
submission process of conference papers. The application specializes in importing papers,
their review by an assigned committee, and ultimately the selection of which will be
included in each conference. This application also demonstrates ways of securing a web
application according to the instructions provided by the OWASP (Open Web Application
Security Project) community and carefully designed algorithms.
					<br /><br />
                    The system also includes an action log where all the users actions are recorded.
                    </li>
                    <li class='urls'>
                        Abstract:
                        	<a href='http://paperreview.nfshost.com/files/paperreview_abstract_english.pdf' title='Abstract in English' target='_blank'>english</a>
                        <br />
                        Documentation:
                        	<a href='http://paperreview.nfshost.com/files/paperreview_greek.pdf' title='Documentation in Greek' target='_blank'>greek</a>
                        <br />
                        PowerPoint Presentation:
                        	<a href='http://paperreview.nfshost.com/files/paperreview_presentation_greek.pdf' title='PowerPoint Presentation in Greek' target='_blank'>greek</a>
                        <br />
                        Supervising professor:
                        	<a href='mailto:asidirop@csd.auth.gr' title='Email supervising professor' target='_blank'>Antonis Sidiropoulos</a>
                        <br />
                        The system is temporarily accessible at:
                            <a href='http://paperreview.nfshost.com' title='Got to PaperReview' target='_blank'>here</a>
                        <br />
                    </li>
                    <li class='urls'>
                        <li class='urls'>Git repository available: <a href='https://github.com/dchantzis/paperreview' title='Go to Version 3.0' target='_blank'>here</a></li>
                    </li>
                    <li class='screenshots'></li>
                </ul>
                <a id='jamesdoev2anchor' class='anchors'>+</a>
				<ul class='selectedwork' id='jamesdoev2'>
                	<li class='subnavigation'>
                    	<a href='#paperreviewanchor' class='secnavi' title='Go to My Previous Work'>back</a>
                        <a href='#evolutionaryalgorithmanchor' class='secnavi' title='Go to My Next Work'>next</a>
                    </li>
					<li class='thumbnail'><img src='./layout/images/jamesdoeversion2/jamesdoeversion2.png' title='thumbnail'/></li>
                	<li class='title'>James Doe: The Online Sketchbook (Version 2.0)</li>
                    <li class='year'>Year: <span class='green'>2006</span></li>
                    <li class='client'><span class='green'>Personal Website</span></li>
                    <li class='line'></li>
                    <li class='technologies'>technologies: <span>HTML, PHP, JavaScript, CSS, MySQL</span></li>
                    <li class='description'>
                    	Web application for the display of illustrations and other images in general.
                        Visitors of this site can view images and add comments for each of them.
 						<br />
                        The system features an site managing mode, where the administrator can:
                        <ul>
                        	<li>Upload, delete <b>images</b> to each album and edit their informations.</li>
                            <li>Create, update and delete site <b>updates</b>.</li>
                            <li>Edit, delete and add image <b>comments</b>.</li>
                        </ul>
                        <br/><br/>
                        This version is the same as  <a href='#jamesdoev1anchor' title='Go to Version 1.0'>Version 1.0</a>, but with different layout.
                    </li>
                    <li class='urls'>
                    	Site available: <a href='http://jamesdoe-v2.nfshost.com' title='Go to Version 2.0'>here</a>
                        <br />
                        Current site version: <a href='http://www.jamesdoe.com' title='Go to Version 5.0'>here</a>
                    </li>
                    <li class='urls'>Git repository available: <a href='https://github.com/dchantzis/jamesdoe-v2' title='Go to Version 2.0' target='_blank'>here</a></li>
                    <li class='screenshots'></li>
                </ul>
                <a id='evolutionaryalgorithmanchor' class='anchors'>+</a>
				<ul class='selectedwork' id='evolutionaryalgorithm'>
                    <li class='subnavigation'>
                    	<a href='#jamesdoev2anchor' class='secnavi' title='Go to My Previous Work'>back</a>
                        <a href='#neurofuzzysystemanchor' class='secnavi' title='Go to My Next Work'>next</a>
                    </li>
					<li class='thumbnail'><img src='./layout/images/evalutionaryalgorithms/evolutionaryalgorithms.png' title='thumbnail'/></li>
                	<li class='title'>Evolutionary Algorithms</li>
                    <li class='year'>year: <span class='green'>2005</span></li>
					<li class='client'>Second project for semester course <b><i>"Intelligent Systems"</i></b>.</li>
                    <li class='line'></li>
                    <li class='technologies'>technologies: <span>JAVA</span></li>
                    <li class='description'>
                    	Evolutionary algorithm that solves the problem of moving a number of files from a location to a hard disk drive and achieving the lowest free disk space in that hard drive (<i>meaning moving as many files as possible</i>).
                    </li>
                    <li class='urls'>
                    	Documentation: <a href='https://github.com/dchantzis/evolutionary-algorithms/blob/master/evolutionaryalgorithms%5Bgreek%5D.pdf' title='Documentation in Greek' target='_blank'>greek</a>
                        <br />
                        PowerPoint Presentation: <a href='https://github.com/dchantzis/evolutionary-algorithms/blob/master/evolutionaryalgorithms%5Bgreek%5D.pps' title='PowerPoint Presentation in Greek' target='_blank'>greek</a>
                    	<br />
                        Git repository available: <a href='https://github.com/dchantzis/evolutionary-algorithms' title='Download source code' target='_blank'>here</a>
                    </li>
                    <li class='screenshots'></li>
                </ul>
                <a id='neurofuzzysystemanchor' class='anchors'>+</a>
				<ul class='selectedwork' id='neurofuzzysystem'>
                    <li class='subnavigation'>
                    	<a href='#evolutionaryalgorithmanchor' class='secnavi' title='Go to My Previous Work'>back</a>
                    	<a href='#3dmansionanchor' class='secnavi' title='Go to My Next Work'>next</a>
                    </li>
					<li class='thumbnail'><img src='./layout/images/neurofuzzy/neurofuzzy.png' title='thumbnail'/></li>
                	<li class='title'>Iris Classification Neuro-Fuzzy System</li>
                    <li class='year'>Year: <span class='green'>2005</span></li>
                    <li class='client'>First project for semester course <b><i>"Intelligent Systems"</i></b>.</li>
                    <li class='line'></li>
                    <li class='technologies'>technologies: <span>MatLab ANFIS library</span></li>
                    <li class='description'>Implementation of a neuro-fuzzy system for iris classification.</li>
                    <li class='urls'>
                    	Documentation: <a href='https://github.com/dchantzis/neuro-fuzzy-iris-classification/blob/master/neurofuzzy%5Bgreek%5D.pdf' title='Documentation in Greek' target='_blank'>greek</a>
                        <br />
                        PowerPoint Presentation: <a href='https://github.com/dchantzis/neuro-fuzzy-iris-classification/raw/master/neurofuzzy%5Bgreek%5D.pps' title='PowerPoint Presentation in Greek' target='_blank'>greek</a>
                    </li>
                    <li class="urls">
                        Git repository available: <a href='https://github.com/dchantzis/neuro-fuzzy-iris-classification' title='Download source code' target='_blank'>here</a>
                    </li>
                    <li class='screenshots'></li>
                </ul>
                <a id='3dmansionanchor' class='anchors'>+</a>
				<ul class='selectedwork' id='3dmansion'>
                    <li class='subnavigation'>
                    	<a href='#neurofuzzysystemanchor' class='secnavi' title='Go to My Previous Work'>back</a>
                        <a href='#jamesdoev1anchor' class='secnavi' title='Go to My Next Work'>next</a>
                    </li>
					<li class='thumbnail'><img src='./layout/images/3dgraphics/3dgraphics.png' title='thumbnail'/></li>
                	<li class='title'>3D Mansion</li>
                    <li class='year'>Year: <span class='green'>2005</span></li>
                    <li class='client'>Semester project for course <b><i>"Computer Graphics"</i></b>.</li>
                    <li class='line'></li>
                    <li class='technologies'>technologies: <span>Microstation '95</span></li>
                    <li class='description'>3D design and render of a mansion in a small landscape, as well as creating a virtual tour in that landscape.</li>
                    <li class='urls'>
                    	View:
                        	<a href='https://vimeo.com/14961091' title='View video 1 (phong-antialias)' target='_blank'>video 1</a>
                            <a href='https://vimeo.com/14961305' title='View video 2  (phong-antialias with sky)' target='_blank'>video 2</a>
                    </li>
                    <li class='screenshots'>
                       <a href='./layout/images/3dgraphics/fullsize/01.png'><img src='./layout/images/3dgraphics/thumbs/01.png' alt='screenshot 01' title='Screenshot 01' /></a>
                       <a href='./layout/images/3dgraphics/fullsize/02.png'><img src='./layout/images/3dgraphics/thumbs/02.png' alt='screenshot 02' title='Screenshot 02' /></a>
                       <a href='./layout/images/3dgraphics/fullsize/03.png'><img src='./layout/images/3dgraphics/thumbs/03.png' alt='screenshot 03' title='Screenshot 03' /></a>
                       <a href='./layout/images/3dgraphics/fullsize/04.png'><img src='./layout/images/3dgraphics/thumbs/04.png' alt='screenshot 04' title='Screenshot 04' /></a>
                       <a href='./layout/images/3dgraphics/fullsize/05.png'><img src='./layout/images/3dgraphics/thumbs/05.png' alt='screenshot 05' title='Screenshot 05' /></a>
                       <a href='./layout/images/3dgraphics/fullsize/06.png'><img src='./layout/images/3dgraphics/thumbs/06.png' alt='screenshot 06' title='Screenshot 06' /></a>
                    </li>
                </ul>
                <a id='jamesdoev1anchor' class='anchors'>+</a>
				<ul class='selectedwork' id='jamesdoev1'>
                    <li class='subnavigation'>
                        <a href='#3dmansionanchor' class='secnavi' title='Go to My Previous Work'>back</a>
                        <a href='#megacomicbooksanchor' class='secnavi' title='Go to My Next Work'>next</a>
                    </li>
					<li class='thumbnail'><img src='./layout/images/jamesdoeversion1/jamesdoeversion1.png' title='thumbnail'/></li>
                	<li class='title'>James Doe: The Online Sketchbook (Version 1.0)</li>
                    <li class='year'>year: <span class='green'>2005</span></li>
                    <li class='client'><span class='green'>Personal Website</span></li>
                    <li class='line'></li>
                    <li class='technologies'>technologies: <span>HTML, ASP, JavaScript, MS-Access</span></li>
                    <li class='description'>
                    	Web application for the display of illustrations and other images in general.
                        Visitors of this site can view images and add comments for each of them.
 						<br />
                        The system features an site managing mode, where the administrator can:
                        <ul>
                        	<li>Upload, delete <b>images</b> to each album and edit their informations.</li>
                            <li>Create, update and delete site <b>updates</b>.</li>
                            <li>Edit, delete and add image <b>comments</b>.</li>
                        </ul>
                    </li>
                    <li class='urls'>
                    	Site available: <a href='http://jamesdoe-v1.nfshost.com' title='Go to Version 1.0' target='_blank'>here</a> (not updated any more)
                        <br />
                        Current site version: <a href='http://www.jamesdoe.com' title='Go to Version 5.0'>here</a>
                    </li>
                    <li class="urls">
                        Git repository available: <a href='https://github.com/dchantzis/jamesdoe-v1' title='Go to Version 3.0' target='_blank'>here</a>
                    </li>
                    <li class='screenshots'></li>
                </ul>
                <a id='megacomicbooksanchor' class='anchors'>+</a>
				<ul class='selectedwork' id='megacomicbooks'>
                    <li class='subnavigation'>
                        <a href='#jamesdoev1anchor' class='secnavi' title='Go to My Previous Work'>back</a>
                        <a href='#cinemacustomersmanagingsystemanchor' class='secnavi' title='Go to My Next Work'>next</a>
                    </li>
					<li class='thumbnail'><img src='./layout/images/megacomicbooks/megacomicbooks.png' title='thumbnail'/></li>
                	<li class='title'>Mega comic books</li>
                    <li class='year'>year: <span class='green'>2005</span></li>
                    <li class='client'>Semester project for course <b><i>"Special Issues On Data Bases"</i></b>.</li>
                    <li class='line'></li>
                    <li class='technologies'>technologies: <span>HTML, PHP, JavaScript, CSS, PostgreSql/MySql</span></li>
                    <li class='description'>
                        <b>Motivation:</b>
                        The design of a comic book store database for the “Mega Comic Books” store and the implementation of a web interface to that database. “Mega Comics Books” is a fictional small comic book store that needs a small RDBMS to keep track of its monthly orders-subscriptions.
                    </li>
                    <li class='screenshots'></li>
                    <li class='urls'>
                    	System description: <a href='http://mega-comic-books.nfshost.com/files/megacomicbookssystemdescription.pdf' title='Download system description in English' target='_blank'>english</a>
                        <br />
                        Database E.R. diagram: <a href='http://mega-comic-books.nfshost.com/files/megacomicbooksdberdiagram.pdf' title='Download E.R. diagram' target='_blank'>here</a>
                    	<br />
                        Create database SQL: <a href='http://mega-comic-books.nfshost.com/files/megacomicbooksdb.pdf' title='Download database sql' target='_blank'>here</a>
                        <br />
                        Database SQL insert queries: <a href='http://mega-comic-books.nfshost.com/files/megacomicbookssqlqueries.pdf' title='Download sql insert queries' target='_blank'>here</a>
                        <br />
                        Database entries print-outs:
                        	<a href='http://mega-comic-books.nfshost.com/files/megacomicbooksdbprintouts1.pdf' title='Download entries print-outs' target='_blank'>here</a> and
                    		<a href='http://mega-comic-books.nfshost.com/files/megacomicbooksdbprintouts2.pdf' title='Download entries print-outs' target='_blank'>here</a>
                    	<br />
                        <br />
                        Site available here: <a href='http://mega-comic-books.nfshost.com' title='Go to MegaComicBooks' target='_blank'>here</a>
                    </li>
                    <li class='urls'>
                        Git repository available: <a href='https://github.com/dchantzis/mega-comic-books' title='' target='_blank'>here</a>
                    </li>
                </ul>
                <!--
                <a id='travelagentfinderanchor' class='anchors'>+</a>
				<ul class='selectedwork' id='travelagentfinder'>
                    <li class='subnavigation'>
                        <a href='#megacomicbooksanchor' class='secnavi' title='Go to My Previous Work'>back</a>
                        <a href='#cinemacustomersmanagingsystemanchor' class='secnavi' title='Go to My Next Work'>next</a>
                    </li>
					<li class='thumbnail'><img src='./layout/images/defaultthumbnail.png' title='thumbnail'/></li>
                	<li class='title'>Travel Agent Finder</li>
                    <li class='year'>year: <span class='green'>2005</span></li>
                    <li class='client'></li>
                    <li class='line'></li>
                    <li class='technologies'>technologies: <span>HTML, ASP, JavaScript, CSS, MS-Access, UML</span></li>
                    <li class='description'>Vivamus sit amet dui nisl, eu adipiscing nisl. In accumsan risus eget sem tincidunt faucibus. Aliquam erat volutpat. Duis rhoncus vehicula eros. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent auctor hendrerit sem at tincidunt. Nulla facilisi. Quisque eu tellus ac felis lacinia adipiscing et in mi. Curabitur faucibus laoreet sagittis. Fusce erat purus, sollicitudin ut condimentum ut, pellentesque elementum velit. Quisque id nunc ac mauris auctor aliquet.</li>
                    <li class='urls'></li>
                    <li class='screenshots'></li>
                </ul>
                -->
                <a id='cinemacustomersmanagingsystemanchor' class='anchors'>+</a>
				<ul class='selectedwork' id='cinemacustomersmanagingsystem'>
                	<li class='subnavigation'>
                        <a href='#megacomicbooksanchor' class='secnavi' title='Go to My Previous Work'>back</a>
                        <a href='#ealertsanchor' class='secnavi' title='Go to My Next Work'>next</a>
                    </li>
					<li class='thumbnail'><img src='./layout/images/cinemaproject/cinemaproject.png' title='thumbnail'/></li>
                    <li class='title'>Cinema customers managing system</li>
                    <li class='year'>year: <span class='green'>2005</span></li>
                    <li class='client'>Semester project for course <b><i>"Applications Development & Management"</i></b>.</li>
                    <li class='line'></li>
                    <li class='technologies'>technologies: <span>UML, JAVA-Swing, MS-Access</span></li>
                    <li class='description'>
                    	System that manages the customers of a cinema, where customers:
                        <ul>
                        	<li>Reserve a number of seats for a movie.</li>
                            <li>Cancel their reservations.</li>
                            <li>Buy tickets of their reserved seats.</li>
                            <li>Buy tickets on the spot without reservations, it there are seats available.</li>
                        </ul>
                    </li>
                    <li class='urls'>
                    	Documentation: <a href='https://github.com/dchantzis/cinema-project/blob/master/cinema-project%5Bgreek%5D.pdf' title='Documentation in Greek' target='_blank'>greek</a>
                    </li>
                    <li class='urls'>
                        Git repository <a href='https://github.com/dchantzis/cinema-project' title='Download system' target='_blank'>here</a>
                    </li>
                    <li class='screenshots'>
                       <a href='./layout/images/cinemaproject/fullsize/01mainform.png' target='_blank'><img src='./layout/images/cinemaproject/thumbs/01mainform.png' alt='screenshot 01' title='Screenshot 01' /></a>
                       <a href='./layout/images/cinemaproject/fullsize/02newreservation.png' target='_blank'><img src='./layout/images/cinemaproject/thumbs/02newreservation.png' alt='screenshot 02' title='Screenshot 02' /></a>
                       <a href='./layout/images/cinemaproject/fullsize/03createnewreservation.png' target='_blank'><img src='./layout/images/cinemaproject/thumbs/03createnewreservation.png' alt='screenshot 03' title='Screenshot 03' /></a>
                       <a href='./layout/images/cinemaproject/fullsize/04newreservationcreated.png' target='_blank'><img src='./layout/images/cinemaproject/thumbs/04newreservationcreated.png' alt='screenshot 04' title='Screenshot 04' /></a>
                       <a href='./layout/images/cinemaproject/fullsize/05cancelreservation.png' target='_blank'><img src='./layout/images/cinemaproject/thumbs/05cancelreservation.png' alt='screenshot 05' title='Screenshot 05' /></a>
                       <a href='./layout/images/cinemaproject/fullsize/06deletecancelreservation.png' target='_blank'><img src='./layout/images/cinemaproject/thumbs/06deletecancelreservation.png' alt='screenshot 06' title='Screenshot 06' /></a>
                       <a href='./layout/images/cinemaproject/fullsize/07displayreservations.png' target='_blank'><img src='./layout/images/cinemaproject/thumbs/07displayreservations.png' alt='screenshot 07' title='Screenshot 07' /></a>
                       <a href='./layout/images/cinemaproject/fullsize/08followupquestiongenerateticketsfromreservation.png' target='_blank'><img src='./layout/images/cinemaproject/thumbs/08followupquestiongenerateticketsfromreservation.png' alt='screenshot 08' title='Screenshot 08' /></a>
                       <a href='./layout/images/cinemaproject/fullsize/08generateticketsfromreservation.png' target='_blank'><img src='./layout/images/cinemaproject/thumbs/08generateticketsfromreservation.png' alt='screenshot 09' title='Screenshot 09' /></a>
                       <a href='./layout/images/cinemaproject/fullsize/09followupquestiongeneratetickets.png' target='_blank'><img src='./layout/images/cinemaproject/thumbs/09followupquestiongeneratetickets.png' alt='screenshot 10' title='Screenshot 10' /></a>
                       <a href='./layout/images/cinemaproject/fullsize/09generatetickets.png' target='_blank'><img src='./layout/images/cinemaproject/thumbs/09generatetickets.png' alt='screenshot 11' title='Screenshot 11' /></a>
                    </li>
                 </ul>
                 <a id='ealertsanchor' class='anchors'>+</a>
				<ul class='selectedwork' id='ealerts'>
                    <li class='subnavigation'>
                        <a href='#cinemacustomersmanagingsystemanchor' class='secnavi' title='Go to My Previous Work'>back</a>
                        <a href='#onlineauctionsmanagingsystemanchor' class='secnavi' title='Go to My Next Work'>next</a>
                    </li>
					<li class='thumbnail'><img src='./layout/images/ealerts/ealerts.png' title='thumbnail'/></li>
                	<li class='title'>E-Alerts: Web Notifier</li>
                    <li class='year'>Year: <span class='green'>2005</span></li>
                    <li class='client'>Semester project for course <b><i>"Electronic Commerce"</i></b>.</li>
                    <li class='line'></li>
                    <li class='technologies'>technologies: <span>HTML, ASP, JavaScript, MS-Access</span></li>
                    <li class='description'>
                    	Web application that manages calendar reminders and notifies the users that created them.<br />
                        The system features function that allow each user to:
                        <ul>
                        	<li>Create a new account.</li>
                            <li>Retrieve password information, if they need.</li>
                            <li>Create 3 types of reminders: <b><i>"meeting"</i></b>, <b><i>"birthday"</i></b> and <b><i>"custom reminder"</i></b>. These reminders are placed in a personal system calendar.</li>
                            <li>View and edit calendar entries.</li>
                        </ul>
                    </li>
                    <?php /*<li class='urls'>PowerPoint Presentation: <a href='./files/ealerts[greek].pps' title='PowerPoint Presentation in Greek' target='_blank'>greek</a></li>*/ ?>
                	<li class='screenshots'></li>
                </ul>
                <a id='onlineauctionsmanagingsystemanchor' class='anchors'>+</a>
            	<ul class='selectedwork' id=''>
                    <li class='subnavigation'>
                        <a href='#ealertsanchor' class='secnavi' title='Go to My Previous Work'>back</a>
                        <a href='#contactsectionanchor' class='secnavi' title='Go to Contact Me'>next</a>
                    </li>
					<li class='thumbnail'><img src='./layout/images/onlineauctionsmanagingsystem/onlineauctionsmanagingsystem.png' title='thumbnail'/></li>
                	<li class='title'>Online auctions managing system</li>
                    <li class='year'>year: <span class='green'>2004</span></li>
                    <li class='client'>Semester project for course <b><i>"Programming Methodologies II"</i></b>.</li>
                    <li class='line'></li>
                    <li class='technologies'>technologies: <span>UML</span></li>
                    <li class='description'>
                    	UML study of an online system that manages auctions. This study contains:
                        <ul>
                        	<li>Use case diagram of the system actors and the use cases they interact with.</li>
                            <li>
                            	Analytical descriptions of 4 main use cases, such as:
                            	<b><i>"New user registration"</i></b>,
                                <b><i>"User login"</i></b>,
                                <b><i>"Creating new auction"</i></b>,
                                <b><i>"New offer/Instant buy"</i></b>.
                            </li>
                            <li>Activity, sequence and collaboration diagrams for these 4 use cases.</li>
                            <li>Class diagram of the system.</li>
                        </ul>
                    </li>
                    <li class='urls'>
                    	Documentation: <a href='https://github.com/dchantzis/online-auctions-managing-system/blob/master/online-auction-managing-system%5Bgreek%5D.pdf' title='Documentation in Greek' target='_blank'>greek</a>
                    </li>
                    <li class='urls'>
                        Git repository: <a href='https://github.com/dchantzis/online-auctions-managing-system' title='' target='_blank'>here</a>
                    </li>
                    <li class='screenshots'></li>
                </ul>
			</div>
            <div class='buffer'>&nbsp;<div id='inkstain07'></div></div>
            <a name='contactsectionanchor' id='contactsectionanchor' class='anchors'>+</a>
            <div class='sections' id='contactsection'>
                <span clas='sectiontitle'>[contact me]</span>
                <div id='gowaybackhome'><a href='#homesectionanchor' class='secnavi' title='Go to Home'>home</a></div>
                <div id='contacttext'>
                    You can contact me at
                    	<span class='email'>
                        	<a href='mailto:info@dimitrioschantzis.com' title='Email me' class='emailme'>info <span class='green'>at </span>dimitrioschantzis <span class='green'>dot </span>com</a>
                        </span>
                    , or you can use the form on the right.
                    <br />
                    Whichever you use, I'll get the message...
                </div>
                <div id="alertcontent" class='hidden'><img src='./layout/images/closebutt.png' id='alertclosebutt' title='close alert' alt="close alert"/><div class='alertbanners'>warning</div><div id='alertmessage'></div></div>
          		<ul id='contactfrm'>
                    <li id='sender_failed' class='hidden'></li>
                    <li><input class='text' type='text' name='sender_name' id='sender_name' maxlength='40' value='[type your name][required]' /></li>
                    <li><input class='text' type='text' name='sender_email' id='sender_email' maxlength='70' value='[type your email][required]' /></li>
                    <li><input class='text' type='text' name='sender_regarding' id='sender_regarding' maxlength='100' value='[regarding][not required]' /></li>
                    <li><textarea class='text' name='sender_message' id='sender_message' cols='' rows=''>[type your message][required]</textarea></li>
                    <li class='charcounters'><span class='counters' id='scounter'><?=CONTACT_MESSAGE_MAX_LENGTH?></span> remaining characters</li>
                    <li><input type='checkbox' name='sender_cc' id='sender_cc' value='on' />Send CC to self [not required]</li>
                    <li><input class='button' type='submit' name='sender_send' id='sender_send' value='send' /></li>
              	</ul>
                <div id='sentemailanchor'></div>
              <span id='sender_loader' class='hidden'></span>
              <div id='inkstain12'></div>
                </div>
            <div class='sections' id='endsection'>
            	[the end]
            </div>
        </div>
    </div>
</div>
<span id='csrf' class='hidden'><?=$csrf_password_generator?></span>
</body>
</html>
