<HEAD>
<script type="text/javascript" src="/scripts/jwplayer.js" ></script>
</HEAD>
<BODY>
<div id="myElement">Loading the player ...</div>

<script type="text/javascript">
    jwplayer("myElement").setup({
        flashplayer: "/scripts/jwplayer.flash.swf",
	streamer: "https://djaapt.com:8443/testing",
	file: "https://djaapt.com:8443/testing",
    });
</script
</BODY>