<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<?php //Include the header - header starts the html and body tags
include 'header.php'; ?>
<?php
extension_loaded('ffmpeg') or die('Error in loading ffmpeg');

$ffmpegInstance = new ffmpeg_movie('/Videos/Brave.2012.mp4');
echo "getDuration: " .$ffmpegInstance-&gt;getDuration()."getFrameCount: " .$ffmpegInstance-&gt;getFrameCount()."getFrameRate: " .$ffmpegInstance-&gt;getFrameRate()."getFilename: " . $ffmpegInstance-&gt;getFilename() ."getComment: " . $ffmpegInstance-&gt;getComment() ."getTitle: " . $ffmpegInstance-&gt;getTitle() ."getAuthor: " . $ffmpegInstance-&gt;getAuthor() ."getCopyright: " . $ffmpegInstance-&gt;getCopyright() ."getArtist: " . $ffmpegInstance-&gt;getArtist() ."getGenre: " . $ffmpegInstance-&gt;getGenre() ."getTrackNumber: " . $ffmpegInstance-&gt;getTrackNumber() ."getYear: " . $ffmpegInstance-&gt;getYear() ."getFrameHeight: " . $ffmpegInstance-&gt;getFrameHeight() ."getFrameWidth: " . $ffmpegInstance-&gt;getFrameWidth() ."getPixelFormat: " . $ffmpegInstance-&gt;getPixelFormat() ."getBitRate: " . $ffmpegInstance-&gt;getBitRate() ."getVideoBitRate: " . $ffmpegInstance-&gt;getVideoBitRate() ."getAudioBitRate: " . $ffmpegInstance-&gt;getAudioBitRate() ."getAudioSampleRate: " . $ffmpegInstance-&gt;getAudioSampleRate() ."getVideoCodec: " . $ffmpegInstance-&gt;getVideoCodec() ."getAudioCodec: " . $ffmpegInstance-&gt;getAudioCodec() ."getAudioChannels: " . $ffmpegInstance-&gt;getAudioChannels() ."hasAudio: " . $ffmpegInstance-&gt;hasAudio();
?>
<?php //Include the footer - The footer ends the body and html tags </div> tag ends in footer
include 'footer.php'; ?>