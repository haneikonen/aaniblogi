<?php
session_start();
require_once('yhteiset/dbYhteys.php');
require_once('yhteiset/funktiot.php');
require_once('yhteiset/dbFunctions.php');

SSLon();
?>
<?php include 'php/log_in.php' ?>

<!doctype html>
<html class="no-js" lang="en">
	<head>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0" />
		<link href="https://cdnjs.cloudflare.com/ajax/libs/video.js/4.12.3/video-js.css" rel="stylesheet"> 
		
		<script src="js/video.js"></script>
		<script src="js/wavesurfer.min.js"></script>
		<script src="js/videojs.wavesurfer.js"></script>
		<script src="js/funktioita.js"></script>
		<script src="js/kommenttihaku.js"></script>
		<script src="js/keskusteluhaku.js"></script>

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script> 
		<title>Foundation 5</title>
  		<link href="assets/css/foundation.min.css" rel="stylesheet" type="text/css" media="all" />
		<link href="assets/css/etusivu.min.css" rel="stylesheet" type="text/css" media="all" />
  		<script src="bower_components/modernizr/modernizr.js"></script>

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
		  		<script src="bower_components/modernizr/modernizr.js"></script>
		<script src="js/recorder.js"></script>
		<script src="js/jquery.voice.js"></script>
		<script src="js/record.js"></script>
		<title>Foundation 5</title>
  		<link href="assets/css/foundation.min.css" rel="stylesheet" type="text/css" media="all" />
		<link href="assets/css/etusivu.min.css" rel="stylesheet" type="text/css" media="all" />


	</head>
	<body>
		
<div class"fixed">
<nav class="top-bar" data-topbar role="navigation">
  <ul class="title-area">
    <li class="name">
      <h1><a href="index.html">AaniBlogi</a></h1>
    </li>
     <!-- Remove the class "menu-icon" to get rid of menu icon. Take out "Menu" to just have icon alone -->
    <li class="toggle-topbar menu-icon"><a href="#"><span>Menu</span></a></li>
  </ul>
  <section class="top-bar-section">
    <!-- Right Nav Section -->
    <ul class="right">
      <li class="has-dropdown">
        <a href="#">Kirjaudu sisään</a>
        <ul class="dropdown">
          <li><a href="#">First link in dropdown</a></li>
          <li class="active"><a href="#">Active link in dropdown</a></li>
        </ul>
      </li>
    </ul>
    <!-- Left Nav Section -->
    <ul class="left">
      <li><a href="aiheet.html">Viihde</a></li>
      <li><a href="aiheet.html">Musiikki</a></li>
      <li><a href="aiheet.html">Elokuvat</a></li>
      <li><a href="aiheet.html">Ruoka</a></li>
    </ul>
  </section>
</nav>
</div>
<div class="row" data-equalizer>
	<script>

function haeAihe(id){
	console.log('Voi perse');
$('#keskustelulista').text('');
$('#kommenttilista').text('');
var aiheID=id;
$.ajax({
	type: "POST",
	url: "php/keskustelut.php",
	data: 'q='+aiheID,
	dataType: 'json',
	success:function(data){
		data.om.forEach(function(k){
			console.log(k.id);
			//console.log("hei");
			linkki='<p id="link'+k.id+'">'+k.title+'</p>';
			$('#keskustelulista').append(linkki);
			$('#link'+k.id).click(function(){

			haeKommentti(k.id)

			$('#julkaisu').append('<p>'+k.url+'</p>');
			})
		})
	}
});
}

function haeKommentti(julkId){
	console.log('Tuksu on ihana');
	$('#kommenttilista').text('');
		$.ajax({
			type: "POST",
			url: "php/kommentit.php",
			data: 'q='+julkId,
			dataType: 'json',
			success:function(data){
				data.comments.forEach(function(c){
					var kommentti='<div class="comment">'+
					'<p class="time">'+c.time+'</p>'+
					'<p class="kommentti-uname">'+c.username+'</p>'+
					'<p class="audio">'+c.audio+'</p>'+
					'<p class="comment-text">'+c.kommentti+'</p>'+
					'</div>';
					$('#kommenttilista').append(kommentti);
				})
			}
		});
}


	</script>
	<div class="medium-3 columns">
		<div class="panel"data-equalizer-watch >
			<p class="panel">
			Search...
			</p>
			<h3 class="panel">Otsikko</h3>
				<p id="keskustelulista">	
				</p>
		</div>
	</div>
	<div class="medium-9 columns" data-equalizer-watch>
		<div class="medium-12 columns">
			<div class="orbit-container">
				<ul class="example-orbit" data-orbit>
				  <li>
					<img src="assets/img/DSC_0096.jpg" alt="slide 1" />
					<div class="orbit-caption">
					  Caption One.
					</div>
				  </li>
				  <li>
					<img src="assets/img/DSC_0186.jpg" alt="slide 1" />
					<div class="orbit-caption">
					  Caption two.
					</div>
				  </li>
				  <li>
					<img src="assets/img/DSC_0188.jpg" alt="slide 1" />
					<div class="orbit-caption">
					  Caption three.
					</div>
				  </li>		  
				</ul>
			</div>
		</div>
		<div class="medium-4 columns">
			<div class="panel">
				<div id="julkaisu">
				<h3> Julkaisu </h3>
				</div>			
				<div>
				<button onclick="startRecording(this);">Record</button>
				<button onclick="stopRecording(this);">Stop</button>
				<h2>Log</h2>
				<ul id="recordingslist"></ul>
				<pre id="log"></pre>
				  <script>
				  console.log("https://subinsb.com/html5-record-mic-voice");
  
  function __log(e, data) {
    log.innerHTML += "\n" + e + " " + (data || '');
  }

  var audio_context;
  var recorder;

  function startUserMedia(stream) {
    var input = audio_context.createMediaStreamSource(stream);
    __log('Media stream created.');

    // Uncomment if you want the audio to feedback directly
    //input.connect(audio_context.destination);
    //__log('Input connected to audio context destination.');
    
    recorder = new Recorder(input);
    __log('Recorder initialised.');
  }

  function startRecording(button) {
    recorder && recorder.record();
    button.disabled = true;
    button.nextElementSibling.disabled = false;
    __log('Recording...');
  }

  function stopRecording(button) {
    recorder && recorder.stop();
    button.disabled = true;
    button.previousElementSibling.disabled = false;
    __log('Stopped recording.');
    
    // create WAV download link using audio data blob
    createDownloadLink();
    
    recorder.clear();
  }


  function createDownloadLink() {
    recorder && recorder.exportWAV(function(blob) {
      var url = URL.createObjectURL(blob);
	  console.log(blob);
	  
	  //EI TOIMI
	  /*
	$.post(
		'php/addAudio.php',
		{
			audio:blob,
			julkaisu:1
		}
	);
	  */
      var li = document.createElement('li');
      var au = document.createElement('audio');
      var hf = document.createElement('a');
      
      au.controls = true;
      au.src = url;
      hf.href = url;
      hf.download = new Date().toISOString() + '.wav';
      hf.innerHTML = hf.download;
      li.appendChild(au);
      li.appendChild(hf);
      recordingslist.appendChild(li);
    });
  }

  window.onload = function init() {
    try {
      // webkit shim
      window.AudioContext = window.AudioContext || window.webkitAudioContext;
      navigator.getUserMedia = navigator.getUserMedia || navigator.webkitGetUserMedia;
      window.URL = window.URL || window.webkitURL;
      
      audio_context = new AudioContext;
      __log('Audio context set up.');
      __log('navigator.getUserMedia ' + (navigator.getUserMedia ? 'available.' : 'not present!'));
    } catch (e) {
      alert('No web audio support in this browser!');
    }
    
    navigator.getUserMedia({audio: true}, startUserMedia, function(e) {
      __log('No live audio input: ' + e);
    });
  };
  </script>
			
				
				</div>
			</div>
		</div>
		<div class="medium-8 columns">
			<div class="panel">
				<div id="kommenttilista"></div><script>haeAihe(1);</script>
			</div>
		</div>
	</div>
</div>

  		<script src="bower_components/jquery/dist/jquery.min.js"></script>
<script src="assets/js/foundation.min.js"></script>
<script>

$(document).foundation();
</script>

	</body>
</html>
