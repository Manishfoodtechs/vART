// A message is sent when the object that this script is attached to is clicked

function OnMouseDown () {
	
	// Tells any parent scripts to lockCursor
	SendMessageUpwards ("LockCursor");
	
}