<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<?php //Include the header - header starts the html and body tags
include 'header.php'; ?>

<script type="text/javascript" src="/scripts/jwplayer.js" ></script>

<div id="myElement">Loading the player ...</div>

<script type="text/javascript">
    jwplayer("myElement").setup({
        file: "/Videos/The.Avengers.2012.mkv",
        height: 360,
        width: 640
    });
</script>


<?php //Include the footer - The footer ends the body and html tags </div> tag ends in footer
include 'footer.php'; ?>