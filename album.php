<?php

   // Check if we have parameters w1 and w2 being passed to the script through the URL
// && isset($_GET["w2"])) {
   if (isset($_GET["a"])) {
	$album = $_GET['a'];
	$dir = "album_data/";
	$trackdir = "album_tracks/MP3/";
	$trackdirogg = "album_tracks/OGG/";
	$zip = $trackdir . $album . ".zip";
		$find = array(" ");
		$replace = array("%20");
		$zipurl = (str_replace($find,$replace,$zip));
	$metadata = file($dir . $album . ".txt");//file in to an array
	$artist = $metadata[0];
	$year =  $metadata[1];
	$tracknum = $metadata[2];
	$imgloc = $dir . $album . "_Small.jpg";
	$find = array(" ",">");
	$replace = array("%20",">");
	$img = (str_replace($find,$replace,$imgloc));
	   $trackcount = '0';
	   $filecount = scandir($trackdir . '/' . $album); 
	   foreach($filecount as $indiv_file){
	     $path = pathinfo("$indiv_file",PATHINFO_EXTENSION);
	     if ($path == 'mp3'){
		$trackcount++;
	     }
	   $trackno = $trackcount;
	   }

       function formatSizeUnits($bytes)
       {
         if ($bytes >= 1073741824)
         {
             $bytes = number_format($bytes / 1073741824, 2) . ' GB';
         }
         elseif ($bytes >= 1048576)
         {
             $bytes = number_format($bytes / 1048576, 2) . ' MB';
         }
         elseif ($bytes >= 1024)
         {
             $bytes = number_format($bytes / 1024, 2) . ' KB';
         }
         elseif ($bytes > 1)
         {
             $bytes = $bytes . ' bytes';
         }
         elseif ($bytes == 1)
         {
             $bytes = $bytes . ' byte';
         }
         else
         {
             $bytes = '0 bytes';
         }

         return $bytes;
        }
    }else{
	$metadata = "<h3 align='center'>ERROR!!!</h3><br>";
	}

$color = '#FF855C';
//dark - #ff6633  li - #FF7547
$lgtcolor = '#FF916C';
$hexcodes = $color . ', ' . $lgtcolor . ', ' . $color;

?>
<!DOCTYPE HTML>
<html>
<head>
<meta charset="UTF-8">
<title>Albums - Daniel's Website</title>
<style type="text/css">
 /* put a border around the canvas element */
 canvas {
 
    border-style:solid; 
    border-width:1px; 
    padding:3px; 
 }

<?php include($_SERVER['DOCUMENT_ROOT'] . '/headers.php'); ?>

</style>
<link rel="stylesheet" type="text/css" href="/style.css">
<link rel="shortcut icon" href="/lion_icon.ico">
<!-- <script src="audiojs/audio.min.js"></script>
<script>
  audiojs.events.ready(function() {
    var as = audiojs.createAll();
  });
</script>
-->
<script type="text/javascript">
//display and update progress bar
            function progressBar(track) {
                var canvas = document.getElementById('progbar' + track);
                var oAudio = document.getElementById('controls' + track); 
                //get current time in seconds
                var elapsedTime = Math.round(oAudio.currentTime);
                //update the progress bar
                if (canvas.getContext) {
                    var ctx = canvas.getContext("2d");
                    //clear canvas before painting
                    ctx.clearRect(0, 0, canvas.clientWidth, canvas.clientHeight);
                    ctx.fillStyle = "#FF6633";
                    var fWidth = (elapsedTime / oAudio.duration) * (canvas.clientWidth);
                    if (fWidth > 0) {
                        ctx.fillRect(0, 0, fWidth, canvas.clientHeight);
                    }
                }
            }

            //added events
            function initEvents(track) {
                var canvas = document.getElementById('progbar' + track);  
                var oAudio = document.getElementById('controls' + track);

                //set up event to update the progress bar
                oAudio.addEventListener("timeupdate",  function(){progressBar(track)}, true); 
                //set up mouse click to control position of audio
                canvas.addEventListener("click", function(e) {
                    //this might seem redundant, but this these are needed later - make global to remove these
                   // var oAudio = document.getElementById('myaudio'); 
                   // var canvas = document.getElementById('canvas');            

                    if (!e) {
                        e = window.event;
                    } //get the latest windows event if it isn't set
                    try {
                        //calculate the current time based on position of mouse cursor in canvas box

                    //if(!e.hasOwnProperty('offsetX')) {var xpos = (e.layerX - e.currentTarget.offsetLeft)- '112';
                    //}else{
                    //   var xpos = e.offsetX - '5';
                    //}
                       var xpos = e.offsetX - '5';
                   oAudio.currentTime = oAudio.duration * (xpos / canvas.clientWidth);
                    }
                    catch (err) {
                    // Fail silently but show in F12 developer tools console
                        if (window.console && console.error("Error:" + err));
                    }
                }, true);
            }
//End of Progress bar

function fullscreen(target){
//target is id of element to make full
element = document.getElementById(target);
var fullscreenElement = document.fullscreenElement || document.mozFullScreenElement || document.webkitFullscreenElement;
  if (fullscreenElement == null && (document.fullscreenEnabled || document.mozFullScreenEnabled || document.webkitFullscreenEnabled)){
element.style.backgroundColor = '#CCCCFF';
document.getElementById('ficon').style.display = "block";
     if(element.requestFullscreen) {
       element.requestFullscreen();
     } else if(element.mozRequestFullScreen) {
       element.mozRequestFullScreen();
     } else if(element.webkitRequestFullscreen) {
       element.webkitRequestFullscreen();
     } else if(element.msRequestFullscreen) {
       element.msRequestFullscreen();
     }
  }else{
element.style.backgroundColor = 'transparent';
document.getElementById('ficon').style.display = "none";
     if(document.exitFullscreen) {
       document.exitFullscreen();
     } else if(document.mozCancelFullScreen) {
       document.mozCancelFullScreen();
     } else if(document.webkitExitFullscreen) {
       document.webkitExitFullscreen();
     } else if(document.msExitFullscreen()) {
       document.msExitFullscreen();
     }
  }
}


function showplayer(id) {
  var player = document.getElementById("playercontainer" + id);
  player.style.display = "table-row";
}

function hideplayer(id) {
  var player = document.getElementById("playercontainer" + id);
  player.style.display = "none";
  pause(id);
}

function pause(id){
    var controls = document.getElementById("controls" + id);
    var playimg = document.getElementById("play" + id);
    var pauseimg = document.getElementById("pause" + id);
    controls.pause();
    playimg.style.display = 'inline';
    pauseimg.style.display = 'none';
}

function toggleplayer(id) {
       var player = document.getElementById("playercontainer" + id);
//       times(id);
       if(player.style.display == 'table-row'){
          player.style.display = 'none';
          pause(id);
       }else{
          player.style.display = 'table-row';
      }
}

function mute(id) {
       var muteimg = document.getElementById("mute" + id);
       var unmuteimg = document.getElementById("unmute" + id);

       if(document.getElementById("controls" + id).muted == true){
          document.getElementById("controls" + id).muted = false;
          muteimg.style.display = 'inline';
          unmuteimg.style.display = 'none';
       }else{
          document.getElementById("controls" + id).muted = true;
          muteimg.style.display = 'none';
          unmuteimg.style.display = 'inline';
       }
}

function playpause(id) {
       var playimg = document.getElementById("play" + id);
       var pauseimg = document.getElementById("pause" + id);
       var controls = document.getElementById("controls" + id);
       if(controls.duration > 0 && !controls.paused){
          document.getElementById("controls" + id).pause();
          playimg.style.display = 'inline';
          pauseimg.style.display = 'none';
       }else{
          document.getElementById("controls" + id).play(); 
          playimg.style.display = 'none';
          pauseimg.style.display = 'inline';
          initEvents(id)
       }
}

function nextprev(id,nextid) {
       var player = document.getElementById("playercontainer" + id);
       var nextplayer = document.getElementById("playercontainer" + nextid);
       var playimg = document.getElementById("play" + id);
       var nextplayimg = document.getElementById("play" + nextid);
       var pauseimg = document.getElementById("pause" + id);
       var nextpauseimg = document.getElementById("pause" + nextid);
       var controls = document.getElementById("controls" + id);
       var nextcontrols = document.getElementById("controls" + nextid);
       controls.pause();
       playimg.style.display = 'inline';
       pauseimg.style.display = 'none';
       player.style.display = 'none';
       nextplayer.style.display = 'table-row';
       nextcontrols.play();
       nextplayimg.style.display = 'none';
       nextpauseimg.style.display = 'inline';
       initEvents(nextid)
       nextcontrols.oncanplay=nextcontrols.currentTime = '0';
}

function controls(id) {
//player = document.getElementById("controls" + id).controls;
var player = document.getElementById("dfltctrls" + id);
if(player.style.display == 'inline'){var attribute = "none"}else if(player.style.display == 'none'){var attribute = "inline"}
player.style.display = attribute;
}

function playertype(id){
       var flashimg = document.getElementById("flash" + id);
       var html5img = document.getElementById("html5" + id);
       var controls = document.getElementById("controls" + id);
       if(document.getElementById("controls" + id)){
         var span = document.createElement("span");
         var fplayer = controls.innerHTML
         span.innerHTML = fplayer;
         controls.parentNode.replaceChild(span, controls);
         span.setAttribute("id", "fcontrols" + id);
         flashimg.style.display = 'none';
         html5img.style.display = 'inline';
       }else{
         var audio = document.createElement("audio");
         var fcontrols = document.getElementById("fcontrols" + id);
         var fplayer = fcontrols.innerHTML
         audio.innerHTML = fplayer;
         fcontrols.parentNode.replaceChild(audio, fcontrols);
         audio.setAttribute("preload", "none");
         audio.setAttribute("id", "controls" + id);
         audio.setAttribute("controls", "");
         var nxttrack = parseInt(id) + 1;
         audio.setAttribute("onended", "nextprev(" + id + ',' + nxttrack  + ')');
         document.getElementById("fcontrols" + id); 
         flashimg.style.display = 'inline';
         html5img.style.display = 'none';
       }
}

function fwd(id) {
       var controls = document.getElementById("controls" + id);
       controls.currentTime +=5;
}

function bwd(id) {
       var controls = document.getElementById("controls" + id);
       controls.currentTime -=5;
}

function stop(id) {
var playimg = document.getElementById("play" + id);
var pauseimg = document.getElementById("pause" + id);
var audioElement = document.getElementById("controls" + id);
audioElement.pause();
// On stop Scroll to end
// audioElement.currentTime = audioElement.duration - '0.5';
// On stop scroll to start
audioElement.currentTime = '0';
playimg.style.display = 'inline';
pauseimg.style.display = 'none';
}

function times(id){
function zeroFill( number, width ){
  width -= number.toString().length;
  if ( width > 0 ){
    return new Array( width + (/\./.test( number ) ? 2 : 1) ).join( '0' ) + number;
  }  return number + ""; // always return a string
}
audio=document.getElementById("controls" + id);
setInterval(getCurTime,1000);
function getCurTime(){
  var current = timeminsec(audio.currentTime)
  var total = timeminsec(audio.duration)
    function timeminsec(input){
       var currentmin = Math.floor(input * '0.0166667') ;
       var currentminsec = Math.floor(currentmin * '60') ;
       var currentsec = Math.floor(input);
       var currentdiff = zeroFill(currentsec - currentminsec,'2');
       var result = currentmin + ':' + currentdiff
     return result;
     }
 document.getElementById("time" + id).innerHTML=current + '/' + total;
 } }

</script>
</head>
<body>
<div class="head headtext"  style="z-index:0;">
   <div style="width:100%;height:30px;top:25px;position:absolute;z-index:-1;" class="center">Here's the Album</div>

   <div class="button right homeicon">
      <a href="/index.html"><img src="/home2.png" alt="Go to the Homepage" class="" style="max-width:70; height:70px;"></a>
   </div>
</div>
<br><br><br><br>
<!--
<div class="header">
<br>
<a href="http://raspberrypi.org"><img src="/raspberry.png" alt="Raspberry Pi Logo" class="left"></a>
<a href="/index.html"><img src="/home.png" alt="Go to Index" class="right"></a>
<h1 class="headtext">Hello there!</h1>
<p class="largetext">Here is the Album!</p>
<br>
</div>
-->
<a href="index.php"><img src="/back.png" alt="Back" class="left" style="width:auto; height:90px"></a>
<div class="albuminfo">
<img src="<?php echo $img ?>" alt="Album Art" class="left" style="padding:5px;margin-left:0px;">
<p class="largetext"><?php echo $album ?><br>
<?php echo $artist ?><br>
<?php echo $year ?><br>
<?php echo $trackno ?> Tracks</p>
</div>
<div class="albuminfo" style="text-align:center;"><a href="<?php echo $zipurl ?>">Download Full Album (<?php echo formatSizeUnits(filesize($trackdir . $album . ".zip")) ?>)</a></div>
<div class="albuminfo" style="text-align:center;">Click a song to play it.<br><noscript style="font-weight:bold;color:red;">Please, please enable Javascript to play the music in your browser.</noscript></div><br>
<div id="tracklist" style="width:100%;height:100%;">
<span class="Button" title="FullScreen" style="width:40px;height:35px;vertical-align:top;" onclick="fullscreen('tracklist')">
  <img src="fullscreen.png" alt="Fullscreen" style="vertical-align:middle;"> </span>
<img src="<?php echo $img ?>" alt="Album Art" id="ficon" class="right" style="display:none;">
<table class="tracks largetext">
<tr><th style="width:5%;">Track</th><th style="width:85%;">Song Title
</th><th style="width:10%;">Download</th></tr>
<?php include ('songlist.php')?>
</table>
</div>
<br>
<p>
    <a href="http://www.w3.org/html/logo/"><img
      src="/HTML5_Logo_64.png" alt="HTML 5"></a>
  </p>
</body>
</html>