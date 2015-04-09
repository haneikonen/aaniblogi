<?php
require_once('yhteiset/funktiot.php');
require_once('yhteiset/dbYhteys.php');
SSLon();
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Julkaisu</title>
</head>

<body>
<?php
$sql = "(SELECT userID FROM a_kayttaja WHERE username = 'pelle')";
$smtp = $DBH->prepare($sql);
$userID = $smtp->execute();


?>
<div id="comment" class="reveal-modal" data-reveal>
 <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
	Select a file: <input type="file" name="url" />
	<input type="text" name="title" placeholder="Julkaisun nimi" />
	<input type="text" name="kuvaus" placeholder="Kuvaile julkaisuasi" />
	<input type="text" name="sisalto" placeholder="Kerro julkaisustasi" />
    <input type="submit" name="julkaise" value="Julkaise" class="button" />
  </form>
  <a class="close-reveal-modal">&#215;</a> </div>
<?php

if (!empty($_POST['kuvaus'])&&!empty($_POST['sisalto'])&&!empty($_POST['title'])){
	$data['url'] = $_POST['url'];
	$data['kuvaus'] = $_POST['kuvaus'];
	$data['sisalto'] = $_POST['sisalto'];
	$data['title'] = $_POST['title'];
	$data['user_ID'] = $userID;
	
	try {// Puuttuu julkaisu
		$STH = $DBH->prepare("INSERT INTO a_julkaisu (`url`, `user_ID`,`title`, `kuvaus`, `sisalto`) VALUES ('".$_POST['url']."','".$userID."','".$_POST['title']."', '".$_POST['kuvaus']."','".$_POST['sisalto']."')");
		$STH->execute($data);
		echo 'LisÃ¤ys onnistui';
	} catch(PDOException $e) {
		echo "LisÃ¤ys ei onnistunut.";
		// TODO: tulosta mahdollinen virheilmoitus tekstitiedostoon (nimi esim: PDOErrors.txt)
			file_put_contents('loki/PDOErrors.txt', $e->getMessage()."\n", FILE_APPEND);
	}
}

?>
</body>
</html>
