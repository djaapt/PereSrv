<!DOCTYPE HTML>
<?php //Include the header - header starts the html and body tags
include '../header.php'; ?>

<div id="info">
Back To Settings: <a href="settings.php"><span>Settings</span></a><br><br>

<?php
//Set media directory's 
$SHOWS = "../Seasons";
$MOVIES = "../Videos";
$MUSIC = "../Music";
echo "TV Shows file location: $SHOWS<br>";
echo "Movies file location: $MOVIES<br>";
echo "Music file location: $MUSIC<br><br>";

//Escape commas then fix the array. Can add more to this if we need to clean other things up
function clean_up( $TEXT ){
	$FIND = array(',','\'&#44;\'');
	$REPLACE = array("&#44;","','");
	return str_ireplace($FIND, $REPLACE, $TEXT);
}
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

//Get the contents of the directory excluding values in $DIRSNOTTOSCAN and only files ending with extensions in $FILEEXTTOSCAN
function getDirContents($dir)
{
	$FILEEXTTOSCAN = array('mkv','webm','MKV','WEBM');
	$DIRSNOTTOSCAN = array('.','..','fileNice');
	$handle = opendir($dir);
	if ( !$handle ) return array();
	$contents = array();
	while ( $entry = readdir($handle) )
	{
		if ( in_array($entry, $DIRSNOTTOSCAN)) continue;
		$entry = $dir.DIRECTORY_SEPARATOR.$entry;
		if ( is_file($entry) )
		{
		if (!in_array(pathinfo($entry,PATHINFO_EXTENSION), $FILEEXTTOSCAN)) continue;
		$contents[] = $entry;
		}
		else if ( is_dir($entry) )
		{
			$contents = array_merge($contents, getDirContents($entry));
		}
	}
  closedir($handle);
  return $contents;
}

$filesshows = getDirContents($SHOWS);
$cleanedshows = clean_up(addslashes($filesshows));
echo implode(",",$cleanedshows);

$filesmovie = getDirContents($MOVIES);
//echo implode(",",$filesmovie);

//Build the connection to SQL server
//DB connection variable to call later
$TABLE = "tvshow";
$DBC = mysqli_connect($HOST,$USER,$PASS,$DBASE) or die ('Unable to select Database');
?>


<?php //Include the footer - The footer ends the body and html tags </div> tag ends in footer
include ('../footer.php'); ?>