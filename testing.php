<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<?php //Include the header - header starts the html and body tags
include_once 'header.php'; ?>

<?php
//Build the connection to SQL server
include '/media/dbinfo.php';

session_start();
$username = $_SESSION['username'];

//DB connection variable to call later
$TABLE = "members";
$DBC = mysqli_connect($HOST,$USER,$PASS,$DBASE) or die ('Unable to select Database');

$query="SELECT * FROM $TABLE where username=$username";
$query_run=mysqli_query($DBC,$query);
echo $query_run;
?>

<?php //Include the footer - The footer ends the body and html tags </div> tag ends in footer
include_once 'footer.php'; ?>