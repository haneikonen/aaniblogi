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
	</head>
	<body>
		
<div class="medium-10 large-centered columns">
	<div class="large-9 columns" id="logo">
		<h1> AaniBlogi </h1>
	</div>
	<div class="large-3 columns" id="login">
		<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
		<input type="text" name="username" placeholder="username" id="user"/>
		<input type="password" name="pwd" placeholder="password" id="pwd"/>
		<input type="submit" name="kirjaudu" value="Login" class="button" id="loggaus" />
	</div>
	<div class="large-9 columns" id="aiheet">
      <div class="medium-12 columns">
		  <a href="aiheet.php" id="viihde">Viihde</a> 
		  <a href="aiheet.php" id="musiikki">Musiikki</a> 
		  <a href="aiheet.php" id="elokuvat">Elokuvat</a>
		  <a href="aiheet.php" id="ruoka">Ruoka</a>
		</div>
	</div>
	<?php if ($_SESSION['kirjautunut'] == 'loggedIn'):	?>
	<script>
	$("#user").hide();
	$("#pwd").hide();
	$("#loggaus").replaceWith('<a href="<?php echo $_SERVER[´PHP_SELF´]; ?>?action=logout">Log out	</a>');
    </script>
	<?php endif; ?>
	<div class="large-3 columns" id="search">
		<div class="search">
		<input type="text" name="search" placeholder="Search... " />
     	<input type="submit" name="go" value="Go" class="button" />
	 </div>
	</div>
</div>
	<div class="medium-10 large-centered columns" data-equalizer id="content">
		<div class="large-4 columns medium-6 columns small-12 columns" data-equalizer-watch>
			<div class="panel">
				<div class="keskustelu_etusivu">
					<?php include 'php/kommentti_haku.php' ?>
			       	<h2 id="title_kesk_1_1"></h2>
						<audio id="myAudio" class="video-js vjs-default-skin"></audio>
						<script>
							var player = videojs("myAudio",
							{
								controls: true,
								autoplay: false,
								loop: false,
								width: 360,
								height: 110,
								plugins: {
									wavesurfer: {
										src: "<?php echo($row_eka['url']); ?>",
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
						<h3 id="kuvaus1"></h3>
						<div class="sisalto_1"></div>
				</div>
			</div>
		</div>
		<div class="large-4 columns medium-6 columns small-12 columns" data-equalizer-watch>
			<div class="panel">
				<div class="keskustelu_etusivu">
					<h2 id="title_kesk_1_2"></h2>
					<audio id="myAudio2" class="video-js vjs-default-skin"></audio>
					<script>
						var player = videojs("myAudio2",
						{
							controls: true,
							autoplay: false,
							loop: false,
							width: 360,
							height: 110,
							plugins: {
								wavesurfer: {
									src: "<?php echo($row_toka['url']); ?>",
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
					<h3 id="kuvaus2"></h3>
					<div class="sisalto_2"></div>
				</div>
			</div>
		</div>
		<div class="large-4 columns medium-6 columns small-12 columns" data-equalizer-watch>
			<div class="panel">
				<div class="keskustelu_etusivu">
					<h2 id="title_kesk_1_3"></h2>
					<audio id="myAudio3" class="video-js vjs-default-skin"></audio>
					<script>
						var player = videojs("myAudio3",
						{
							controls: true,
							autoplay: false,
							loop: false,
							width: 360,
							height: 110,
							plugins: {
								wavesurfer: {
									src: "<?php echo($row_kolmas['url']); ?>",
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
						<h3 id="kuvaus3">jubajee</h3>
						<div class="sisalto_3"></div>
				</div>
			</div>
			<script>
        	$(".sisalto_1").append('<?php include 'php/kommentti_1.php' ?>');
        	$(".sisalto_2").append('<?php include 'php/kommentti_2.php' ?>');
        	$(".sisalto_3").append('<?php include 'php/kommentti_3.php' ?>');
			$("#title_kesk_1_1").append('<?php echo($row_eka['title']); ?>');
			$("#kuvaus1").append('<?php echo($row_eka['kuvaus']); ?>');
			$("#title_kesk_1_2").append('<?php echo($row_toka['title']); ?>');
			$("#kuvaus2").append('<?php echo($row_toka['kuvaus']); ?>');
			$("#title_kesk_1_3").append('<?php echo($row_kolmas['title']); ?>');
			$("#kuvaus3").append('<?php echo($row_kolmas['kuvaus']); ?>');
			</script>
			<?php			
			if ($_SESSION['kirjautunut'] == 'loggedIn'):
		    ?>
            <script>
			$("#sisalto_1").show();
        	$("#sisalto_2").show();
        	$("#sisalto_3").show();
		 	</script>
			<?php else: ?>
			<script>
			$(".sisalto_1").hide();
        	$(".sisalto_2").hide();
        	$(".sisalto_3").hide();
			</script>
			<?php endif ?>
		</div>
		<div class="large-4 columns medium-6 columns small-12 columns" data-equalizer-watch> 
			<div class="panel">
				<div class="keskustelu_etusivu">
					<iframe width="380" height="214" src="https://www.youtube.com/embed/RVB7uSPr4Ns" frameborder="0" allowfullscreen></iframe>
				</div>
			</div>
		</div>
		<div class="large-4 columns medium-6 columns small-12 columns" data-equalizer-watch>
			<div class="panel">
				<div class="keskustelu_etusivu">
					<iframe width="380" height="214" src="https://www.youtube.com/embed/RVB7uSPr4Ns" frameborder="0" allowfullscreen></iframe>
				</div>
			</div>
		</div>
		<div class="large-4 columns medium-6 columns small-12 columns" data-equalizer-watch>
			<div class="panel">
				<div class="keskustelu_etusivu">
					<iframe width="380" height="214" src="https://www.youtube.com/embed/RVB7uSPr4Ns" frameborder="0" allowfullscreen></iframe>
				</div>
			</div>
		</div>
		<script>
		$('#viihde').click(function(){haeAihe(1);});
		$('#musiikki').click(function(){haeAihe(1);});
		$('#elokuva').click(function(){haeAihe(1);});
		$('#ruoka').click(function(){haeAihe(1);});
	</div>

  		<script src="bower_components/jquery/dist/jquery.min.js"></script>
<script src="assets/js/foundation.min.js"></script>
<script>
$(document).foundation();
</script>

	</body>
</html>
