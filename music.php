<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<?php //Include the header - header starts the html and body tags
include('header.php');
?>

<div id="info">
MUSIC<br><br>
<?php
//Build the connection to SQL server
include '/media/dbinfo.php';

//DB connection variable to call later
$TABLE = "music";
$DBC = mysqli_connect($HOST,$USER,$PASS,$DBASE) or die ('Unable to select Database');

//Build query to check for duplicates already in the database
$QUERY = "SELECT musicname FROM $TABLE";
$GET = mysqli_query($DBC,$QUERY);
while($ROW = mysqli_fetch_array($GET)){
$MEDIA = $ROW['musicname'];
$PATH = "./Disk2/Music/".$MEDIA;
echo '<a href="'.$PATH.'">'.$MEDIA.'</a></br>';
}

mysqli_close($DBC);

//Include the footer - The footer ends the body and html tags </div> tag ends in footer
include_once 'footer.php'; ?>