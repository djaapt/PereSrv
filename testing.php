<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<?php //Include the header - header starts the html and body tags
include 'header.php'; ?>
<?php
// Set our source file
$srcFile = "/Videos/Legion.2009.mkv";
$destFile = "/temp/Legion.flv";
$ffmpegPath = "/usr/bin/ffmpeg";
$flvtool2Path = "/path/to/flvtool2";
// Create our FFMPEG-PHP class
$ffmpegObj = new ffmpeg_movie($srcFile);
// Save our needed variables
$srcWidth = makeMultipleTwo($ffmpegObj->getFrameWidth());
$srcHeight = makeMultipleTwo($ffmpegObj->getFrameHeight());
$srcFPS = $ffmpegObj->getFrameRate();
$srcAB = intval($ffmpegObj->getAudioBitRate()/1000);
$srcAR = $ffmpegObj->getAudioSampleRate();
// Call our convert using exec()
exec($ffmpegPath . " -i " . $srcFile . " -ar " . $srcAR . " -ab " . $srcAB . " -f flv -s " . $srcWidth . "x" . $srcHeight . " " . $destFile . " | " . $flvtool2Path . " -U stdin " . $destFile);
// Make multiples function
function makeMultipleTwo ($value)
{
$sType = gettype($value/2);
if($sType == "integer")
{
return $value;
} else {
return ($value-1);
}
}
?>
<?php //Include the footer - The footer ends the body and html tags </div> tag ends in footer
include 'footer.php'; ?>