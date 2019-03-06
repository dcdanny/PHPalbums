<?php

$files = scandir($dir); 
$counter = '0';
foreach($files as $ind_file){ 

	$path = pathinfo("$ind_file",PATHINFO_EXTENSION);
if ($ind_file == '.' || $ind_file == '..'){

}else{
	if ($path == 'txt'){
		$counter++;
		$bpath = $dir . '/' . $ind_file;
		$bname = basename($ind_file,".txt");
		$url = $dir . '/' . $bname . '_Large.jpg'; 
		$find = array(" ",">");
		$replace = array("%20",">");
		$img = (str_replace($find,$replace,$url));
		$lnk = (str_replace($find,$replace,$bname));
		$name = $bname;
		if ($counter == '4'){
		$counter = '0';
?>
<td class="center" style="width:230px"><a href="album.php?a=<?php echo $lnk ?>" onclick="window.location.href='album.php?a=<?php echo $lnk ?>'; event.returnValue = false; return false;"><img src="<?php echo $img ?>" alt="AlbumArt"></a><br><?php echo $name ?></td></tr>
<?php

		}elseif ($counter == '2' || '3'){

?>
<td class="center" style="width:230px"><a href="album.php?a=<?php echo $lnk ?>" onclick="window.location.href='album.php?a=<?php echo $lnk ?>'; event.returnValue = false; return false;"><img src="<?php echo $img ?>" alt="AlbumArt"></a><br><?php echo $name ?></td>
<?php

		}elseif ($counter == '0' || '1'){

?>
<tr><td class="center" style="width:230px"><a href="album.php?a=<?php echo $lnk ?>" onclick="window.location.href='album.php?a=<?php echo $lnk ?>'; event.returnValue = false; return false;"><img src="<?php echo $img ?>" alt="AlbumArt"></a><br><?php echo $name ?></td>
<?php
		}else{
?> 
<tr><td class="center" style="width:230px"><a href="album.php?a=<?php echo $lnk ?>" onclick="window.location.href='album.php?a=<?php echo $lnk ?>'; event.returnValue = false; return false;"><img src="<?php echo $img ?>" alt="AlbumArt"></a><br><?php echo $name ?></td></tr>
<?php
		}

	}elseif ($path == 'jpg'){
		$img = '';
		$name = '';
	}else{
	}
}
}
?>

