<?php
//This increases the memory allocation for picture processing
//The server has to allow for this to be changed manually. If not this has to be
//changed via the php.ini file, which may require administrator assistance.
ini_set("memory_limit","20M");

// PICTURE PROCESS FUNCTION //////////////////////////////////////////////////////////////////////////////
function pictureProcessor ($image, $specw, $spech, $orientation, $name, $type) {
    	
    $size = getimagesize( $image );
    $width = $size[ 0 ];
    $height = $size[ 1 ];
    
    if ($orientation == 0) {
        $neww = $specw;
        $newh = ceil( $neww*($height/$width) );
        
        if($type == "" && $newh > 280) {
        	$newh1 = $newh;
        	$neww1 = $neww;
        	
        	$newh = 280;
        	$neww = ceil( $newh*($neww1/$newh1) );
        }
    }
    else {
        $newh = $spech;
        $neww = ceil( $newh*($width/$height) );
        
        if($type == "" && $neww > 280) {
        	$newh1 = $newh;
        	$neww1 = $neww;
        	
        	$neww = 280;
        	$newh = ceil( $neww*($newh1/$neww1) );
        }
    }
    
    $im = imagecreatefromjpeg( $image );
    
    $im2 = imagecreatetruecolor( $neww, $newh );
    imagecopyresampled( $im2, $im, 0, 0, 0, 0, $neww, $newh, $width, $height );
    imagedestroy( $im );
    
    $im = $im2;
    
    if($type == "" && $orientation == 1) {
        $rotate = imagerotate($im, -90, 0);
        imagedestroy( $im );
        $im = $rotate;
    }
            
    // save the image
    imagejpeg( $im, 'Images/GalleryImages/' . $name . $type . '.jpg', 100 );
    
    
    // IF TYPE IS UNDEFINED (VERSION BEING USED IN UNITY) THEN ADD A BACKGROUND TO IMAGE /////////////////////
    if ($type == "") {
        $src = imagecreatefromjpeg('Images/GalleryImages/' . $name . $type . '.jpg');
        // getting size of the image
        $size = getimagesize('Images/GalleryImages/' . $name . $type . '.jpg');
        $width = $size[ 0 ];
        $height = $size[ 1 ];
        // setting the background image size variables
        $bbwidth = 440;
        $bbheight = 308;
        // creating the background image
        $blackBackground = imagecreatetruecolor($bbwidth, $bbheight);
        imagecolorallocate($blackBackground, 0, 0, 0);
        // determining padding necessary for the top image to be centered on the background
        $halign = (($bbwidth - $width)/2);
        $valign = (($bbheight - $height)/2);
        // merging the two images and aligning the top image accordingly to be centered
        imagecopymerge($blackBackground, $src, $halign, $valign, 0, 0, $width, $height, 100);
        // save the image
        imagejpeg($blackBackground, 'Images/GalleryImages/' . $name . $type . '.jpg', 100 );
    }
    //////////////////////////////////////////////////////////////////////////////////////////////////////////
}
//////////////////////////////////////////////////////////////////////////////////////////////////////////

//function to change new lines to br tags - better than the inbuilt function nl2br()
function nl2br2($string) { 
    $string = str_replace(array("\r\n", "\r", "\n"), "<br />", $string); 
    return $string; 
}

//Check if the save button has been pressed 
if(isset($_POST['Save'])) {
    //getting gallery room identifier so 
    $roomid = $_GET['galleryRoom'];
    
    $query = "SELECT image_positionno FROM images WHERE image_roomno = $roomid ORDER BY image_positionno";
    $result = mysql_query($query) 
        or die ("Query failed y"); 
    $num_records = mysql_num_rows($result);

    //for loop so code will run for as many painting positions as there are in database for particular gallery
    //'i' is being used throughout as a substitute for image position, as the query is being ordered by image position anyway
    for ($i = 1; $i <= $num_records; $i++) {

		//setting variables from forms POST
        $paintingTitle = $_POST['paintingTitle'.$i];
        $paintingArtist = $_POST['paintingArtist'.$i];
        $paintingDate = $_POST['paintingDate'.$i];
        $paintingDescription = nl2br2($_POST['paintingDescription'.$i]);
        $paintingOrientation = $_POST['paintingOrientation'.$i];
        $frameStyle = $_POST['frameStyle'.$i];
        $paintingSize = $_POST['paintingSize'.$i];
        $imageActive = $_POST['imageActive'.$i];
        
        // FORM IMAGE SUBMIT -> SAVE AND RESIZE //////////////////////////////////////////////////////////////////
        //unsetting the variables used when uploading each image
        
        unset($imagename);
        unset($error);

        if (!isset($_FILES) && isset($HTTP_POST_FILES)) {
            $_FILES = $HTTP_POST_FILES;
        }
        
        $imageid = $roomid . $i;
        $image_type = $_FILES['imageFile'.$i]['type'];

		//This check for image type jpeg
        if ($image_type == "image/jpeg") {
            $imagename = $roomid . $i . "temp.jpg";
            $newtempimage = "Images/GalleryImages/" . $imagename;
            
            $result = @move_uploaded_file($_FILES['imageFile'.$i]['tmp_name'], $newtempimage);
            
        	list($width, $height) = getimagesize($newtempimage);
            
       		if ($width > $height) {
            	$paintingOrientation = "0";
        	}
        	else {
            	$paintingOrientation = "1";
        	}
        	
        	pictureProcessor ($newtempimage, 700, 700, $paintingOrientation, $imageid, "l");
        	pictureProcessor ($newtempimage, 350, 350, $paintingOrientation, $imageid, "m");
        	pictureProcessor ($newtempimage, 400, 400, $paintingOrientation, $imageid, "");
        	pictureProcessor ($newtempimage, 150, 150, $paintingOrientation, $imageid, "s");
        	pictureProcessor ($newtempimage, 75, 75, $paintingOrientation, $imageid, "xs");
        	// delete the temp file
            unlink($newtempimage);
        }
        else {
            // -> error message to upload only .jpg or function to change other files into jpg        
        } 
                          
        //////////////////////////////////////////////////////////////////////////////////////////////////////////
        
        //updating database with variables previously set
        $query = "UPDATE images SET 
        image_name='$paintingTitle', 
        image_artist='$paintingArtist', 
        image_date='$paintingDate',
        image_description='$paintingDescription', 
        image_framestyle='$frameStyle', 
        image_size='$paintingSize', 
        image_orientation='$paintingOrientation', 
        image_active='$imageActive' 
        WHERE image_positionno = '$i' AND image_roomno = '$roomid'";
        
        $result = mysql_query($query) or 
            die ("Query Failed: Failed to update database with new values");
    };
    
    
    //Store gallery room names into the database
    //setting variable from form POST
    $galleryName = $_POST['galleryName'];
    
    //updating database with variables previously set
    $query = "UPDATE roomnames SET room_name='$galleryName' WHERE room_id='$roomid'";
        
    $result = mysql_query($query) or 
    	die ("Query Failed: Failed to update database with new values");
            
    

    //The following code writes out the data file that will be used by Unity3D
    //Here database is queried to retrieve information on all active paintings in all gallery rooms.
    $query = "SELECT image_roomno, image_positionno, image_orientation, image_framestyle, image_size FROM images WHERE image_active = 'on' ORDER BY image_roomno, image_positionno";
    $result = mysql_query($query) 
    or die ("Query failed"); 
    $num_records = mysql_num_rows($result);

    for($i = 1; $i <= $num_records; $i++) {
        $row = mysql_fetch_array($result);
    
        $roomno = $row['image_roomno'];
        $imagepos = $row['image_positionno'];
        $imageori = $row['image_orientation'];
        $framesty = $row['image_framestyle'];
        $imagesize = $row['image_size'];
        
        $content .= $roomno.$imagepos.",".$imageori.",".$framesty.",".$imagesize.",";
    };
    
    //This opens the data.txt file and then writes the content variable string into it
    $fn = "data.txt";
    $fp = fopen($fn,"w") or die ("Error opening file in write mode!");
    fputs($fp,$content);
    fclose($fp) or die ("Error closing file!");
    
    
    //The following code writes out the names file that will be used by Unity3D for gallery names display
    //Here database is queried to retrieve names of all gallery rooms.
    $query = "SELECT room_name FROM roomnames ORDER BY room_id";
    $result = mysql_query($query) 
    or die ("Query failed"); 
    $num_records = mysql_num_rows($result);
	unset($content);
	
    for($i = 1; $i <= $num_records; $i++) {
        $row = mysql_fetch_array($result);
    
        $roomname = $row['room_name'];
        
        $content .= $roomname.",";
    };
    
    //This opens the names.txt file and then writes the content variable string into it
    $fn = "names.txt";
    $fp = fopen($fn,"w") or die ("Error opening file in write mode!");
    fputs($fp,$content);
    fclose($fp) or die ("Error closing file!");
    
};

?>