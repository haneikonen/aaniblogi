<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" href="./css.css"/>
		<!--<script src="jquery-2.1.1.min.js"></script>
		<script src="jqueryscripti.js"></script>-->
		
		<link href="http://cdnjs.cloudflare.com/ajax/libs/video.js/4.12.3/video-js.css" rel="stylesheet">
		
		<script src="js/video.js"></script>
		<script src="js/wavesurfer.min.js"></script>
		<script src="js/videojs.wavesurfer.js"></script>
    </head>
<body>
<div class="top">
    <h3>
    Aaniblogi testitesti
        </h3>
</div>

<div class="main">
	<div class="titlediv">
		<h1>
		Aaniblogi
			</h1>
		</div>
	<div class="aiheet_nav">
		<div class="aihe_1">
			aihe1
			</div>
		<div class="aihe_2">
			aihe2
			</div>
		<div class="aihe_3">
			aihe3
			</div>
		<div class="aihe_4">
			aihe4
			</div>
		</div>
	<div class="searchbar">
		<h4>search</h4>
	 </div>
	<div class="keskustelut">
		<div class="kesk_1_1">
			<audio id="myAudio" class="video-js vjs-default-skin"></audio>

		<script>
		var player = videojs("myAudio",
		{
			controls: true,
			autoplay: false,
			loop: false,
			width: 380,
			height: 110,
			plugins: {
				wavesurfer: {
					src: "audio/test.mp3",
					msDisplayMax: 10,
					waveColor: "grey",
					progressColor: "black",
					cursorColor: "black",
					hideScrollbar: true
				}
			}
		});
		// change player background color
		player.el().style.backgroundColor = "#FFEEFF";
		</script>
			</div>
		<div class="kesk_1_2">
		Additionaly it provides some tools useful in real-life cases. Such as the ability for the user to mute the sound. Its is useful when the user is at the office or any place where it isn't polite to have a loud computer :) 

		<audio id="myAudio2" class="video-js vjs-default-skin"></audio>

		<script>
		var player = videojs("myAudio2",
		{
			controls: true,
			autoplay: false,
			loop: false,
			width: 380,
			height: 110,
			plugins: {
				wavesurfer: {
					src: "audio/test.mp3",
					msDisplayMax: 10,
					waveColor: "grey",
					progressColor: "black",
					cursorColor: "black",
					hideScrollbar: true
				}
			}
		});
		// change player background color
		player.el().style.backgroundColor = "#FFEEFF";
		</script>
			</div>
		<div class="kesk_1_3">
		<audio id="myAudio3" class="video-js vjs-default-skin"></audio>

		<script>
		var player = videojs("myAudio3",
		{
			controls: true,
			autoplay: false,
			loop: false,
			width: 380,
			height: 110,
			plugins: {
				wavesurfer: {
					src: "audio/test.mp3",
					msDisplayMax: 10,
					waveColor: "grey",
					progressColor: "black",
					cursorColor: "black",
					hideScrollbar: true
				}
			}
		});
		// change player background color
		player.el().style.backgroundColor = "#FFEEFF";
		</script>
		This helper provides a main line out with the good practices from "Developing Game Audio with the Web Audio API" on html5rocks. So it provides a clipping detection and a dynamic compressor to reduce clipping to improve sound quality.

Additionaly it provides some tools useful in real-life cases. Such as the ability for the user to mute the sound. Its is useful when the user is at the office or any place where it isn't polite to have a loud computer :) 
			</div>
		</div>
		<div class="kesk_2_1">
			<iframe width="380" height="214" src="https://www.youtube.com/embed/RVB7uSPr4Ns" frameborder="0" allowfullscreen></iframe>
			</div>
		<div class="kesk_2_2">
			<iframe width="380" height="214" src="https://www.youtube.com/embed/RVB7uSPr4Ns" frameborder="0" allowfullscreen></iframe>
			</div>
		<div class="kesk_2_3">
		This helper provides a main line out with the good practices from "Developing Game Audio with the Web Audio API" on html5rocks. So it provides a clipping detection and a dynamic compressor to reduce clipping to improve sound quality.
			<iframe width="380" height="214" src="https://www.youtube.com/embed/RVB7uSPr4Ns" frameborder="0" allowfullscreen></iframe>
			</div>
	<div class="bottom">
		tamasivu on luotu huonosti http//:::ok.web.ko
		</div>
</div>
</body></html>




