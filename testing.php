<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<?php //Include the header - header starts the html and body tags
include 'header.php'; ?>

#!/usr/bin/php -q
<?php
/*
  ffmpeg_transcode.php (version 4.2)
 
  script for encoding video/dvd to avi, mp4, flv and ogg and scaling videos
  using *ONLY* ffmpeg to keep the brainfuck manageable

 
  compile ffmpeg
 
  compile flags for ffmpeg (from their svn)
  flv only: ./configure --enable-gpl --enable-libmp3lame --enable-libx264
  webm only: ./configure --enable-gpl --enable-libmp3lame --enable-libvpx
  flv and H.264: ./configure --enable-gpl --enable-pthreads --enable-libmp3lame --enable-libx264 --enable-libfaac --enable-shared --enable-libopenjpeg
  all: ./configure --enable-libtheora --enable-libx264 --enable-libxvid --enable-libvorbis --enable-nonfree --enable-gpl --enable-pthreads --enable-libmp3lame --enable-libfaac --enable-shared --enable-libopenjpeg --enable-libvpx
  libx264 homepage: http://www.videolan.org/developers/x264.html

  http://ffmpeg.org/ffmpeg.html
*/


function
get_suffix ($filename)
// get_suffix() never returns NULL
{
  $p = basename ($filename);
  if (!$p)
    $p = $filename;

  $s = strrchr ($p, '.');
  if (!$s)
    $s = strchr ($p, 0);
  if ($s == $p)
    $s = strchr ($p, 0);

  return $s;
}


function
set_suffix ($filename, $suffix)
{
//  return str_replace (get_suffix ($filename), $suffix, $filename);
  $s = get_suffix ($filename);
  if (trim ($s) == '')
    return $filename.$suffix;
  return str_replace ($s, $suffix, $filename);
}


// video settings
$ffmpeg_video_opts = '';
$ffmpeg_video_opts .= ' -threads 4'; // threads used for video encoding
//$ffmpeg_video_opts .= ' -vstats'; // stats
//$ffmpeg_video_opts .= ' -vstats_file vstats.log';
//$ffmpeg_video_opts .= ' -pix_fmt rgb8'; // pixel format
//$ffmpeg_video_opts .= ' -g 300'; // group of picture size
//$ffmpeg_video_opts .= ' -bf 2'; // number of B frames
//$ffmpeg_video_opts .= ' -crf (a number)'; // but for 1-pass I prefer to use
//$ffmpeg_video_opts .= ' -s 960x720';
//$ffmpeg_video_opts .= ' -s 640x480';
//$ffmpeg_video_opts .= ' -s 320x180';
//$ffmpeg_video_opts .= ' -s 480x270';
//$ffmpeg_video_opts .= ' -b 256k'; // video bitrate
//$ffmpeg_video_opts .= ' -b 410k'; // gspot hd
//$ffmpeg_video_opts .= ' -b 800k';
//$ffmpeg_video_opts .= ' -b 900k';
//$ffmpeg_video_opts .= ' -b 1024k';
//$ffmpeg_video_opts .= ' -bt 256k'; // video bitrate tolerance
//$ffmpeg_video_opts .= ' -croptop 0 -cropbottom 0 -cropleft 0 -cropright 0'; // cropping
//$ffmpeg_video_opts .= ' -map 0:0 -map 0:2 -map 0:1'; // set input stream mapping
$ffmpeg_video_opts=' -sameq'; // same quality/lossless (instead of all the above)


// audio settings
$ffmpeg_audio_opts = '';
//$ffmpeg_audio_opts .= ' -vol 300'; // change audio volume (default: 256)
//$ffmpeg_audio_opts .= ' -ab 128k'; // audio bitrate
//$ffmpeg_audio_opts .= ' -ar 22050'; // audio rate
//$ffmpeg_audio_opts .= ' -ac 1'; // number of channels
$ffmpeg_audio_opts .= ' -async 2'; // audio sync method


// ps3
function
ffmpeg_transcode_h264_ps3 ($ffmpeg_input)
{
  global $ffmpeg_exe;

  $ffmpeg_opts = '';
  $ffmpeg_opts .= ' -vcodec libx264';
  $ffmpeg_opts .= ' -level 41';
//$ffmpeg_opts .= ' -vpre normal';
//$ffmpeg_opts .= ' -vpre hq';
  $ffmpeg_opts .= ' -crf 24 -threads 0';
  $ffmpeg_opts .= ' -acodec libfaac';
  $ffmpeg_opts .= ' -ab 128k -ac 2 -ar 48000';
//$ffmpeg_opts .= ' -f mp4';
  $ffmpeg_opts .= ' -y';

  return $ffmpeg_exe.' -i "'.$ffmpeg_input.'" '.$ffmpeg_opts.' "'.set_suffix ($ffmpeg_input, '_ps3.mp4').'"';
}


// 1 pass
function
ffmpeg_transcode_avi_1pass ($ffmpeg_input)
{
  global $ffmpeg_exe;
  global $ffmpeg_video_opts;
  global $ffmpeg_audio_opts; 

  $ffmpeg_opts = '';
  $ffmpeg_opts .= ' -vcodec mpeg4';
  $ffmpeg_opts .= $ffmpeg_video_opts;
  $ffmpeg_opts .= ' -acodec libmp3lame';
  $ffmpeg_opts .= $ffmpeg_audio_opts;
  $ffmpeg_opts .= ' -f avi';
  $ffmpeg_opts .= ' -y';

  return $ffmpeg_exe.' -i "'.$ffmpeg_input.'" '.$ffmpeg_opts.' "'.set_suffix ($ffmpeg_input, '_1pass.avi').'"';
}


function
ffmpeg_transcode_h264_1pass ($ffmpeg_input)
{
  global $ffmpeg_exe;
  global $ffmpeg_video_opts;
  global $ffmpeg_audio_opts;
  global $qt_faststart_exe;

  $ffmpeg_opts = '';
  $ffmpeg_opts .= ' -flags +loop';
  $ffmpeg_opts .= ' -coder ac';
  $ffmpeg_opts .= ' -vcodec libx264';
  $ffmpeg_opts .= $ffmpeg_video_opts;
  $ffmpeg_opts .= ' -vpre hq';
  $ffmpeg_opts .= ' -acodec libfaac';
  $ffmpeg_opts .= $ffmpeg_audio_opts;
  $ffmpeg_opts .= ' -f mp4';
  $ffmpeg_opts .= ' -y';

  return $ffmpeg_exe.' -i "'.$ffmpeg_input.'" '.$ffmpeg_opts.' "'.set_suffix ($ffmpeg_input, '_1pass.mp4').'"';

//  $qt_faststart_exe set_suffix ($ffmpeg_input, '_1pass.mp4') '${TMP}'                 
//  mv '${TMP}' '$ffmpeg_output';
}


function
ffmpeg_transcode_vp8_1pass ($ffmpeg_input)
{
  global $ffmpeg_exe;
  global $ffmpeg_video_opts;
  global $ffmpeg_audio_opts; 

  $ffmpeg_opts = '';
//$ffmpeg_opts .= ' -flags +loop';
//$ffmpeg_opts .= ' -coder ac';
  $ffmpeg_opts .= ' -vcodec libvpx';
  $ffmpeg_opts .= $ffmpeg_video_opts;
  $ffmpeg_opts .= ' -acodec libvorbis';
  $ffmpeg_opts .= $ffmpeg_audio_opts;
  $ffmpeg_opts .= ' -f webm';
  $ffmpeg_opts .= ' -y';

  return $ffmpeg_exe.' -i "'.$ffmpeg_input.'" '.$ffmpeg_opts.' "'.set_suffix ($ffmpeg_input, '_1pass.webm').'"';
}


function
ffmpeg_transcode_flv_1pass ($ffmpeg_input)
{
  global $ffmpeg_exe;
  global $ffmpeg_video_opts;
  global $ffmpeg_audio_opts; 

  $ffmpeg_opts = '';
  $ffmpeg_opts .= $ffmpeg_video_opts;
  $ffmpeg_opts .= ' -acodec libmp3lame';
  $ffmpeg_opts .= $ffmpeg_audio_opts;
  $ffmpeg_opts .= ' -f flv';
  $ffmpeg_opts .= ' -y';

  return $ffmpeg_exe.' -i "'.$ffmpeg_input.'" '.$ffmpeg_opts.' "'.set_suffix ($ffmpeg_input, '_1pass.flv').'"';
}


function
ffmpeg_transcode_ogg_1pass ($ffmpeg_input)
{
  global $ffmpeg_exe;
  global $ffmpeg_video_opts;
  global $ffmpeg_audio_opts; 

  $ffmpeg_opts = '';
  $ffmpeg_opts .= ' -vcodec libtheora';
  $ffmpeg_opts .= $ffmpeg_video_opts;
  $ffmpeg_opts .= ' -acodec libvorbis';
  $ffmpeg_opts .= $ffmpeg_audio_opts;
  $ffmpeg_opts .= ' -f ogg';
  $ffmpeg_opts .= ' -y';

  return $ffmpeg_exe.' -i "'.$ffmpeg_input.'" '.$ffmpeg_opts.' "'.set_suffix ($ffmpeg_input, '_1pass.ogg').'"';
}


// 2 pass
function
ffmpeg_transcode_avi_2pass ($ffmpeg_input)
{
  global $ffmpeg_exe;
  global $ffmpeg_video_opts;
  global $ffmpeg_audio_opts; 

  $ffmpeg_opts = '';
  $ffmpeg_opts .= ' -vcodec mpeg4';
  $ffmpeg_opts .= ' -me_method epzs';
  $ffmpeg_opts .= ' -f avi';
  $ffmpeg_opts .= ' -y';
  $ffmpeg_opts .= $ffmpeg_video_opts;

  $a = array ();
  $a[] = $ffmpeg_exe.' -i "'.$ffmpeg_input.'" -pass 1 '.$ffmpeg_opts.' -passlogfile '.$ffmpeg_passlog.' -an /dev/null';

  $ffmpeg_opts .= ' -acodec libmp3lame';
  $ffmpeg_opts .= $ffmpeg_audio_opts;

  $a[] = $ffmpeg_exe.' -i "'.$ffmpeg_input.'" -pass 2 '.$ffmpeg_opts.' -passlogfile '.$ffmpeg_passlog.' "'.set_suffix ($ffmpeg_input, '_2pass.avi').'"';

  return $a;
}


function
ffmpeg_transcode_h264_2pass ($ffmpeg_input)
{
  global $ffmpeg_exe;
  global $ffmpeg_video_opts;
  global $ffmpeg_audio_opts; 

  $ffmpeg_opts = '';
  $ffmpeg_opts .= ' -flags +loop';
  $ffmpeg_opts .= ' -coder ac';
  $ffmpeg_opts .= ' -vcodec libx264';
  $ffmpeg_opts .= ' -me_method epzs';
  $ffmpeg_opts .= ' -f mp4';
  $ffmpeg_opts .= ' -y';
  $ffmpeg_opts .= $ffmpeg_video_opts;

  $a = array ();
  $a[] = $ffmpeg_exe.' -i "'.$ffmpeg_input.'" -pass 1 '.$ffmpeg_opts.' -vpre fastfirstpass -passlogfile '.$ffmpeg_passlog.' -an /dev/null';

  $ffmpeg_opts .= ' -acodec libfaac';
  $ffmpeg_opts .= $ffmpeg_audio_opts;

  $a[] = $ffmpeg_exe.' -i "'.$ffmpeg_input.'" -pass 2 '.$ffmpeg_opts.' -vpre hq -passlogfile '.$ffmpeg_passlog.' "'.set_suffix ($ffmpeg_input, '_2pass.mp4').'"';

//  ${QT_FAST} '$ffmpeg_output' '${TMP}';
//  mv '${TMP}' '$ffmpeg_output';

  return $a;
}


function
ffmpeg_transcode_vp8_2pass ($ffmpeg_input)
{
  global $ffmpeg_exe;
  global $ffmpeg_video_opts;
  global $ffmpeg_audio_opts; 

  $ffmpeg_opts = '';
  $ffmpeg_opts .= ' -flags +loop';
  $ffmpeg_opts .= ' -coder ac';
//  $ffmpeg_opts .= ' -vcodec libwebm';
//  $ffmpeg_opts .= ' -me_method epzs';
  $ffmpeg_opts .= ' -f webm';
  $ffmpeg_opts .= ' -y';
  $ffmpeg_opts .= $ffmpeg_video_opts;

  $a = array ();
  $a[] = $ffmpeg_exe.' -i "'.$ffmpeg_input.'" -pass 1 '.$ffmpeg_opts.' -passlogfile '.$ffmpeg_passlog.' -an /dev/null';

  $ffmpeg_opts .= ' -acodec vorbis';
  $ffmpeg_opts .= $ffmpeg_audio_opts;

  $a[] = $ffmpeg_exe.' -i "'.$ffmpeg_input.'" -pass 2 '.$ffmpeg_opts.' -passlogfile '.$ffmpeg_passlog.' "'.set_suffix ($ffmpeg_input, '_2pass.webm').'"';

  return $a;
}


function
ffmpeg_transcode_flv_2pass ($ffmpeg_input)
{
  global $ffmpeg_exe;
  global $ffmpeg_video_opts;
  global $ffmpeg_audio_opts; 

  $ffmpeg_opts = '';
  $ffmpeg_opts .= ' -me_method epzs';
  $ffmpeg_opts .= ' -f flv';
  $ffmpeg_opts .= ' -y';
  $ffmpeg_opts .= $ffmpeg_video_opts;

  $a = array ();
  $a[] = $ffmpeg_exe.' -i "'.$ffmpeg_input.'" -pass 1 '.$ffmpeg_opts.' -passlogfile '.$ffmpeg_passlog.' -an /dev/null';

  $ffmpeg_opts .= ' -acodec libmp3lame';
  $ffmpeg_opts .= $ffmpeg_audio_opts;

  $a[] = $ffmpeg_exe.' -i "'.$ffmpeg_input.'" -pass 2 '.$ffmpeg_opts.' -passlogfile '.$ffmpeg_passlog.' "'.set_suffix ($ffmpeg_input, '_2pass.flv').'"';

  return $a;
}


function
ffmpeg_transcode_ogg_2pass ($ffmpeg_input)
{
  global $ffmpeg_exe;
  global $ffmpeg_video_opts;
  global $ffmpeg_audio_opts; 

  $ffmpeg_opts = '';
  $ffmpeg_opts .= ' -vcodec libtheora';
  $ffmpeg_opts .= ' -me_method epzs';
  $ffmpeg_opts .= ' -f ogg';
  $ffmpeg_opts .= ' -y';
  $ffmpeg_opts .= $ffmpeg_video_opts;

  $a = array ();
  $a[] = $ffmpeg_exe.' -i "'.$ffmpeg_input.'" -pass 1 '.$ffmpeg_opts.' -passlogfile '.$ffmpeg_passlog.' -an /dev/null';

  $ffmpeg_opts .= ' -acodec libvorbis';
  $ffmpeg_opts .= $ffmpeg_audio_opts;

  $a[] = $ffmpeg_exe.' -i "'.$ffmpeg_input.'" -pass 2 '.$ffmpeg_opts.' -passlogfile '.$ffmpeg_passlog.' "'.set_suffix ($ffmpeg_input, '_2pass.ogg').'"';

  return $a;
}


// other stuff
function
ffmpeg_scale ($ffmpeg_input, $w, $h)
{
  global $ffmpeg_exe;

  $suffix = get_suffix ($ffmpeg_input);

  $ffmpeg_opts = '';
  $ffmpeg_opts .= ' -vcodec copy';
  $ffmpeg_opts .= ' -sameq';
  $ffmpeg_opts .= ' -acodec copy';
  $ffmpeg_opts .= ' -s '.$w.'x'.$h;
  $ffmpeg_opts .= ' -f '.substr ($suffix, 1);
  $ffmpeg_opts .= ' -y';

  return $ffmpeg_exe.' -i "'.$ffmpeg_input.'" '.$ffmpeg_opts.' "'.set_suffix ($ffmpeg_input, '_scaled'.$suffix).'"';
}


function
ffmpeg_crop ($ffmpeg_input, $top, $bottom, $left, $right)
{
  global $ffmpeg_exe;

  $suffix = get_suffix ($ffmpeg_input); 

  $ffmpeg_opts = '';
  $ffmpeg_opts .= ' -vcodec copy';
  $ffmpeg_opts .= ' -sameq';
  $ffmpeg_opts .= ' -acodec copy';
  $ffmpeg_opts .= ' -croptop '.$top.' -cropbottom '.$bottom.' -cropleft '.$left.' -cropright '.$right;
  $ffmpeg_opts .= ' -f '.substr ($suffix, 1);
  $ffmpeg_opts .= ' -y';

  return $ffmpeg_exe.' -i "'.$ffmpeg_input.'" '.$ffmpeg_opts.' "'.set_suffix ($ffmpeg_input, '_scaled'.$suffix).'"';
}


function
ffmpeg_change_container ($ffmpeg_input, $suffix)
{
  global $ffmpeg_exe;

  $ffmpeg_opts = '';
  $ffmpeg_opts .= ' -vcodec copy';
  $ffmpeg_opts .= ' -sameq';
  $ffmpeg_opts .= ' -acodec copy';
  $ffmpeg_opts .= ' -f '.substr ($suffix, 1);
  $ffmpeg_opts .= ' -y';

  return $ffmpeg_exe.' -i "'.$ffmpeg_input.'" '.$ffmpeg_opts.' "'.set_suffix ($ffmpeg_input, '_changed_to'.$suffix).'"';
}


function
ffmpeg_avifix ($ffmpeg_input)
{
  global $ffmpeg_exe;

  $ffmpeg_opts = '';
  $ffmpeg_opts .= ' -vcodec copy';
  $ffmpeg_opts .= ' -sameq';
  $ffmpeg_opts .= ' -acodec copy';
  $ffmpeg_opts .= ' -f avi';
  $ffmpeg_opts .= ' -y';

  return $ffmpeg_exe.' -i "'.$ffmpeg_input.'" '.$ffmpeg_opts.' "'.set_suffix ($ffmpeg_input, '_fixed.avi').'"';
}


function
ffmpeg_concat ($ffmpeg_input_a)
{
  global $ffmpeg_exe;

  $ffmpeg_opts = '';
  $ffmpeg_opts .= ' -vcodec copy';
  $ffmpeg_opts .= ' -sameq';
  $ffmpeg_opts .= ' -acodec copy';
  $ffmpeg_opts .= ' -f avi';
  $ffmpeg_opts .= ' -y';

  return $ffmpeg_exe.' -i "'.implode ('" -i "', $ffmpeg_input_a).'" "'.set_suffix ($ffmpeg_input, '_merged.avi').'"';

// mpeg files allow concatenation: cat a.mpg b.mpg c.mpg >merged.mpg

  /*
    Similarly, the yuv4mpegpipe format, and the raw video, raw audio codecs
    also allow concatenation, and the transcoding step is almost lossless. 
    When using multiple yuv4mpegpipe(s), the first line needs to be discarded
    from all but the first stream.  This can be accomplished by piping through
    tail as seen below.  Note that when piping through tail you must use
    command grouping, { ;}, to background properly.
  */
  $a[] = $ffmpeg_exe.' -i input1.flv -vn -f u16le -acodec pcm_s16le -ac 2 -ar 44100 - > temp1.a';
  $a[] = $ffmpeg_exe.' -i input2.flv -vn -f u16le -acodec pcm_s16le -ac 2 -ar 44100 - > temp2.a';
  $a[] = $ffmpeg_exe.' -i input1.flv -an -f yuv4mpegpipe - > temp1.v';
  $a[] = $ffmpeg_exe.' -i input2.flv -an -f yuv4mpegpipe - < /dev/null | tail -n +2 > temp2.v';
  $a[] = 'cat temp1.a temp2.a > all.a';
  $a[] = 'cat temp1.v temp2.v > all.v';
  $a[] = $ffmpeg_exe.' -f u16le -acodec pcm_s16le -ac 2 -ar 44100 -i all.a -f yuv4mpegpipe -i all.v -sameq -y output.flv';
  $a[] = 'rm temp[12].[av] all.[av]';

  return $a;
}


// main()


$ffmpeg_exe = '/usr/bin/ffmpeg';
//$ffmpeg_exe = '/usr/bin/avconv';
// qt-faststart is part of ffmpeg and makes the movie streamable
$qt_faststart_exe = '/root/bin/qt-faststart';


date_default_timezone_set ('Europe/Berlin');


$t = $argv[1];

//$cmdline = ffmpeg_transcode_avi_1pass ($t);
//$cmdline = ffmpeg_transcode_avi_2pass ($t);
//$cmdline = ffmpeg_transcode_flv_1pass ($t);
//$cmdline = ffmpeg_transcode_flv_2pass ($t);
//$cmdline = ffmpeg_transcode_h264_ps3 ($t);
//$cmdline = ffmpeg_transcode_h264_1pass ($t);
//$cmdline = ffmpeg_transcode_h264_2pass ($t);
$cmdline = ffmpeg_transcode_vp8_1pass ($t);
//$cmdline = ffmpeg_transcode_vp8_2pass ($t);
//$cmdline = ffmpeg_transcode_ogg_1pass ($t);
//$cmdline = ffmpeg_transcode_ogg_2pass ($t);

//$cmdline = ffmpeg_scale ($t, 640, 400);
//$cmdline = ffmpeg_crop ($t, 10, 10, 10, 10);
//$cmdline = ffmpeg_change_container ($t, '.avi');
//$cmdline = ffmpeg_avifix ($t);
//$cmdline = ffmpeg_concat ();


if (is_array ($cmdline))
  {
    for ($i = 0; isset ($cmdline[$i]); $i++)
      {
//        shell_exec ($cmdline[$i]);
// DEBUG
echo $cmdline."\n";
      }
  }
else
  {
//    shell_exec ($cmdline);
// DEBUG
echo $cmdline."\n";    
  }


exit;


?>

<?php //Include the footer - The footer ends the body and html tags </div> tag ends in footer
include 'footer.php'; ?>