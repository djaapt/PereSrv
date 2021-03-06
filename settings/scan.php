<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<?php //Include the header - header starts the html and body tags
include '../header.php'; ?>

<div id="info">
Back To Settings: <a href="settings.php"><span>Settings</span></a><br><br>
<?php
//Set files/dirs to exclude from array
$EXCLUDE_LIST = array(".","..",".htaccess","index.php","fileNice");
$EXCLUDE_LIST_PRINTABLE = implode(", ", $EXCLUDE_LIST);
$INCLUDE_LIST = array("*.mkv","*.webm");
$INCLUDE_LIST_PRINTABLE = implode(", ", $INCLUDE_LIST);

//add the ability to strip slashes from array's and variables not just strings
function addslashesFull($input)
{
    if (is_array($input)) {
        $input = array_map('addslashesFull', $input);
    } elseif (is_object($input)) {
        $vars = get_object_vars($input);
        foreach ($vars as $k=>$v) {
            $input->{$k} = addslashesFull($v);
        }
    } else {
        $input = addslashes($input);
    }
    return $input;
}
//Escape commas then fix the array. Can add more to this if we need to clean other things up
function clean_up( $TEXT ){
	$FIND = array(',','\'&#44;\'');
	$REPLACE = array("&#44;","','");
	return str_ireplace($FIND, $REPLACE, $TEXT);
}
//Build the connection to SQL server
include '/media/dbinfo.php';

//DB connection variable to call later
$TABLE = "tvshow";
$DBC = mysqli_connect($HOST,$USER,$PASS,$DBASE) or die ('Unable to select Database');

//Set media directory's 
$TVSHOWDIR = "../Seasons/";

//Scans the directory and runs it through the clean_up and addslashesFull functions we created
$TVFILES = "'".clean_up(addslashesFull(array_diff(scandir($TVSHOWDIR),$EXCLUDE_LIST)))."'";

//This one is just for testing, we won't use it in the final version
$INCLUDE = "'".implode("', '", clean_up(addslashesFull(array_diff(scandir($TVSHOWDIR),$INCLUDE_LIST))))."'";
echo "$INCLUDE<br><br>";

echo "Files in the Directory $TVSHOWDIR not showing the excluded list: $EXCLUDE_LIST_PRINTABLE:<br><br>";
//We need this part for the final version as it builds our comparison list
$TVFILES1 = "'".implode("', '", clean_up(addslashesFull(array_diff(scandir($TVSHOWDIR),$EXCLUDE_LIST))))."'";

//Print results from the test array
echo "$TVFILES1";

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
$RESULT1 = "'".implode("', '",clean_up(addslashesFull($EXISTINGSHOWNAME)))."'";

echo "<br><br><br>Data That is currently in the MYSQL DB:<br><br>";
echo $RESULT1;
mysqli_close($DBC);
echo "<br><br>";

//Compare the 2 arrays $TVFILES1 with $RESULT1 and return only non-duplicates
$REMOVEDUPS = array_diff(explode(", ",$TVFILES1),explode(", ",$RESULT1));
echo "Comparison between data currently in the MYSQL DB and our directory scan showing only items that are not in both.<br><br>";
//Check to see if there are any differences, if there are send them to the Database.
if (empty($REMOVEDUPS)) {
	echo "Nothing is new<br><br>";
} else {
	$DBC = mysqli_connect($HOST,$USER,$PASS,$DBASE) or die ('Unable to select Database');
	echo implode(",",$REMOVEDUPS);
	echo "<br><br>";
	//Build the query your going to use
	$TVQUERY = "INSERT INTO $TABLE";
	//Comma separates each value and adds the required syntax for insert around each value
	$TVQUERY .= " VALUES (NULL,".implode("),(NULL,", $REMOVEDUPS).") ";

	echo $TVQUERY;

	//Execute your query and print the error message if there is one
	//If Error querying database. is not printed it was successful
	mysqli_query($DBC, $TVQUERY) or die('Error querying database.');

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

//Take the items we added to the showname table and lookup the information on them
?>

<?php //Include the footer - The footer ends the body and html tags </div> tag ends in footer
include '../footer.php'; ?>