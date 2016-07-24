<?php
header("Expires: Mon, 26 Jul 1997 05:00:00 GMT"); // Date in the past
header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT"); // always modified 
header("Cache-Control: no-store, no-cache, must-revalidate"); // HTTP/1.1 
header("Cache-Control: post-check=0, pre-check=0", false); // HTTP/1.0 
header("Pragma: no-cache");

session_start();
if (isset ($_SESSION["username"])) {
    $uname = $_SESSION["username"];
}

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
    
    <meta http-equiv="pragma" content="no-cache" />
    <meta http-equiv="cache-control" content="no-cache" />
    <META HTTP-EQUIV="EXPIRES" CONTENT="0">
    <meta name="robots" content="noarchive">
    
    <link rel="stylesheet" type="text/css" href="Styles/stylesIndex-screen.css" />
    <script type="text/javascript" src="http://code.jquery.com/jquery-latest.js"></script>
    <link rel="stylesheet" href="Styles/TabStyles/flora.all.css" type="text/css" media="screen" />
    <script type="text/javascript" src="http://dev.jquery.com/view/tags/ui/latest/ui/ui.core.js"></script>
  	<script type="text/javascript" src="http://dev.jquery.com/view/tags/ui/latest/ui/ui.tabs.js"></script>
    
    <?php
    	include("Includes/unity.php");
    ?>
    
    <script language="javascript1.1" type="text/javascript">
		
		var xmlhttp = new getXMLObject();
		var time_variable;
		
		//Initialises Tabs
		$(document).ready(function() {
            
            $("#tabs > ul").tabs();

        });
 
		function getXMLObject()  //XML OBJECT
		{
   			var xmlHttp = false;
   			try {
     			xmlHttp = new ActiveXObject("Msxml2.XMLHTTP")  // For Old Microsoft Browsers
   			}
  			catch (e) {
     			try {
       				xmlHttp = new ActiveXObject("Microsoft.XMLHTTP")  // For Microsoft IE 6.0+
     			}
     			catch (e2) {
       				xmlHttp = false   // No Browser accepts the XMLHTTP Object then false
     			}
   			}
   			if (!xmlHttp && typeof XMLHttpRequest != 'undefined') {
     			xmlHttp = new XMLHttpRequest();        //For Mozilla, Opera Browsers
   			}
   			return xmlHttp;  // Mandatory Statement returning the ajax object created
		}
 
		function ajaxFunction(roomNum,posNum) {
  			var getdate = new Date();  //Used to prevent caching during ajax call
  			if(xmlhttp) {
    			xmlhttp.open("GET","paintingInfo.php?roomNum=" + roomNum + "&posNum=" + posNum,true);
    			xmlhttp.onreadystatechange  = handleServerResponse;
    			xmlhttp.send(null);
  			}
		}
 
		function handleServerResponse() {
  			if (xmlhttp.readyState == 4) {
     			if(xmlhttp.status == 200) {
       				document.getElementById("tab2").innerHTML = xmlhttp.responseText; //Update the HTML Form element 
     			}
     			else {
        			alert("Error during AJAX call. Please try again");
     			}
   			}
		}
        
        function openHelp () {
            var $tabs = $('#tabs').tabs(); // first tab selected

				$tabs.tabs('select', 2); // switch to second tab
        }
		
		
		//This funtion is called by Unity3D and loads the information for the specified painting from the database
		function displayPaintingInfo (paintingID) {
			
			var idSplit = new Array();
			var roomNo = "";
			var posNo = "";
			
			if(paintingID.length == 2) {
				idSplit = paintingID.split("",2);
				
				roomNo = idSplit[0];
				posNo = idSplit[1];
				
				ajaxFunction(roomNo,posNo);
				
				var $tabs = $('#tabs').tabs(); // first tab selected

				$tabs.tabs('select', 1); // switch to second tab
								
			}
			
			else {
				idSplit = paintingID.split("",3);
				
				roomNo = idSplit[0];
				posNo = idSplit[1] + idSplit[2];
				
				ajaxFunction(roomNo,posNo);
				
				var $tabs = $('#tabs').tabs(); // first tab selected

				$tabs.tabs('select', 1); // switch to second tab
				
			}
			
		}
			
	</script>

</head>

<body>
    <?php $test1 = 1; ?>
    <div id="contentContainer">
    
        <div id="titleContainer">
        
        </div>
        
        <div id="unityContainer">
			<script language="javascript1.1" type="text/javaScript">
				
				if (DetectUnityWebPlayer()) {
					
					document.write('<object id="UnityObject" classid="clsid:444785F1-DE89-4295-863A-D46C3A781394" width="800" height="400"> \n');
					document.write('  <param name="src" value="Unity Player.unity3d" /> \n');
					document.write('  <embed id="UnityEmbed" src="Unity Player.unity3d" width="800" height="400" type="application/vnd.unity" pluginspage="http://www.unity3d.com/unity-web-player-2.x" /> \n');
					document.write('</object>');
				}
				else {
				
					var installerPath = GetInstallerPath();
					if (installerPath != "") {
						// Place a link to the right installer depending on the platform we are on. The iframe is very important! Our goals are:
						// 1. Don't have to popup new page
						// 2. This page still remains active, so our automatic reload script will refresh the page when the plugin is installed
						document.write('<div align="center" id="UnityPrompt"> \n');
						document.write('  <a href= ' + installerPath + '><img src="http://webplayer.unity3d.com/installation/getunity.png" border="0"/></a> \n');
						document.write('</div> \n');
						
						// By default disable ActiveX cab installation, because we can't make a nice Install Now button
						// if (navigator.appVersion.indexOf("MSIE") != -1 && navigator.appVersion.toLowerCase().indexOf("win") != -1)
						if (0)
						{	
							document.write('<div id="InnerUnityPrompt"> <p>Title</p>');
							document.write('<p> Contents</p>');
							document.write("</div>");

							var innerUnityPrompt = document.getElementById("InnerUnityPrompt");
							
							var innerHtmlDoc =
								'<object id="UnityInstallerObject" classid="clsid:444785F1-DE89-4295-863A-D46C3A781394" width="320" height="50" codebase="http://webplayer.unity3d.com/download_webplayer-2.x/UnityWebPlayer.cab#version=2,0,0,0">\n' + 
							    '</object>';
							    
							innerUnityPrompt.innerHTML = innerHtmlDoc;
						}

						document.write('<iframe name="InstallerFrame" height="0" width="0" frameborder="0">\n');
					}
					else {
						document.write('<div align="center" id="UnityPrompt"> \n');
						document.write('  <a href="javascript: window.open("http://www.unity3d.com/unity-web-player-2.x"); "><img src="http://webplayer.unity3d.com/installation/getunity.png" border="0"/></a> \n');
						document.write('</div> \n');
					}
					
					AutomaticReload();
				}
			
			</script>
			<noscript>
				<object id="UnityObject" classid="clsid:444785F1-DE89-4295-863A-D46C3A781394" width="800" height="400" codebase="http://webplayer.unity3d.com/download_webplayer-2.x/UnityWebPlayer.cab#version=2,0,0,0">
					<param name="src" value="Unity Player.unity3d" />
					<embed id="UnityEmbed" src="Unity Player.unity3d" width="800" height="400" type="application/vnd.unity" pluginspage="http://www.unity3d.com/unity-web-player-2.x" />
					<noembed>
						<div align="center">
							This content requires the Unity Web Player<br /><br />
							<a href="http://www.unity3d.com/unity-web-player-2.x">Install the Unity Web Player today!</a>
						</div>
					</noembed>
				</object>
			</noscript>
        </div>
        <div id="tabsContainer">
        	
        	<div id="tabs" class="flora">
            	<ul>
                	<li><a href="#tab1"><span>Home</span></a></li>
                	<li><a href="#tab2"><span>Current Image Information</span></a></li>
                	<li><a href="#tab3"><span>Help</span></a></li>
            	</ul>
                
            	<div id="tab1">
             		<h2>Welcome to the Virtual Art Studio and Gallery.</h2>
                    <p />
                    This gallery will focus on the art associated with sufferers of mental illness and acts  
                    as a communication vehicle to further understanding of the processes and hardships 
                    associated with mental illness. Collections will vary from time to time and include 
                    special gallery exhibitions as well as general collections. Enjoy
            	</div>
            	<div id="tab2">
                    <p>You havn't currently activated any paintings. Please walk up to any painting within
                    the gallery in order to display its information here.</p>
            	</div>
            	<div id="tab3">
           			<h1>Using the 3D Gallery</h1>
                    <h2>Moving Around the Gallery</h2>
                    The 3D gallery is setup much like many popular 3D computer games are. To walk around simply 
                    use the W A S D keys on your keyboard, and use the mouse to look around. Running can be 
                    performed by holding down the shift key while moving, and pressing the spacebar performs a jump. 
                    See the diagram below for a visual key guide.<br><br>
                    <h2>Viewing a Paintings Information</h2>
                    It is very simple to view information about a particular painting in the gallery. To do this first 
                    simple walk into a desired gallery room. This will cause the paintings in that gallery room to 
                    load and appear on the walls. Then simply walk up to the painting you wish to see the information 
                    for, and the Current Image Information tab will automatically be selected and filled with the 
                    paintings information.<br><br>
                    <h2>Pausing Gallery / Releasing Mouse</h2>
                    To pause the gallery just press the escape key. This will both pause the gallery and also release 
                    the mouse so that you can browse the web page. This is useful when your screen size is to small 
                    to fit both the gallery and the image information content at the same time.<br><br>
                    <h2>Resuming the Gallery</h2>
                    To resume exploring the gallery you simply need to click on the gallery window. This will re-lock 
                    the mouse and allow you to move around the gallery again.<br><br>
                    <h1>Troubleshooting</h1>
                    <h2>Website Not Displaying Properly</h2>
                    This website was only tested with Internet Explorer 7, Firefox 3 and Safari 3. It may have issues 
                    displaying and opperating outside of these browsers.<br><br>
					Additionally, if images in both the 3D gallery and the webpage do not update properly you may 
					need to reload the webpage or clear the browser cache.
            	</div>
        	</div>
            
        </div>
        
        <div id="footerContainer">
            <span class="footer">Copyright 2008 | Patrick Marabeas . Ryan Gaylard . David Thompson</span>
            <p />
            <a href="admin.php">admin login</a>
        </div>
    
    </div>

</body>
</html>



