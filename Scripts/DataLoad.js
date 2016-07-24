// This script downloads the data and names text files and splits them
// up into global arrays so they can be read by other objects in the level.

private var url1 = "/data.txt";
private var url2 = "/names.txt";

static var paintingData = new Array ();
static var galleryNames = new Array ();

function Start () {
    // Start a download of the given URL
    var www1 : WWW = new WWW (url1);
    
    // Wait for download to complete
    yield www1;
    
    // Split data up into an array
    paintingData = www1.data.Split(","[0]);
    
    // Repeats the same process as above for the names.txt file
    var www2 : WWW = new WWW (url2);
    
    yield www2;
    
    galleryNames = www2.data.Split(","[0]);
    
}