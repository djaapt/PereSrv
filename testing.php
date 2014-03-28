<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<?php //Include the header - header starts the html and body tags
include 'header.php'; ?>
<?php
extension_loaded('ffmpeg') or die('Error in loading ffmpeg');

echo exec('/usr/bin/ffmpeg -i /var/www/PereSrv/Videos/Brave.2012.mp4 -f webm -vcodec libvpx -acodec libvorbis -aq 90 -ac 2 - 2>$1', $output);
var_dump($output);

$cmd = 'wget -qO- "https://djaapt.com:8443/stream" | /usr/bin/ffmpeg -i /var/www/PereSrv/Videos/Brave.2012.mp4 -f webm -vcodec libvpx -acodec libvorbis -aq 90 -ac 2 -';
//passthru($cmd); 
echo '<video> $cmd</video>';
?>
<?php //Include the footer - The footer ends the body and html tags </div> tag ends in footer
include 'footer.php'; ?>