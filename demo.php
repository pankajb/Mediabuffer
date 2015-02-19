<!--
	
	mediabuffer.js demo
	By Kris Noble
		
	N.b. media files are not included in the repo but archive.org has
	tons of free public domain video and audio for testing purposes
	
	See it in action at http://static.simianstudios.com/mb
	
	More info: https://github.com/krisnoble/Mediabuffer
	
-->
<!doctype html>
<html>
	<head>
		<meta charset="UTF-8">
		<title>Mediabuffer Demo</title>
		<style>
			*{padding:0;margin:0;box-sizing:border-box;}
			body{font-family:'Open Sans','Helvetica Neue',Arial,sans-serif;width:80%;max-width:700px;margin:0 auto;padding:50px;}
			audio{display:block;width:600px;max-width:100%;margin:0 auto;}
			video{display:block;width:600px;max-width:100%;height:auto;max-height:100%;margin:0 auto;}
			div{width:100%;max-width:100%;margin-top:30px;}
			.button{display:none;width:auto;padding:10px 20px;color:#fff;background:#393;border-radius:5px;margin-bottom:20px;}
			.button:hover{cursor:pointer;background:#3c3;}
			.button:focus,.button:active{background:#161;}
			h1{margin-bottom:30px;font-weight:normal;}
			h2{margin-bottom:20px;font-weight:normal;}
			progress{display:inline-block;vertical-align:bottom;margin-bottom:20px;}
		</style>
		
		<link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Open+Sans:400,700" />
	</head>
	
	<body>
		<h1>Mediabuffer Demo</h1>
		<p>More info: <a href="https://github.com/krisnoble/Mediabuffer">GitHub</a></p>
		<div id="video_container">
			<h2>Video</h2>
			<a class="button" id="video-button">Load video</a> <span id="video-progress-container"></span>
			<video id="video" preload="none" poster="poster.jpg">
				<source src="example.mp4" type="video/mp4" />
				<source src="example.ogv" type="video/ogg" />
			</video>
		</div>
		
		<div id="audio_container">
			<h2>Audio</h2>
			<a class="button" id="audio-button">Load audio</a> <span id="audio-progress-container"></span>
			<audio id="audio" controls preload="none">
				<source src="example.mp3" type="audio/mpeg" />
				<source src="example.ogg" type="audio/ogg" />
			</audio>
		</div>
		
		<script src="mediabuffer.js"></script>
		<script>
			function videoLoad() {
				console.log('Video loading');
				document.getElementById('video-progress-container').innerHTML = '<progress id="video-progress" value="0" max="100">Buffering: 0%</span>';
				videoBuffer.load();
			}
			
			function videoProgress(percentBuffered) {
				console.log('Video progress: ' + percentBuffered + '%');
				document.getElementById('video-progress').setAttribute('value', percentBuffered);
				document.getElementById('video-progress').innerHTML = 'Buffering: ' + percentBuffered + '%';
			}
			
			function videoReady() {
				console.log('Video ready!');
				document.getElementById('video-progress').setAttribute('value', 100);
				document.getElementById('video-progress').innerHTML = 'Buffering: 100%';
				document.getElementById('video-button').style.display = 'none';
				document.getElementById('video').setAttribute('controls', 'controls');
				document.getElementById('video').play();
			}
			
			// ================================================================================
			
			function audioLoad() {
				console.log('Audio loading');
				document.getElementById('audio-progress-container').innerHTML = '<progress id="audio-progress" value="0" max="100">Buffering: <span>0</span>%</span>';
				audioBuffer.load();
			}
			
			function audioProgress(percentBuffered) {
				console.log('Audio progress: ' + percentBuffered + '%');
				document.getElementById('audio-progress').setAttribute('value', percentBuffered);
				document.getElementById('audio-progress').innerHTML = 'Buffering: ' + percentBuffered + '%';
			}
			
			function audioReady() {
				console.log('Audio ready!');
				document.getElementById('audio-progress').setAttribute('value', 100);
				document.getElementById('audio-progress').innerHTML = 'Buffering: 100%';
				document.getElementById('audio-button').style.display = 'none';
				document.getElementById('audio').play();
			}			
			
			// ================================================================================
			
			var videoBuffer = new Mediabuffer(document.getElementById('video'), videoProgress, videoReady);
			document.getElementById('video-button').addEventListener('click', videoLoad, true);
			document.getElementById('video-button').style.display = 'inline-block';
			
			var audioBuffer = new Mediabuffer(document.getElementById('audio'), audioProgress, audioReady);			
			document.getElementById('audio-button').addEventListener('click', audioLoad, true);			
			document.getElementById('audio-button').style.display = 'inline-block';
		</script>
	</body>
</html>