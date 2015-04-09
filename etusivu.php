
<?php
session_start();
require_once('yhteiset/dbYhteys.php');
require_once('yhteiset/funktiot.php');
require_once('yhteiset/dbFunctions.php');

SSLon();
?>
<?php
//Login -> $_SESSION['kirjautunut']='loggedIn'	
if(!empty($_POST['username'])&&!empty($_POST['pwd'])){
	if(check_user($_POST['username'], $_POST['pwd'], $DBH)){
		$_SESSION['kirjautunut'] = 'loggedIn';
		$userInfoSql=("
			SELECT
				u.userID
			FROM
				a_kayttaja u
			WHERE
				u.username='".$_POST['username']."'"
			);
	//echo("UINFO SQUEEL".$userInfoSql);
	
		$STH=$DBH->query($userInfoSql);
	$STH->setFetchMode(PDO::FETCH_ASSOC);
try{
	while($row=$STH->fetch()){
		$_SESSION['user']=$row['userID'];   //KÄYTTÄJÄN ID SESSIOTA VARTEN MUUTTUJASSA $_SESSION['user']
		//echo($_SESSION['user']);			// JOKAISELLE SIVULLE LAITETTAVA session_start(); ALKUUN ETTÄ TOIMII^^
	}
}catch(PDOException $e){
	echo "Jotain meni pieleen :(";
	file_put_contents('../../loki/PDOErrors.txt', $e->getMessage()."\n",FILE_APPEND);
}
	} else {
		echo '<script>alert("Login Failure");</script>';
	}
}
//Logout session_destroy();
if($_GET['action'] == 'logout'){
	unset($_SESSION['kirjautunut']);
	session_destroy();
}
//Tarkastetaan sisäänkirjatuminen, jos inessä näytetään "Logout"
		  ?>
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
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>    </head>
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
				<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
    			<input type="text" name="username" placeholder="username" id="user"/>
				<input type="password" name="pwd" placeholder="password" id="pwd"/>
				<input type="submit" name="kirjaudu" value="Login" class="button" id="loggaus" />
			</div>
<?php if ($_SESSION['kirjautunut'] == 'loggedIn'):
	?>
	<script>
	$("#user").hide();
	$("#pwd").hide();
	$("#loggaus").replaceWith('<a href="<?php echo $_SERVER[´PHP_SELF´]; ?>?action=logout">Logout	</a>');
    </script>

<?php
//Else Login-palikka
//else: 
?>
<!--<a href="#" data-reveal-id="login">Login</a> -->

<?php
// lopeta if
endif;
?>
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
		<input type="text" name="search" placeholder="Search... " />
     	<input type="submit" name="go" value="Go" class="button" />
	 </div>
			<?php
			// Haetaan julkaisujen tiedot
			
			$STH = $DBH->prepare("SELECT title, sisalto, kuvaus, url FROM a_julkaisu WHERE 	ID = 1;");
			$STH->execute();
			$row_eka = $STH->fetch();
			
			$STH2 = $DBH->prepare("SELECT title, sisalto, kuvaus, url FROM a_julkaisu WHERE 	ID = 2;");
			$STH2->execute();
			$row_toka = $STH2->fetch();
			
			$STH3 = $DBH->prepare("SELECT title, sisalto, kuvaus, url FROM a_julkaisu WHERE 	ID = 3;");
			$STH3->execute();
			$row_kolmas = $STH3->fetch();
			?>
	 
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
   		<div id="sisalto1"></div>
        </div>
        <div class="kesk_1_2">
        <h2 id="title_kesk_1_2"></h2>
		Additionaly it provides some tools useful in real-life cases. Such as the ability for the user to mute the sound. Its is useful when the user is at the office or any place where it isn't polite to have a loud computer :) 

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
   		<div id="sisalto2"></div>
        
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
   		<div id="sisalto3"></div>
        This helper provides a main line out with the good practices from "Developing Game Audio with the Web Audio API" on html5rocks. So it provides a clipping detection and a dynamic compressor to reduce clipping to improve sound quality.

Additionaly it provides some tools useful in real-life cases. Such as the ability for the user to mute the sound. Its is useful when the user is at the office or any place where it isn't polite to have a loud computer :) 
			</div>
            <!-- Lisätään julkaisujen tiedot niiden paikoilleen-->
          	<?php			
			if ($_SESSION['kirjautunut'] == 'loggedIn'):
			?>
        <script>
        	$("#sisalto1").append('<?php echo($row_eka['sisalto']); ?>');
        	$("#sisalto2").append('<?php echo($row_toka['sisalto']); ?>');
        	$("#sisalto3").append('<?php echo($row_kolmas['sisalto']); ?>');
		<?php 	endif; ?>
        	$("#title_kesk_1_1").append('<?php echo($row_eka['title']); ?>');
			$("#kuvaus1").append('<?php echo($row_eka['kuvaus']); ?>');
			$("#title_kesk_1_2").append('<?php echo($row_toka['title']); ?>');
			$("#kuvaus2").append('<?php echo($row_toka['kuvaus']); ?>');
			$("#title_kesk_1_3").append('<?php echo($row_kolmas['title']); ?>');
			$("#kuvaus3").append('<?php echo($row_kolmas['kuvaus']); ?>');
    	</script>
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




