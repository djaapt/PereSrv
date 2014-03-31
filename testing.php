<?php
header("Cache-Control: no-cache, must-revalidate"); // HTTP/1.1
header("Expires: Sat, 26 Jul 1997 05:00:00 GMT"); // Date in the past

system('/usr/bin/ffmpeg -i /var/www/PereSrv/Videos/Brave.2012.mp4 -f webm -y -b:v BITRATE -vprofile baseline -preset medium -x264opts level=41 -threads 4 -s RESOLUTION -map 0:v -map 0:a:0  -c:a libfaac -b:a 160000 -ac 2   -hls_time 10 -hls_list_size 6 -hls_wrap 18 -start_number 1 /tmp/stream.m3u8');

?>
