<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<?php //Include the header - header starts the html and body tags
include 'header.php'; ?>
<div id="info">
<?php
$File = $_GET["name"];
$Title = preg_replace('/\.[^.]*$/', '', $File); 
echo  "<H1>$Title</H1><br>";
echo '<video height="340" width="480" controls poster="images/logo.png">';
echo '<source src="Videos/'.$File.'" type="video/webm">';
echo '</video>';
?> 
<?php //Include the footer - The footer ends the body and html tags </div> tag ends in footer
include 'footer.php'; ?>