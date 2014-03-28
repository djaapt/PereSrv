<?php
header("Cache-Control: no-cache, must-revalidate"); // HTTP/1.1
header("Expires: Sat, 26 Jul 1997 05:00:00 GMT"); // Date in the past

system('/usr/bin/ffmpeg -i /var/www/PereSrv/Videos/Brave.2012.mp4 -f webm -vcodec libvpx -acodec libvorbis -aq 90 -ac 2 -');

?>
