<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<?php //Include the header - header starts the html and body tags
include '../header.php'; ?>

<div id="info">
Back To Settings: <a href="settings.php"><span>Settings</span></a><br><br>

<!-- Define what folders have what type of media in them -->
<?php
$SHOWS = "../Seasons";
$MOVIES = "../Videos";
$MUSIC = "../Music";

echo "TV Shows file location: $SHOWS<br>";
echo "Movies file location: $MOVIES<br>";
echo "Music file location: $Music";
?>


<?php //Include the footer - The footer ends the body and html tags </div> tag ends in footer
include '../footer.php'; ?>