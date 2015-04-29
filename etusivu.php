
<?php
session_start();
require_once('yhteiset/dbYhteys.php');
require_once('yhteiset/funktiot.php');
require_once('yhteiset/dbFunctions.php');

SSLon();
?>
<?php /* include 'log_in.php' */?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" href="./css.css"/>
		<!--<script src="jquery-2.1.1.min.js"></script>
		<script src="jqueryscripti.js"></script>-->
		
		<link href="https://cdnjs.cloudflare.com/ajax/libs/video.js/4.12.3/video-js.css" rel="stylesheet"> 
		
		<script src="js/video.js"></script>
		<script src="js/wavesurfer.min.js"></script>
		<script src="js/videojs.wavesurfer.js"></script>
		<script src="js/funktioita.js"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script> 
		<script src="keskusteluhaku.js"></script>
		<script src="kommenttihaku.js"></script>
		</head>
<body>

<div class="top">
    <h3>
    Aaniblogi testitesti winscptest
        </h3>
</div>

<div class="main">
	<div class="logtitle">
		<div class="titlediv">
			<h1>
			Aaniblogi
				</h1>
			</div>
		<div class="login" id="login">
		<?php  include 'log_in.php' ?>
		<!--
				<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
    			<input type="text" name="username" placeholder="username" id="user"/>
				<input type="password" name="pwd" placeholder="password" id="pwd"/>
				<input type="submit" name="kirjaudu" value="Login" class="button" id="loggaus" />
				
				-->
			</div>
			
<?php if ($_SESSION['kirjautunut'] == 'loggedIn'):	?>
	<script>
	$("#user").hide();
	$("#pwd").hide();
	$("#loggaus").replaceWith('<a href="<?php echo $_SERVER[´PHP_SELF´]; ?>?action=logout">Logout	</a>');
    </script>
<?php endif; ?>
<div class="aiheet_nav">
	<?php 
		$aihelkm=$DBH->prepare("SELECT COUNT(ID) FROM a_aihealue WHERE ID;");
		$aihelkm->execute();
		$aihelkm_data = $aihelkm->fetch();

		for($z=1;$z <=$aihelkm_data['COUNT(ID)'];$z++){
			$aihe= $DBH->prepare("SELECT aihealue FROM a_aihealue WHERE ID = ".$z.";");
			$aihe->execute();
			$aihe_data = $aihe->fetch();
			echo('<div class="aihe_'.$z.'">
					<a href="#" id="aihe'.$z.'">'.$aihe_data["aihealue"].'</a>
				</div>'

				);
	
		};
	?>
</div>
	<div class="searchbar">
		<input type="text" name="search" placeholder="Search... " />
     	<input type="submit" name="go" value="Go" class="button" />
	 </div>
<?php include 'kommentti_haku.php' ?>
	<div>
	<p id="keskustelulista">HEI</p>
	</div>
	<div class="keskustelut">
		<div class="kesk_1_1">
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
        <div class="kesk_1_2">
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
		<div class="kesk_1_3">
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
		<h3 id="kuvaus3"></h3>
   		<div class="sisalto_3"></div>
        	</div>
            <!-- Lisätään julkaisujen tiedot niiden paikoilleen-->
        <script>
        	$(".sisalto_1").append('<?php include 'kommentti_1.php' ?>');
        	$(".sisalto_2").append('<?php include 'kommentti_2.php' ?>');
        	$(".sisalto_3").append('<?php include 'kommentti_3.php' ?>');
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
		<div id="kommenttilista">
		</div>
</div>
<script>
	$('#aihe1').click(function(){haeAihe(1);});
	$('#aihe2').click(function(){haeAihe(2);});
	$('#aihe3').click(function(){haeAihe(3);});
	$('#aihe4').click(function(){haeAihe(4);});
	$('.comment').click(function(){
		haeKommentti();
		console.log("kala-animationsd");
		/*function haeAihe(g){
			$('#kommenttilista').text('');
			var aiheID=g;

			$.ajax({
				type: "POST",
				url: "kommentit.php",
				data: 'komma='+aiheID,
				success:function(data){
					var d=data;
					$('#kommenttilista').append(d);
				}
			});	
		}*/
	});
</script>
</body></html>




