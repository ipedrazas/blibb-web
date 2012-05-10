<link href="jPlayer.2.1.0/prettyfy.css" rel="stylesheet" type="text/css" />
<link href="jPlayer.2.1.0/skinBlue.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.6/jquery.min.js"></script>
<script type="text/javascript" src="jPlayer.2.1.0/jquery.jplayer.min.js"></script>
<script type="text/javascript">
//<![CDATA[
$(document).ready(function(){

	$("#jquery_jplayer_1").jPlayer({
		ready: function (event) {
			$(this).jPlayer("setMedia", {
				// m4a:"http://www.jplayer.org/audio/m4a/TSP-01-Cro_magnon_man.m4a",
				// oga:"http://www.jplayer.org/audio/ogg/TSP-01-Cro_magnon_man.ogg"
			

<?


	// get the album
	require_once(__DIR__.'/../../system/config.php');

		
		$b = '4f7aae23711ee00a46000008';		
		$pest = new Pest('http://localhost');
		$result = $pest->get('/api/items/'.$b);

		$album = json_decode($result);

		foreach ($album->items as $song) {
				// echo '<source src="http://localhost/actions/playMp3?i='.$song->id.'" />';
			echo 'mp3: "http://localhost/actions/playMp3?i='.$song->id.'",'.chr(10);
		}

?>

});
		},
		swfPath: "jPlayer.2.1.0",
		supplied: "mp3",
		wmode: "window"
	});


});
//]]>
</script>


<div id="jquery_jplayer_1" class="jp-jplayer"></div>

		<div id="jp_container_1" class="jp-audio">
			<div class="jp-type-single">
				<div class="jp-gui jp-interface">
					<ul class="jp-controls">
						<li><a href="javascript:;" class="jp-play" tabindex="1">play</a></li>
						<li><a href="javascript:;" class="jp-pause" tabindex="1">pause</a></li>
						<li><a href="javascript:;" class="jp-stop" tabindex="1">stop</a></li>
						<li><a href="javascript:;" class="jp-mute" tabindex="1" title="mute">mute</a></li>
						<li><a href="javascript:;" class="jp-unmute" tabindex="1" title="unmute">unmute</a></li>
						<li><a href="javascript:;" class="jp-volume-max" tabindex="1" title="max volume">max volume</a></li>
					</ul>
					<div class="jp-progress">
						<div class="jp-seek-bar">
							<div class="jp-play-bar"></div>
						</div>
					</div>
					<div class="jp-volume-bar">
						<div class="jp-volume-bar-value"></div>
					</div>
					<div class="jp-time-holder">
						<div class="jp-current-time"></div>
						<div class="jp-duration"></div>

						<ul class="jp-toggles">
							<li><a href="javascript:;" class="jp-repeat" tabindex="1" title="repeat">repeat</a></li>
							<li><a href="javascript:;" class="jp-repeat-off" tabindex="1" title="repeat off">repeat off</a></li>
						</ul>
					</div>
				</div>
				<div class="jp-title">
					<ul>
						<?php


				
							foreach ($album->items as $song) {
								$s = 'title-song';
								echo '<li>' .$song->$s.chr(10). '</li>';
							}
						?>
					</ul>
				</div>
				<div class="jp-no-solution">
					<span>Update Required</span>
					To play the media you will need to either update your browser to a recent version or update your <a href="http://get.adobe.com/flashplayer/" target="_blank">Flash plugin</a>.
				</div>
			</div>
		</div>
