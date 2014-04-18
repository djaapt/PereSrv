<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<?php //Include the header - header starts the html and body tags
include 'header.php'; ?>
<div id="info">
<video height="340" width="480" controls poster="images/logo.png">
<source src=" . $_GET["name"] . " type="video/webm">
</video> 
<?php //Include the footer - The footer ends the body and html tags </div> tag ends in footer
include 'footer.php'; ?>