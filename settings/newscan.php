<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<?php //Include the header - header starts the html and body tags
include '../header.php'; ?>

<div id="info">
Back To Settings: <a href="settings.php"><span>Settings</span></a><br><br>

<!-- Define what folders have what type of media in them -->
<?php
/*function ListDirFile($DIR){
    $RFS = scandir($DIR);
    echo '<ol>';
    foreach($RFS as $FS){
        if($FS != '.' && $FS != '..'){
            echo '<li>'.$FS;
            if(is_dir($DIR.'/'.$FS)) ListDirFile($DIR.'/'.$FS);
            echo '</li>';
        }
    }
    echo '</ol>';
}*/

$SHOWS = "../Seasons/24";
$MOVIES = "../Videos";
$MUSIC = "../Music";

echo "TV Shows file location: $SHOWS<br>";
echo "Movies file location: $MOVIES<br>";
echo "Music file location: $MUSIC<br><br>";

function getDirContents($dir)
{
  $handle = opendir($dir);
  if ( !$handle ) return array();
  $contents = array();
  while ( $entry = readdir($handle) )
  {
    if ( $entry=='.' || $entry=='..') continue;

    $entry = $dir.DIRECTORY_SEPARATOR.$entry;
    if ( is_file($entry) )
    {
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

/*$TEST = explode(listDirFile("$SHOWS"));
$iterator = new RecursiveIteratorIterator(
    new RecursiveDirectoryIterator($MOVIES),
   RecursiveIteratorIterator::SELF_FIRST
);
foreach ($iterator as $fileObject) {
    $files[] = $fileObject;
    // or if you only want the filenames
    //$files[] = $fileObject->getPathname();
}*/
$files = getDirContents($SHOWS);
echo implode(",",$files);
?>


<?php //Include the footer - The footer ends the body and html tags </div> tag ends in footer
include '../footer.php'; ?>