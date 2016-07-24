var room1 : GameObject;
var room2 : GameObject;
var room3 : GameObject;
var room4 : GameObject;
var room5 : GameObject;
var room6 : GameObject;
var room7 : GameObject;
var room8 : GameObject;
var room9 : GameObject;

private var isSpawned = false;

// All statements are called when the player walks inside of the trigger element
function OnTriggerEnter (other : Collider) {
	
	var newName = Regex.Replace(name, "Trigger", "");
    
    // The following statements instantiate the appropriate gallery rooms paintings
    // when the name matches the triggers name.
    if(name == "Room1Trigger" && isSpawned == false) {
    	Instantiate (room1);
    	isSpawned = true;
    }
    
    if(name == "Room2Trigger" && isSpawned == false) {
    	Instantiate (room2);
    	isSpawned = true;
    }
    
    if(name == "Room3Trigger" && isSpawned == false) {
    	Instantiate (room3);
    	isSpawned = true;
    }
    
    if(name == "Room4Trigger" && isSpawned == false) {
    	Instantiate (room4);
    	isSpawned = true;
    }
    
    if(name == "Room5Trigger" && isSpawned == false) {
    	Instantiate (room5);
    	isSpawned = true;
    }
    
    if(name == "Room6Trigger" && isSpawned == false) {
    	Instantiate (room6);
    	isSpawned = true;
    }
    
    if(name == "Room7Trigger" && isSpawned == false) {
    	Instantiate (room7);
    	isSpawned = true;
    }
    
    if(name == "Room8Trigger" && isSpawned == false) {
    	Instantiate (room8);
    	isSpawned = true;
    }
    
    if(name == "Room9Trigger" && isSpawned == false) {
    	Instantiate (room9);
    	isSpawned = true;
    }
    
    // The following statements set the text for the Gallery Name in the overhead display
    // when the triggers name matches.
    if(name == "Name1Trigger") {
    	GUIController.galleryTitle = DataLoad.galleryNames[0];
    }
    
    if(name == "Name2Trigger") {
    	GUIController.galleryTitle = DataLoad.galleryNames[1];
    }
    
    if(name == "Name3Trigger") {
    	GUIController.galleryTitle = DataLoad.galleryNames[2];
    }
    
    if(name == "Name4Trigger") {
    	GUIController.galleryTitle = DataLoad.galleryNames[3];
    }
    
    if(name == "Name5Trigger") {
    	GUIController.galleryTitle = DataLoad.galleryNames[4];
    }
    
    if(name == "Name6Trigger") {
    	GUIController.galleryTitle = DataLoad.galleryNames[5];
    }
    
    if(name == "Name7Trigger") {
    	GUIController.galleryTitle = DataLoad.galleryNames[6];
    }
    
    if(name == "Name8Trigger") {
    	GUIController.galleryTitle = DataLoad.galleryNames[7];
    }
    
    if(name == "Name9Trigger") {
    	GUIController.galleryTitle = DataLoad.galleryNames[8];
    }
    
    // This statement calls the display painting info function within the website, when the trigger is
    // not a room spawner or a name displayer. The trigers name is used as a painting id.
    if(name != "Room1Trigger" && name != "Room2Trigger" && name != "Room3Trigger" && name != "Room4Trigger" && name != "Room5Trigger" && name != "Room6Trigger" && name != "Room7Trigger" && name != "Room8Trigger" && name != "Room9Trigger" && name != "Name1Trigger" && name != "Name2Trigger" && name != "Name3Trigger" && name != "Name4Trigger" && name != "Name5Trigger" && name != "Name6Trigger" && name != "Name7Trigger" && name != "Name8Trigger" && name != "Name9Trigger") {
    	print(newName);
    	Application.ExternalCall ("displayPaintingInfo", newName);
    	if(GUIController.displayInfo == 0) {
    		GUIController.displayInfo = 2;
    	}
    }
	
}

function OnTriggerExit (other : Collider) {
	if(name == "Name1Trigger" || name == "Name2Trigger" || name == "Name3Trigger" || name == "Name4Trigger" || name == "Name5Trigger" || name == "Name6Trigger" || name == "Name7Trigger" || name == "Name8Trigger" || name == "Name9Trigger") {
		GUIController.galleryTitle = "";
	}
}