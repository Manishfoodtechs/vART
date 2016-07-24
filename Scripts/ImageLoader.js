function Start () {
	
	yield WaitForSeconds(0.1);
	
	var newName = Regex.Replace(name, "Painting", "");
	
	//Set the paintings image
	var url = "/Images/GalleryImages/" + newName + ".jpg";

    // Start a download of the given URL
    var www : WWW = new WWW (url);
    
    // Wait for download to complete
    yield www;
    
    // Assign downloaded image to the canvas object of the painting frame
    transform.Find("Canvas").renderer.material.mainTexture = www.texture;
    
}