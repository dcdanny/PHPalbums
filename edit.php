<?php
if (empty($_POST)) {

} elseif (isset($_POST["album"]) && isset($_POST["artist"]) && is_numeric($_POST["year"])) {
   $album = $_POST['album'];
   $artist = $_POST['artist'];
   $year = $_POST['year'];
   $track_path = 'album_tracks/MP3/';
   $albumart_path = 'album_data/';
   $metadata = $artist . PHP_EOL . $year . PHP_EOL;
   $albumtxt = $album . ".txt";
   if(move_uploaded_file($_FILES['albumart']['tmp_name'], $albumart_path . $album . "_Large.jpg")) {
           include('SimpleImage.php');
	   $image = new SimpleImage();
	   $image->load($albumart_path . $album . "_Large.jpg");
	   $image->resize(200,200);
	   $image->save($albumart_path . $album . "_Large.jpg");
	   $image = new SimpleImage();
	   $image->load($albumart_path . $album . "_Large.jpg");
	   $image->resize(75,75);
	   $image->save($albumart_path . $album . "_Small.jpg");
          if(move_uploaded_file($_FILES['tracks']['tmp_name'], $track_path . $album . ".zip")) {
	      $ziploc = $track_path . $album;
	      $ziploc2 = "\"" . $track_path . $album . "\"";
	      mkdir($ziploc);
	      $zipfile = "\"" . $track_path . $album . ".zip\"";
	      shell_exec("unzip $zipfile -d $ziploc2");
	     if(file_put_contents($albumtxt , $metadata)){
		rename($albumtxt,$albumart_path . $albumtxt);
//              echo "The file ".  basename( $_FILES['tracks']['name']). " has been uploaded" . header("Location: $success");
		header("Location: success.php");
           }else{
               $errors = "There was an ERROR adding metadata, please try again!";
           }
       }else{
           $errors = "There was an ERROR uploading the tracks, please try again!";
       }
   }else{
       $errors = "There was an ERROR uploading the album art, please try again!";
   }
}else{
$errors = "Form not filled in correctly";
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
<link rel="stylesheet" type="text/css" href="/style.css">
<style>
<?php include($_SERVER['DOCUMENT_ROOT'] . '/headers.php'); ?>
</style>
<link rel="shortcut icon" href="/lion_icon.ico">
<script type="text/javascript">

function showDiv() {
   document.getElementById("errors").innerHTML = '';
   document.getElementById('loadmsg').style.display = "block";
   setTimeout(function(){document.getElementById('loadmsg4').style.display = "inline";},2000);
   setTimeout(function(){document.getElementById('loadmsg2').style.display = "inline";document.getElementById('loadmsg4').style.display = "none";},10000);
   var dots = setInterval(function(){loading()}, 1000);
}

function loading() {
window.element = document.getElementById("loadmsg3");
if(element.innerHTML == '.'){element.innerHTML = '..';
}else if(element.innerHTML == '..'){element.innerHTML = '...';
}else if(element.innerHTML == '...'){element.innerHTML = '';
}else{element.innerHTML = '.';
}

}
</script>
</head>
<body>
<div class="head headtext" style="z-index:0;">
   <div style="width:100%;height:30px;top:25px;position:absolute;z-index:-1;" class="center">New Album</div>

   <div class="button right homeicon">
      <a href="/index.html"><img src="/home2.png" alt="Go to the Homepage" class="" style="max-width:70; height:70px;"></a>
   </div>
</div>
<br><br><br><br>

<!--<div class="header">
<br>
<a href="http://raspberrypi.org"><img src="/raspberry.png" alt="Raspberry Pi Logo" class="left"></a>
<a href="/index.html"><img src="/home.png" alt="Go to Index" class="right"></a>
<h1>Add a new Album!</h1>
<p>Just fill in the info below</p>
<br><br>
</div>-->

<a href="index.php"><img src="/back.png" alt="Back" class="left" style="width:auto; height:90px"></a>
<br>
<div id="loadmsg"  style="display:none;" class="centerwhite"><p class="largetext">Uploading and Saving Album<span id="loadmsg4" style="display:none;"><br>This may take a while.</span>
  <span id="loadmsg2" style="display:none;"><br>Still going. Please be patient
    <span id="loadmsg3">...</span>
  </span>
</p></div>
<div class="centerwhite"><p id="errors" class="largetext"><?php echo $errors ?></p></div>
<form action="" method="post" enctype="multipart/form-data" onsubmit="showDiv()">
<table class="centerblock">
<tr><td>Album Name:</td><td><input type="text" name="album" maxlength="30" size="28" required></td></tr>
<tr><td>Album Artist(s):</td><td><input type="text" name="artist" maxlength="20" size="28" required></td></tr>
<tr><td>Album release Year:</td><td><input type="number" name="year" min="1000" max="<?php echo date("Y"); ?>" required></td></tr>
<tr><td>Album Artwork*:</td><td><input name="albumart" type="file" accept="image/jpeg"></td></tr>
<tr><td>Tracks**:</td><td><input name="tracks" type="file"></td></tr>
<tr><th colspan="2"><hr></th></tr>
<tr><th colspan="2"><input type="submit" value="Save Album"></th></tr>
</table>
</form>
<br>
<div class="centerblockwhite">
<p>* Album art should be JPEG format (.jpg)</p>
</div>
<div class="centerblockwhite">
<p>** Tracks should be uploaded in a zip file containing each track in MP3 format and the name beginning with the track number</p><p>e.g. 01 song name.mp3</p><p>Maximum total upload size of music in one album is 150MB.</p>
</div>
</body>

</html>