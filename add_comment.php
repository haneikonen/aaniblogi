


<?php
session_start();
require_once('yhteiset/dbYhteys.php');
require_once('yhteiset/funktiot.php');
require_once('yhteiset/dbFunctions.php');
SSLon();
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
if ($_SESSION['kirjautunut'] == 'loggedIn'):
?>
	<a href="<?php echo $_SERVER['PHP_SELF']; ?>?action=logout">Logout</a>
	<p>Username: <?php echo $_POST['username'] ?> </p>
	<?php require_once('julkaisu.php');	
endif;
?>
<!doctype html>
<html>
<head>
   		<script src="js/video.js"></script>
		<script src="js/wavesurfer.min.js"></script>
		<script src="js/videojs.wavesurfer.js"></script>
		<script src="js/funktioita.js"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>

<meta charset="utf-8">
<title>Add_comment</title>
</head>

<body>

	<div class="login" id="login">
			<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
   			<input type="text" name="username" placeholder="username" id="user"/>
			<input type="password" name="pwd" placeholder="password" id="pwd"/>
			<input type="submit" name="kirjaudu" value="Login" class="button" id="loggaus" />
	</div>
    
    
<?php if ($_SESSION['kirjautunut'] == 'loggedIn'):	?>
	<script>
	$("#user").hide();
	$("#pwd").hide();
	$("#loggaus").replaceWith('<a href="<?php echo $_SERVER[´PHP_SELF´]; ?>?action=logout">Logout	</a>');
    </script>
<?php endif;?>

<div id="comment" class="reveal-modal" data-reveal>
  <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
	<input type="text" name="kommentti" placeholder="Kommenttisi" />
<!--	<input type="text" name="username" value=" username" /> -->
    <input type="submit" name="add_comment" value="Kommentoi" class="button" />
  </form>
  <a class="close-reveal-modal">&#215;</a> </div>
<?php
$data['user_ID'] = $_POST['username'] ;
$user = $DBH->prepare("SELECT userID FROM a_kayttaja WHERE username = '".$_POST['username']."';");
$user->execute();
$user_data = $user->fetch();
$userID = $user_data['userID'];


if (!empty($_POST['kommentti'])){
	$data['kommentti'] = $_POST['kommentti'];

	
	try {// Puuttuu julkaisu
		$STH = $DBH->prepare("INSERT INTO a_kommentti (`user_ID`,`kommentti`, `audio`) VALUES ('".$userID."','".$_POST['kommentti']."','".$_POST['audio']."')");
		$STH->execute($data);
		echo 'Lisäys onnistui';
	} catch(PDOException $e) {
		echo "Lisäys ei onnistunut.";
		// TODO: tulosta mahdollinen virheilmoitus tekstitiedostoon (nimi esim: PDOErrors.txt)
			file_put_contents('loki/PDOErrors.txt', $e->getMessage()."\n", FILE_APPEND);
	}
}

 echo $user_data['userID'] ?>
 

</body>
</html>
