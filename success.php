<!DOCTYPE HTML>
<html>
<head>
<meta charset="UTF-8">
<title>Albums - Daniel's Website</title>
<link rel="stylesheet" type="text/css" href="style.css">
<link rel="shortcut icon" href="/lion_icon.ico">
<meta http-equiv="refresh" content="14; url=index.php">
<script>
window.onload = function() {
    var countdownElement = document.getElementById('countdown'),
        seconds = 10,
        second = 0,
        interval;

    interval = setInterval(function() {
        countdownElement.firstChild.data = 'Redirecting to Menu in ' + (seconds - second) + ' seconds Better be quick!!!';
        if (second >= seconds) {
            window.location.href = 'index.php';
            clearInterval(interval);
        }

        second++;
    }, 1000);
}
</script>
</head>
<body>

<div class="header">
<br>
<a href="http://raspberrypi.org"><img src="/raspberry.png" alt="Raspberry Pi Logo" class="left"></a>
<a href="/index.html"><img src="/home.png" alt="Go to Index" class="right"></a>
<h1>Added a new Album!</h1>
<p id="countdown">Redirecting to Menu in 10 seconds Better be quick!!!</p>
<br>
</div>

<div class="centerwhite"><h2>Album Uploaded!!</h2><br>
<div style="width: 50%; float:left" class="centerwhite">
<a href="index.php"><img src="menu.png" alt="Menu"></a>
<p class="center">To the Menu</p>
</div>
<div style="width: 50%; float:right" class="centerwhite">
<a href="edit.php"><img src="add.png" alt="Add another Album"></a>
<p class="center">Add another Album</p>
</div>
</div>

</body>

</html>
