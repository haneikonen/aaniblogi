<?php
//require_once('yhteiset/funktiot.php');
//require_once('yhteiset/dbYhteys.php');
//SSLon();
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Add_comment</title>
</head>

<body>
<?php
$sql = "(SELECT userID FROM a_kayttaja WHERE username = 'pelle')";
$smtp = $DBH->prepare($sql);
$userID = $smtp->execute();


?>
<div id="comment" class="reveal-modal" data-reveal>
  <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
	<input type="text" name="kommentti" placeholder="Kommenttisi" />
<!--	<input type="text" name="username" value=" username" /> -->
    <input type="submit" name="add_comment" value="Kommentoi" class="button" />
  </form>
  <a class="close-reveal-modal">&#215;</a> </div>
<?php

if (!empty($_POST['kommentti'])){
	$data['kommentti'] = $_POST['kommentti'];
	$data['user_ID'] = $userID;
	
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

?>
</body>
</html>