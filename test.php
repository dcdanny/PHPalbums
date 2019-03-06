<?php
   $track_path = 'album_tracks/MP3/';
   $album = "Testing";
if(move_uploaded_file($_FILES['tracks']['tmp_name'], $track_path . $album . ".zip")) {
	      $ziploc = $track_path . $album;
	      mkdir($ziploc);
	      $zipfile = $track_path . $album . ".zip";
	      shell_exec("unzip $zipfile -d $ziploc");
              echo "Done";
}
?>
<form action="" method="post" enctype="multipart/form-data">
Tracks**:<input name="tracks" type="file">
<input type="submit" value="Save Album">
</form>