<?php

$counter = '0';
$files = scandir($trackdir . '/' . $album); 
foreach($files as $ind_file){ 

	$path = pathinfo("$ind_file",PATHINFO_EXTENSION);
if ($ind_file == '.' || $ind_file == '..'){

}else{
	if ($path == 'mp3'){
		$counter++;
                $next = $counter + "1";
                $prev = $counter - "1";
		$path = $trackdir . '/' . $album . '/' . $ind_file;
		$name = basename($ind_file,".mp3"); 
		$find = array(" ","[","]");
		$replace = array("%20","%5B","%5D");
		$url = (str_replace($find,$replace,$path));

		$basename = pathinfo($ind_file);
		$pathogg = $trackdirogg . '/' . $album . '/' . $basename['filename'] . ".ogg";
		$urlogg =  (str_replace($find,$replace,$pathogg));

                $eocheck = $counter;
               if ($eocheck % 2 == 0) {
                 $col = "#FFFFFF";
               }else{
                 $col = "#FFFFFF";
               }
?>
<tr onclick="toggleplayer('<?php echo $counter ?>')" style="background-color:<?php echo $col ?>;cursor:pointer;" onmouseover="this.style.backgroundColor='#DDDDDD';" onmouseout="this.style.backgroundColor='#ffffff';">
<td><?php echo $counter ?></td><td><?php echo $name ?></td><td><a href="<?php echo $url ?>">Download</a></td></tr>
<tr id="playercontainer<?php echo $counter ?>" class="centertext" style="display:none;">
<td colspan="3"><span class="Button left" title="Close Player" style="width:40px; height:35px; cursor:pointer; vertical-align:top;" onclick="hideplayer('<?php echo $counter ?>')"> X </span>
<span class="Button center" title="Play/Pause" style="width:40px; height:35px; vertical-align:top;" onclick="playpause('<?php echo $counter ?>')">
  <img src="play.png" alt="Play" id="play<?php echo $counter ?>" style="display:inline; vertical-align:middle;">
  <img src="pause.png" alt="Pause" id="pause<?php echo $counter ?>" style="display:none; vertical-align:middle;"> </span>
<span class="Button center" title="Stop" style="width:50px; height:35px; vertical-align:top;" onclick="stop('<?php echo $counter ?>')">
  <img src="stop.png" alt="Stop" style="vertical-align:middle;"> </span>
<span class="center" style="vertical-align:top;">
  <canvas id="progbar<?php echo $counter ?>" title="Seek"  width="300" height="27">canvas not supported</canvas> </span>
<span class="Button center" title="Previous" style="width:50px; height:35px; vertical-align:top;" onclick="nextprev('<?php echo $counter ?>','<?php echo $prev ?>')">
  <img src="prev.png" height="36" width="40" alt="Previous" style="vertical-align:middle;"> </span>
<span class="Button center" title="Next" style="width:50px; height:35px; vertical-align:top;" onclick="nextprev('<?php echo $counter ?>','<?php echo $next ?>')">
  <img src="next.png" height="36" width="40" alt="Next" style="vertical-align:middle;"></span>
<span class="Button center" title="Sound On/Off" style="width:40px; height:35px; vertical-align:top;" onclick="mute('<?php echo $counter ?>')">
  <img src="soundon.png" alt="Mute" id="mute<?php echo $counter ?>" style="display:inline; vertical-align:middle;"> 
  <img src="soundoff.png" alt="UnMute" id="unmute<?php echo $counter ?>" style="display:none; vertical-align:middle;"></span>

<span class="Button center" title="Toggle Default Controls" style="width:50px; height:35px; vertical-align:top;" onclick="controls('<?php echo $counter ?>')">
  <img src="controls.png" alt="Controls" style="vertical-align:middle;"> </span>

<!--<span class="center" style="display:inline; height:30px;">
  <p class="center" id="time<?php echo $counter ?>">0:00/0:00</p></span>-->

<span id="dfltctrls<?php echo $counter ?>" style="display:none;" class="right">
<audio id="controls<?php echo $counter ?>" preload="none" onended="nextprev('<?php echo $counter ?>','<?php echo $next ?>')" controls><source src="<?php echo $url ?>" type="audio/mpeg"><!--<source src="<?php echo $urlogg ?>"" type="audio/ogg">-->
<object type="application/x-shockwave-flash" data="player.swf" width="200" height="30">
     <param name="movie" value="player.swf" />
     <param name="FlashVars" value="mp3=<?php echo $url ?>" />
Your browser doesn't support HTML5 audio or Flash.
</object></audio>
<span class="Button" title="Toggle Html5/Flash Player" style="width:40px; height:35px; vertical-align:top;" onclick="playertype('<?php echo $counter ?>')">
  <img src="flash.png" alt="Flash" id="flash<?php echo $counter ?>" style="display:inline; vertical-align:middle;">
  <img src="html5.png" alt="Html5" id="html5<?php echo $counter ?>" style="display:none; vertical-align:middle;"> </span>
</span>

</td></tr>

<?php
}
}
}
// $trackno = $counter;
?>