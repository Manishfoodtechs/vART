var music1: AudioClip;
var music2: AudioClip;
var music3: AudioClip;
var music4: AudioClip;

var musicTracks = new Array(4);
musicTracks[0] = music1;
musicTracks[1] = music2;
musicTracks[2] = music3;
musicTracks[3] = music4;

function Start ()
{    
    PlayMusicTracks ();
}

function PlayMusicTracks () {
    while (true)
    {
    	var randNum = Random.Range(0, 3);
    	var randWait = Random.Range(0, 60);
        var clip = musicTracks[randNum];
        if (clip != null)
        {
            audio.clip = clip;
            print(clip.length + randWait);
            audio.Play();
            yield WaitForSeconds(clip.length + randWait);
        }
        yield;
    }
}