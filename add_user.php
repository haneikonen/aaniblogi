<?php
require_once('yhteiset/funktiot.php');
require_once('yhteiset/dbYhteys.php');
SSLon();
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Add_user</title>
</head>

<body>

<div id="add_user" class="reveal-modal" data-reveal>
  <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
	<input type="text" name="email" placeholder="anna sähköpostiosoite" />
    <input type="text" name="username" placeholder="anna haluttu käyttäjänimi" />
    <input type="password" name="password" placeholder="anna salasanasi" />
    <input type="submit" name="add_user" value="add_user" class="button" />
  </form>
  <a class="close-reveal-modal">&#215;</a> </div>
<?php
if (!empty($_POST['username'])&&!empty($_POST['password'])&&!empty($_POST['email'])){
	$data['username'] = $_POST['username'];
	$data['password'] = $_POST['password'];
	$data['email'] = $_POST['email'];
	$hashpwd = hash('md5', $password);
	
	try {
		$STH = $DBH->prepare("INSERT INTO a_kayttaja (`username`, `password`, `email`) VALUES ('".$_POST['username']."','".$hashpwd."','".$_POST['email']."')");
		$STH->execute($data);
		echo ($_POST['username']);
		echo ($hashpwd);
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
