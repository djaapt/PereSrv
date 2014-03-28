<div id='mediaplayer'>Radioplayer will be in this DIV</div>
<script type="text/javascript" src="/scripts/jwplayer.js" ></script>
<script type="text/javascript">
  jwplayer('mediaplayer').setup({
    'flashplayer': './scripts/jwplayer.flash.swf',
    'id': 'player1',
    'type': 'sound',
    'width': '480',
    'height': '270',
    'autoplay': 'true',
    'volume': '60',
    'file': 'testing.php'
  });
</script>