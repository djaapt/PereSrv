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
$DUPQUERY = "SELECT showname FROM $TABLE";
$DUPRESULT = mysqli_query($DBC,$DUPQUERY );
while($ROW = mysqli_fetch_array($DUPRESULT)) {
        $ROWS[] = $ROW;
}
$EXISTINGSHOWNAME = array();
foreach($ROWS as $ROW) {
        $EXISTINGSHOWNAME[] = $ROW['showname'];
}
$RESULT1 = implode("i", "<a href='/media/Disk1/$EXISTINGSHOWNAME'>$EXISTINGSHOWNAME)"."</a>";

echo $RESULT1;
mysqli_close($DBC);
echo "<br><br>";


echo '<a href="test">TEST</a>'; 
?>

<?php //Include the footer - The footer ends the body and html tags </div> tag ends in footer
include 'footer.php'; ?>
