// This script controlls all the GUI related functions within the gallery

static var displayInfo = 0.0000;
static var galleryTitle = "";

// Called when the cursor is actually being locked
function DidLockCursor () {
    Debug.Log("Locking cursor");

    // Disable the button
    transform.Find("PanelPause").guiTexture.enabled = false;
}

// Called when the cursor is being unlocked
// or by a script calling Screen.lockCursor = false;
function DidUnlockCursor () {
    Debug.Log("Unlocking cursor");

    // Show the button again
    transform.Find("PanelPause").guiTexture.enabled = true;
}

function LockCursor () {
    // Lock the cursor
    Screen.lockCursor = true;
}

private var wasLocked = false;
Time.timeScale = 0.0;


function Update () {
	
	transform.Find("NamesText").guiText.text = galleryTitle;
	
	if(displayInfo > 1) {
		transform.Find("PanelInfo").guiTexture.enabled = true;
		displayInfo = displayInfo - (Time.deltaTime * 0.2);
	}
	
	else {
		transform.Find("PanelInfo").guiTexture.enabled = false;
	}
	
	// Sets the H key to call the openHelp function within the contain webpage
	if (Input.GetKeyDown ("h")) {
        
        Screen.lockCursor = false;
    	displayInfo = 1;
    	Application.ExternalCall ("openHelp");
    	
    }
	
    // Sets the escape key to unlock the cursor
    if (Input.GetKeyDown ("escape")) {
        
        Screen.lockCursor = false;
    	displayInfo = 1;
    	
    }

    // Did we lose cursor locking?
    // eg. because the user pressed escape
    // or because he switched to another application
    // or because some script set Screen.lockCursor = false;
    if (!Screen.lockCursor && wasLocked) {
        wasLocked = false;
        DidUnlockCursor();
        Time.timeScale = 0.0;
    }
    // Did we gain cursor locking?
    else if (Screen.lockCursor && !wasLocked) {
        wasLocked = true;
        DidLockCursor ();
        Time.timeScale = 1.0;
    }
}