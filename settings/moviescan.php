<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<?php //Include the header - header starts the html and body tags
include '../header.php'; ?>

<div id="info">
Back To Settings: <a href="settings.php"><span>Settings</span></a><br><br>
<?php
//Set files/dirs to exclude from array
$EXCLUDE_LIST = array(".","..",".htaccess","index.php","fileNice");
$EXCLUDE_LIST_PRINTABLE = implode(", ", $EXCLUDE_LIST);
//Unwanted characters in query for later
function clean_up( $TEXT ){
	//Add any other characters to be removed inside the array
	$FIXAPOSTROPHE = array("'",);
	return str_ireplace($FIXAPOSTROPHE, "''", $TEXT);
}

//Build the connection to SQL server
include '/media/dbinfo.php';

//DB connection variable to call later
$TABLE = "movies";
$DBC = mysqli_connect($HOST,$USER,$PASS,$DBASE) or die ('Unable to select Database');

//Set media directory's 
$MOVIEDIR = BASEPATH."/Videos/";

//Scans the directory and runs it through the cleanup function we created
$MOVFILES = clean_up(array_diff(scandir($MOVIEDIR),$EXCLUDE_LIST));

//This one is just for testing, we won't use it in the final version
echo "Files in the Directory $MOVIEDIR not showing the excluded list: $EXCLUDE_LIST_PRINTABLE:<br><br>";
$MOVFILES1 = implode(", ", clean_up(array_diff(scandir($MOVIEDIR),$EXCLUDE_LIST)));

//Print results from the test array
echo "$MOVFILES1";

//DB connection variable to call later
$DBC = mysqli_connect($HOST,$USER,$PASS,$DBASE) or die ('Unable to select Database');

//Build query to check for duplicates already in the database
$DUPQUERY = "SELECT moviename FROM $TABLE";
$DUPRESULT = mysqli_query($DBC,$DUPQUERY );
while($ROW = mysqli_fetch_array($DUPRESULT)) {
	$ROWS[] = $ROW;
}
$EXISTING = array();
foreach($ROWS as $ROW) {
	$EXISTING[] = $ROW['moviename'];
}
$RESULT1 = implode(", ",$EXISTING);

echo "<br><br><br>Data That is currently in the MYSQL DB:<br><br>";
echo $RESULT1;
mysqli_close($DBC);
echo "<br><br>";

//Compare the 2 arrays $MOVFILES1 with $RESULT1 and return only non-duplicates
$REMOVEDUPS = array_diff(explode(", ",$MOVFILES1),explode(", ",$RESULT1));
echo "Comparison between data currently in the MYSQL DB and our directory scan showing only items that are not in both.<br><br>";
//Check to see if there are any differences, if there are send them to the Database.
if (empty($REMOVEDUPS)) {
	echo "Nothing is new<br><br>";
} else {
	$DBC = mysqli_connect($HOST,$USER,$PASS,$DBASE) or die ('Unable to select Database');
	echo implode(",",$REMOVEDUPS);
	echo "<br><br>";
	//Build the query your going to use
	$MOVQUERY = "INSERT INTO $TABLE";
	//Comma seperates each value and add single quotes(') around each value
	$MOVQUERY .= " VALUES (NULL,'".implode("'),(NULL,'", $REMOVEDUPS)."') ";
	//Print the query
	echo $MOVQUERY;

	//Execute your query and print the error message if there is one
	//If Error querying database. is not printed it was successful
	mysqli_query($DBC, $MOVQUERY) or die('Error querying database.');

	//Close Database connection
	mysqli_close($DBC);
}
if(is_resource($DBC) && get_resource_type($DBC) === 'mysql link')
{
    return mysql_close($DBC);
}
else
{
    return false;
}

//Take the items we added to the table and lookup the information on them
?>

<?php //Include the footer - The footer ends the body and html tags </div> tag ends in footer
include BASEPATH.'/footer.php'; ?>
