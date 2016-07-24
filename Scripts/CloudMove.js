//This script moves the cloud textures across the sky dome
var cloudSpeed = 0.5;

function Update () {
    var offset = Time.time * (cloudSpeed / 1000);
    
    //Sets the x position of the texture to the value of the offset variable
    renderer.material.mainTextureOffset = Vector2 (offset,0);
}