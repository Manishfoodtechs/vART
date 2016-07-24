<? 
header("Expires: Mon, 26 Jul 1997 05:00:00 GMT"); // Date in the past
header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT"); // always modified 
header("Cache-Control: no-store, no-cache, must-revalidate"); // HTTP/1.1 
header("Cache-Control: post-check=0, pre-check=0", false); // HTTP/1.0 
header("Pragma: no-cache");

session_start();
if (isset($_POST["Logout"]))
{
	session_unset();
    $uname = "";
    $pword = "";
}

if (isset ($_SESSION["username"]))
{
    $uname = $_SESSION["username"];
}

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="pragma" content="no-cache" />
    <meta http-equiv="cache-control" content="no-cache" />
    <META HTTP-EQUIV="EXPIRES" CONTENT="0">
    <meta name="robots" content="noarchive">
    
	<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
    
    <link rel="stylesheet" type="text/css" href="Styles/stylesAdmin-screen.css" />
    
    <script type="text/javascript">

        function minimise(posNo)
        {
            document.getElementById('positionContainerMax'+posNo).style.display = 'none';
            document.getElementById('positionContainerMin'+posNo).style.display = 'block';
        }
        
        function maximise(posNo)
        {
            document.getElementById('positionContainerMax'+posNo).style.display = 'block';
            document.getElementById('positionContainerMin'+posNo).style.display = 'none';
        }
        
        function formChange()
        {
            document.getElementById('messageContainer').innerHTML = 'Changes have been made. Ensure you save.';          
        }
    </script>
</head>

<body>

<?php
include ("Includes/connect.php");

//function to replace br tags with new lines 
function br2nl($string) {
    return preg_replace('/\<br(\s*)?\/?\>/i', "\n", $string);
}

?>

<?php
//Checks if anyone is logged in
if (!isset ($_SESSION["username"]) && !isset($_POST['Login'])) {
	include ("loginform.php");
}

//This checks if a login attempt has been made and processes the attempt
if (!isset ($_SESSION["username"]) && isset($_POST['Login'])) { 

// CREATE VARIABLES FROM FORM DATA
$uname = $_POST["username"];
$pword = md5($_POST["password"]);
                
// VALIDATION TO CHECK USERNAME ENTERED IS NOT ALPHANUMERIC
if ( ereg('[^A-Za-z0-9]', $uname)) 
{
	// IF IT ISN'T THEN DISPLAY LOGIN ERROR
	// LOGING IN WILL KEEP USER AT CURRENT PAGE
	$url = $_SERVER['PHP_SELF'];
	$loginError = 1;
	include ("loginform.php");
}

else
{
	// QUERY DATABASE FOR USERNAME AND PASSWORD ENTERED
	$query = "SELECT * FROM members WHERE username='$uname' AND password='$pword'";
	$result = mysql_query($query)
		or die ("Error" . mysql_error());

	$num_records = mysql_num_rows($result);
                            
	// IF NUMBER OF RECORDS IS O THEN USERNAME/PASSWORD IS INCORECT - DISPLAY ERROR
	if ($num_records == 0)
	{
		$url = $_SERVER['PHP_SELF'];
		$loginError = 1;
		include ("loginform.php");
	}
                            
	// FOR EACH ROW IN DATABASE IF USERNAME / PASSWORD = INPUT
	// DISPLAY LOGIN SUCCESS
	// OTHERWISE SHOW ERROR
	for($i = 0; $i < $num_records; $i++) 
	{
		$row = mysql_fetch_array($result);

		if (($uname == $row[1]) && ($pword == $row[2]))
		{
			$_SESSION['username'] = $row[1];
			$_SESSION['password'] = $row[2];
		}

		else
		{
			$url = $_SERVER['PHP_SELF'];
			$loginError = 1;
			include ("loginform.php");
		}
	} 
}

}

if (isset ($_SESSION["username"])) {
?>
<div id="contentContainer">
    
        <div id="titleContainer">
            <h3>Admin Panel</h3>
            
            <form name="logout" method="post" action="admin.php">
        		<?php echo $uname ?> is logged in <input name="Logout" type="submit" value="[Logout]">
    		</form>
        </div>
		<div id="selectContainer">
        
            <form name="selectRoom" method="GET">
                Select gallery to edit:
                <select name="galleryRoom">
                
                    <?php
                    $query = "SELECT room_id, room_name FROM roomnames ORDER BY room_id";
                    $result = mysql_query($query) 
                        or die ("Query failed"); 
                    $num_records = mysql_num_rows($result);
                   
                    for($i = 1; $i <= $num_records; $i++) 
                    {
                        $row = mysql_fetch_array($result);
                    ?>
                
                        <option value="<?php echo $i?>">Gallery Room <?php echo $i?>: <?php echo $row['room_name']?></option>
                    <?
                    }
                    ?>
                </select>
                <input type="submit" value="Submit">
                
            </form>
        
        </div>

        <div id="valuesContainer">
        

                <?php
                include ("Includes/save.php");
                ?>

                <?php
                if (isset($_GET['galleryRoom']))
                {
                    $roomID = $_GET['galleryRoom'];
                    
                    $query = "SELECT room_id, room_name FROM roomnames WHERE room_id = $roomID";
                    
                    $result = mysql_query($query) 
                        or die ("Query failed"); 
                    $num_records = mysql_num_rows($result);
                    
                    for($i = 1; $i <= $num_records; $i++) 
                    {
                        $row = mysql_fetch_array($result);
                    }
                    ?>
                
                
                   <form  action="http://mmproject.geekbin.com/admin.php?galleryRoom=<?php echo $row['room_id']?>" method="POST" enctype="multipart/form-data">
                
                    <?php
                    $query = "SELECT image_name, image_orientation, image_roomno, image_positionno, image_framestyle, image_size, image_artist, 
                    image_date, image_description, image_active FROM images WHERE image_roomno = $roomID ORDER BY image_positionno";
                    $result = mysql_query($query) 
                        or die ("Query failed"); 
                    $num_records = mysql_num_rows($result);
                    
                    for($i = 1; $i <= $num_records; $i++) 
                    {
                        $row = mysql_fetch_array($result);
                        
                        if ($row['image_active'] == "on") 
                        {
                            $row['image_active'] = "checked";
                        };
                    ?>
                    
                    <input type="hidden" name="paintingOrientation<?php echo $row['image_positionno']?>" value="<?php echo $row['image_orientation']?>" /> 
                        
                         <div id="positionContainerMin<?php echo $row['image_positionno']?>" class="positionContainerMin">
                        
                            <div class="positionContainerMinUpper">
                            
                                <div class="positionContainerMinUpperLeft">
                                
                                    Painting Position <?php echo $row['image_positionno']?>
                            
                                </div>
                                
                                <div class="positionContainerMinUpperRight">
                                
                                    <input type="button" value="edit  +" onClick="maximise(<?php echo $row['image_positionno']?>)">
                            
                                </div>
                            
                            </div>
                            
                            <div class="positionContainerMinLower">
                            
                                <div class="positionContainerMinLowerLeft">
                                
                                    <img src="Images/GalleryImages/<?php echo $row['image_roomno'].$row['image_positionno']?>xs.jpg" />
                            
                                </div>
                            
                                <div class="positionContainerMinLowerRight">
                                
                                    <div class="positionContainerMinLowerRightContent">
                                
                                        <span class="paintingTitle"><?php echo $row['image_name']?> </span> <br />
                                        <?php echo htmlentities($row['image_artist'])?> &nbsp;&nbsp;&nbsp; <?php echo htmlentities($row['image_date'])?> <p />
                                        <?php echo htmlentities(substr(br2nl($row['image_description']),0,300));?>
                                    
                                    </div>
                                
                                </div>
                            
                            </div>
                            
                            
                        
                        </div>
                        
                        <div id="positionContainerMax<?php echo $row['image_positionno']?>" class="positionContainerMax">
                        
                            <div class="positionContainerMaxUpper">
                            
                                <div class="positionContainerMaxUpperLeft">
                                
                                    Painting Position <?php echo $row['image_positionno']?>
                            
                                </div>
                                
                                <div class="positionContainerMaxUpperRight">
                                
                                    <input type="button" value="minimise  -" onClick="minimise(<?php echo $row['image_positionno']?>)">
                            
                                </div>
                            
                            </div>
                            
                            <div class="positionContainerMaxMiddle">
                                <div class="positionContainerMaxMiddleUpper"> 
                                
                                    <div class="positionContainerMaxMiddleUpperLeft"> 
                                
                                        <img src="Images/GalleryImages/<?php echo $row['image_roomno'].$row['image_positionno']?>s.jpg" />
                                
                                    </div>
                                    <div class="positionContainerMaxMiddleUpperRight"> 
                                
                                
                                        <span class="paintingTitleMax">Title: <input type="text" onchange="formChange()" name="paintingTitle<?php echo $row['image_positionno']?>" value="<?php echo $row['image_name']?>"></span>
                                        <p />
                                        <span class="paintingArtist">Artist: <input type="text" onchange="formChange()" name="paintingArtist<?php echo $row['image_positionno']?>" value="<?php echo $row['image_artist']?>"></span>
                                        <span class="paintingDate">Date: <input type="text" onchange="formChange()" name="paintingDate<?php echo $row['image_positionno']?>" value="<?php echo $row['image_date']?>"></span>
                                        <p />
                                        Description:<br>
                                        <span class="paintingDescription"><textarea cols="36" rows="5" onchange="formChange()" name="paintingDescription<?php echo $row['image_positionno']?>"><?php echo br2nl($row['image_description'])?></textarea></span>
                                
                                
                                
                                    </div>

                                </div>
                                
                                
                                <div class="positionContainerMaxMiddleLower"> 
                                    Upload new image: </br>
                                    <span class="paintingFile"><input type="file" onchange="formChange()" name="imageFile<?php echo $row['image_positionno']?>"></span>
                                    <p />
                                     <span class="paintingFrameStyle">Frame Style: 
                                        <select onchange="formChange()" name="frameStyle<?php echo $row['image_positionno']?>">
                                            <option value="<?php echo $row['image_framestyle']?>" selected="yes"><?php echo $row['image_framestyle']?></option>
                                            <option value="black">black</option>
                                            <option value="wood">wood</option>
                                            <option value="metal">metal</option>
                                        </select></span>
                                        
                                         <span class="paintingSize">Size of image in gallery: 
                                        <select onchange="formChange()" name="paintingSize<?php echo $row['image_positionno']?>">
                                            <option value="<?php echo $row['image_size']?>" selected="yes"><?php echo $row['image_size']?></option>
                                            <option value="small">small</option>
                                            <option value="medium">medium</option>
                                            <option value="large">large</option>
                                        </select></span>
                                        
                                        <span class="paintingEnabled">enabled:
                                        <!--this php writes out 'checked' however, the check box submits either '' or 'on' when posting to database so UNITY will need
                                        to look for image_active = on-->
                                        <input type="checkbox" onchange="formChange()" name="imageActive<?php echo $row['image_positionno']?>" <?php echo $row['image_active']?>></span>
                                
                                </div>
                            </div>
                            
                            <div class="positionContainerMaxLower">
                            
                                <div class="positionContainerMaxLowerLeft"></div>
                            
                                <div class="positionContainerMaxLowerRight"></div>
                            
                            </div>
                            
                            
                        
                        </div>

                <?php
                    }
                ?>   
                    
                
                </div>
                
    </div>
                
                <div id="floatingSaveContainer"> 
                
                        <div id="positionContainerSave">
                        
                            
                            <div id="TextContainer">
                            
                                <?php
                                if (isset($_GET['galleryRoom']))
                                {
                                    $roomID = $_GET['galleryRoom'];
                                    
                                    $query = "SELECT room_id, room_name FROM roomnames WHERE room_id = $roomID";
                                    
                                    $result = mysql_query($query) 
                                        or die ("Query failed"); 
                                    $num_records = mysql_num_rows($result);
                                    
                                    for($i = 1; $i <= $num_records; $i++) 
                                    {
                                        $row = mysql_fetch_array($result);
                                ?>

                                        Currently editing Gallery Room <?php echo $row['room_id']?>: <?php echo $row['room_name'] ?>
                                        
                            </div>
                                        
                                        
                            <div id="renameContainer">

                            Rename this Gallery room to: <input type="text" name="galleryName" value="<?php echo $row['room_name']?>">
                            
                            
                            </div>

                                    <?php
                                    }
                                    ?>
                                    
                                <?php
                                }
                                ?>

                            <div id="messageContainer"></div>
                            
                            <div id="saveButtonContainer">
                                <input type="submit" id="saveButton" name="Save" value="Save" />     
                            </div>
                        </div>                        
                
                <?php                
                }
                ?>
                
                </div>
                
                <!--hidden elemnt to pass through the room being edited-->
                <!--THIS MUST BE LOCATED WITHIN FORM AND WITHIN QUERY REGARDING GALLERYROOM-->
                <input type="hidden" name="room_id" value="<?php echo $row['room_id']?>" />
                
            </form>
<?php
}
?>
</body>
</html>



