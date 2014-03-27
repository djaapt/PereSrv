<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<?php //Include the header - header starts the html and body tags
include 'header.php'; ?>

<script type="text/javascript" src="/scripts/jwplayer.js"></script>

<video height="270" width="480" id="myVideo">
  <source src="/Videos/Mulan.1998.mkv" type="video/x-matroska">
  <source src="/Videos/Mulan.1998.mkv" type="video/x-matroska">
</video>

<script type="text/javascript">
  jwplayer("myVideo").setup({
    modes: [
        { type: 'html5' },
        { type: 'mp4', src: '/jwplayer/player.swf' }
    ]
  });
</script>

<?php //Include the footer - The footer ends the body and html tags </div> tag ends in footer
include 'footer.php'; ?>