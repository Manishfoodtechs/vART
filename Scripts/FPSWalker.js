var speed = 6.0;
var jumpSpeed = 8.0;
var gravity = 20.0;
var stepSpeed = 0.0;

private var mDelay = 0.0;
private var randNum = 0;

var step0: AudioClip;
var step1: AudioClip;
var step2: AudioClip;
var step3: AudioClip;
var step4: AudioClip;
var step5: AudioClip;
var step6: AudioClip;
var step7: AudioClip;

var steps = new Array(8);
steps[0] = step0;
steps[1] = step1;
steps[2] = step2;
steps[3] = step3;
steps[4] = step4;
steps[5] = step5;
steps[6] = step6;
steps[7] = step7;

private var walkSpeed = speed;
private var runSpeed = speed * 2;

private var moveDirection = Vector3.zero;
private var grounded : boolean = false;

function FixedUpdate() {
	
	if (Input.GetKey(KeyCode.LeftShift)) {
		speed = runSpeed;
	}
	
	if (!Input.GetKey(KeyCode.LeftShift)) {
		speed = walkSpeed;
	}
	
	if (grounded) {
		// We are grounded, so recalculate movedirection directly from axes
		moveDirection = new Vector3(Input.GetAxis("Horizontal"), 0, Input.GetAxis("Vertical"));
		moveDirection = transform.TransformDirection(moveDirection);
		moveDirection *= speed;
		
		if (Input.GetButton ("Jump")) {
			moveDirection.y = jumpSpeed;
		}
		
		if ( Input.GetAxis ("Vertical") || Input.GetAxis ("Horizontal") ) { 
      		if ( mDelay > stepSpeed ) { 
      			randNum = Random.Range(0, 7);
      			
         		mDelay -= stepSpeed; 
          
         		audio.clip = steps[randNum];        
         		audio.Play (); 
      		} 
       
      		mDelay += Time.deltaTime;
		}
		
		else {
      		mDelay = 0.0;
		}
		
	}

	// Apply gravity
	moveDirection.y -= gravity * Time.deltaTime;
	
	// Move the controller
	var controller : CharacterController = GetComponent(CharacterController);
	var flags = controller.Move(moveDirection * Time.deltaTime);
	grounded = (flags & CollisionFlags.CollidedBelow) != 0;
}

@script RequireComponent(CharacterController)