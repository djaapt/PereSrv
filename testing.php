<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<?php //Include the header - header starts the html and body tags
include 'header.php'; ?>

<script type='text/javascript' src='/scripts/jwplayer.js'></script>

<div id='mediaplayer'></div>

<script type="text/javascript">

jwplayer('mediaplayer').setup({

'flashplayer': 'player.swf',

'id': 'playerID',

'width': '480',

'height': '270',

'file': '/Videos/Bambi.1942.mkv'

});

</script>

<?php //Include the footer - The footer ends the body and html tags </div> tag ends in footer
include 'footer.php'; ?>