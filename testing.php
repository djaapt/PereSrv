<?php
header("Cache-Control: no-cache, must-revalidate"); // HTTP/1.1
header("Expires: Sat, 26 Jul 1997 05:00:00 GMT"); // Date in the past

system('/usr/bin/ffmpeg -i /var/www/PereSrv/Videos/Brave.2012.mp4 -f webm -y -b:v BITRATE -vprofile baseline -threads 4 -map 0:v -map 0:a:0 -b:a 160000 -ac 2 -start_number 1 /tmp/stream.m3u8');

?>
