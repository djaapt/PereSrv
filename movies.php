<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<?php //Include the header - header starts the html and body tags
include('header.php');
?>

<div id="info">
Movies <br><br>
<?php
//Build the connection to SQL server
include '/media/dbinfo.php';

//DB connection variable to call later
$TABLE = "movies";
$DBC = mysqli_connect($HOST,$USER,$PASS,$DBASE) or die ('Unable to select Database');

//List Number of Movies
$MOVCOUNT = mysqli_num_rows(mysqli_query($DBC, "SELECT moviename FROM $TABLE"));
echo "Total number of Movies: $MOVCOUNT<br><br>";

//Build query to check for duplicates already in the database
$QUERY = "SELECT moviename FROM $TABLE";
$GET = mysqli_query($DBC,$QUERY);
while($ROW = mysqli_fetch_array($GET)){
$MEDIA = $ROW['moviename'];
$PATH = "/Videos/".$MEDIA;
echo '<a href="player.php?name='.$MEDIA.'">'.$MEDIA.'</a></br>';
}
mysqli_close($DBC);

//Include the footer - The footer ends the body and html tags </div> tag ends in footer
include_once 'footer.php'; ?>