<?php

    include ("Includes/connect.php");
	
	$roomNum = $_GET['roomNum'];		
	$posNum = $_GET['posNum'];
	
	$query = "SELECT image_name, image_artist, image_date, image_description FROM images WHERE image_roomno = '$roomNum' AND image_positionno = '$posNum'";
    $result = mysql_query($query) 
    or die ("Query failed");
    
	$row = mysql_fetch_array($result);
    
    //htmlentities () used to ensure that any output cannot influence page
    
    $paintingName = htmlentities ($row['image_name']);
    $paintingArtist = htmlentities ($row['image_artist']);
    $paintingDate = htmlentities ($row['image_date']);
    $paintingDescription = $row['image_description'];
	
    echo "<div id='contentLeft'>";
	echo "<img src='Images/GalleryImages/".$roomNum.$posNum."m.jpg'>";
    echo "</div>";
    echo "<div id='contentRight'>";
	echo "<h1>".$paintingName."</h1>";
	echo $paintingArtist."<br>";
	echo $paintingDate."<p />";
	echo $paintingDescription;
    echo "</div>";
?>