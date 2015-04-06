<?php
	session_start();
    $host = 'localhost';
    $dbname = 'aaniblogi'; // your username
    $user = 'hannui'; // your username
    $pass = 'parasmies'; // your database password



$data=array();
if(!empty($_POST['Otsikko']) && !empty($_POST['Julkaisu'])){
	$data['title']=$_POST['Otsikko'];
	$data['julkaisu']=$_POST['Julkaisu'];
	$data['user_ID']=$_SESSION['user'];

	
try {

	$DBH = new PDO("mysql:host=$host;dbname=$dbname", $user, $pass);
	$DBH->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
	$DBH->query("SET NAMES 'UTF8';");

}catch(PDOException $e) {

	echo "Could not connect to database.";
	file_put_contents('log.txt', $e->getMessage(), FILE_APPEND);
}	
	try {
		$STH = $DBH->prepare("INSERT INTO a_julkaisu (title, sisalto, user_ID) VALUES (:title, :julkaisu,:user_ID);");
		$STH->execute($data);
		//echo 'Lisäys onnistui';
	} catch(PDOException $e) {
		echo "Jokin meni pieleen :(";
			file_put_contents('loki/PDOErrors.txt', $e->getMessage()."\n", FILE_APPEND);
	}
}
?>