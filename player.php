<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<?php //Include the header - header starts the html and body tags
include 'header.php'; ?>
<div id="info">
<?php
$Title = $_GET["name"]; 
echo  "$Title";
echo '<video height="340" width="480" controls poster="images/logo.png">';
echo '<source src="Videos/$Title" type="video/webm">';
echo '</video>';
?> 
<?php //Include the footer - The footer ends the body and html tags </div> tag ends in footer
include 'footer.php'; ?>