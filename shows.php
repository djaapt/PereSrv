<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<?php //Include the header - header starts the html and body tags
include 'header.php'; ?>

<div id="info">
Shows <br><br>
<?php
//Build the connection to SQL server
include '/media/dbinfo.php';

//DB connection variable to call later
$DBC = mysqli_connect($HOST,$USER,$PASS,$DBASE) or die ('Unable to select Database');

//Build query to check for duplicates already in the database
$SHOWQUERY = "SELECT showname FROM $TABLE";
$GETSHOW = mysqli_query($DBC,$SHOWQUERY);
while($ROW = mysqli_fetch_array($GETSHOW)){
$SHOW = $ROW['showname'];
$SHOWPATH = "./Disk1/".$SHOW;
echo ('<a href="'$SHOWPATH'">'$SHOW'</a></br>');
}

mysqli_close($DBC);

//Include the footer - The footer ends the body and html tags </div> tag ends in footer
include 'footer.php'; ?>