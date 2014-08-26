<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<?php //Include the header - header starts the html and body tags
include '../header.php'; ?>

<div id="info">
Back To Settings: <a href="settings.php"><span>Settings</span></a><br><br>

<?php
$FILEEXTTOSCAN = array('mkv','webm','MKV','WEBM');
$entry = "test.php";
$test = if ( !in_array(pathinfo($entry,PATHINFO_EXTENSION), $FILEEXTTOSCAN))
echo $test;
?>


<?php //Include the footer - The footer ends the body and html tags </div> tag ends in footer
include '../footer.php'; ?>