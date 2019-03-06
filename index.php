<?php
// $dir = "/albums/album_data/";
$dir = "album_data";

$color = '#FF855C';
//dark - #ff6633  li - #FF7547
$lgtcolor = '#FF916C';
$hexcodes = $color . ', ' . $lgtcolor . ', ' . $color;

?>
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Albums - Daniel's Website</title>
<link rel="stylesheet" type="text/css" href="/style.css">
<link rel="shortcut icon" href="/lion_icon.ico">

<link rel="apple-touch-startup-image" href="/albumsstartup.png">
<link rel="apple-touch-icon-precomposed" href="/albumsicon.png">
<meta name="apple-mobile-web-app-capable" content="yes">
<meta name="apple-mobile-web-app-status-bar-style" content="black">

<style>
<?php include($_SERVER['DOCUMENT_ROOT'] . '/headers.php'); ?>
</style>
</head>
<body>
<div class="head headtext" style="z-index:0;">
   <div style="width:100%;height:30px;top:25px;position:absolute;z-index:-1;" class="center">Albums</div>

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
<p class="largetext">Choose an Album</p>
<br>
</div>
-->
<br>
<table class="center"><tr><?php include('albumlist.php') ?></tr>
<tr>
<td class="center" style="width:230px">
<a href="edit.php"><img src="add.png" alt="New"></a><br>Add Album
</td></td><td colspan="3"></td></tr></table>
<br>
<p>
    <a href="http://validator.w3.org/check?uri=referer"><img
      src="/HTML5_Logo_64.png" alt="HTML 5"></a>
  </p>
</body>
</html>