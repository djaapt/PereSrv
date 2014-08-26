<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<?php //Include the header - header starts the html and body tags
include '../header.php'; ?>

<div id="info">
Back To Settings: <a href="settings.php"><span>Settings</span></a><br><br>

<?php
$TEST = "../Seasons/24/Season 01";
function getDirContentsShows($dir)
{
	$FILEEXTTOSCAN = array('mkv','webm','MKV','WEBM');
	$DIRSNOTTOSCAN = array('.','..','fileNice');
	$handle = opendir($dir);
	if ( !$handle ) return array();
	$contents = array();
	while ( $entry = readdir($handle) )
	{
		if ( in_array($entry, $DIRSNOTTOSCAN)) continue;
		if ( !in_array(pathinfo($entry,PATHINFO_EXTENSION), $FILEEXTTOSCAN)) continue;
		$entry = $dir.DIRECTORY_SEPARATOR.$entry;
		if ( is_file($entry) )
		{
		$contents[] = $entry;
		}
		else if ( is_dir($entry) )
		{
			$contents = array_merge($contents, getDirContentsShows($entry));
		}
	}
  closedir($handle);
  return $contents;
}

$filesshows = getDirContentsShows($TEST);
echo implode(",",$filesshows);
?>


<?php //Include the footer - The footer ends the body and html tags </div> tag ends in footer
include '../footer.php'; ?>