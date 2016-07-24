var frameStyleL1 : GameObject;
var frameStyleL2 : GameObject;
var frameStyleL3 : GameObject;
var frameStyleP1 : GameObject;
var frameStyleP2 : GameObject;
var frameStyleP3 : GameObject;
var paintingTrigger : GameObject;

private var paintingOrientation = 0;
private var paintingSize = 0.00;
private var frameStyle : GameObject;

function Start () {
	
	yield WaitForSeconds(0.5);
	
	var isPaintingActive = false;
	
	for (i=0;i<DataLoad.paintingData.length;i++) {
		
		if(DataLoad.paintingData[i] == name) {
			
			// Set painting as active
			isPaintingActive = true;
			
			// Set painting properties
			// Frame style and orrientation
			// Style 1
			if(DataLoad.paintingData[i+1] == "0" && DataLoad.paintingData[i+2] == "black") {
				frameStyle = frameStyleL1;
				print("Frame Style 1 Landscape");
			}
			
			if(DataLoad.paintingData[i+1] == "1" && DataLoad.paintingData[i+2] == "black") {
				frameStyle = frameStyleP1;
				print("Frame Style 1 Portrait");
			}
			
			// Style 2
			if(DataLoad.paintingData[i+1] == "0" && DataLoad.paintingData[i+2] == "wood") {
				frameStyle = frameStyleL2;
				print("Frame Style 2 Landscape");
			}
			
			if(DataLoad.paintingData[i+1] == "1" && DataLoad.paintingData[i+2] == "wood") {
				frameStyle = frameStyleP2;
				print("Frame Style 2 Portrait");
			}
			
			// Style 3
			if(DataLoad.paintingData[i+1] == "0" && DataLoad.paintingData[i+2] == "metal") {
				frameStyle = frameStyleL3;
				print("Frame Style 3 Landscape");
			}
			
			if(DataLoad.paintingData[i+1] == "1" && DataLoad.paintingData[i+2] == "metal") {
				frameStyle = frameStyleP3;
				print("Frame Style 3 Portrait");
			}
			
			// Frame scale
			// Small
			if(DataLoad.paintingData[i+3] == "small") {
				paintingSize = -0.25;
			}
			
			// Normal
			if(DataLoad.paintingData[i+3] == "medium") {
				paintingSize = 0;
			}
			
			// Large
			if(DataLoad.paintingData[i+3] == "large") {
				paintingSize = 0.5;
			}
			
			// Launch functions
			placeTrigger();
			placePainting();
			
			// Indicate that it is active
			print("Painting " + name + " is active.");
			
			// Remove the picture spawner object
			Destroy (gameObject);
			
		}
		
		else if(i == DataLoad.paintingData.length - 1 && isPaintingActive == false) {
			
			// Indicate it is not active
			print("Painting " + name + " is not active.");
			
			// Remove the picture spawner object
			Destroy (gameObject);
			
		}
		
	}
	
}	
	
// This places a trigger object at the position and rotation of the painting spawner object
// and names this trigger based of the name of the spawner.
function placeTrigger() {
	
	// Insantiate a painting trigger
	// Instantiate the trigger at the position and rotation of this transform
	var newTrigger : GameObject;
	newTrigger = Instantiate(paintingTrigger, transform.position, transform.rotation);
	 
	// Rename the new painting trigger to the same as the spawner
	newTrigger.name = "Trigger" + name;
	
}	

// This places a painting at the coordinates and rotation of the painting spawner object
// and with the frame style, painting scale, and painting orrientation specified.
function placePainting() {	
	
	// Insantiate a painting
	// Instantiate the painting at the position and rotation of this transform
	var newPainting : GameObject;
	newPainting = Instantiate(frameStyle, transform.position, transform.rotation);
	 
	// Rename the new painting object
	newPainting.name = "Painting" + name;
	
	// Set scale of painting
	newPainting.transform.localScale.x += paintingSize;
	newPainting.transform.localScale.y += paintingSize;
	
}