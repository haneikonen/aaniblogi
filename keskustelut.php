<?php
require_once('yhteiset/dbYhteys.php');
$z=$_POST['q'];


$keskustelulista=
"SELECT 
	j.title,
	j.ID
FROM 
	a_julkaisu j
WHERE 
	j.aihealue=".$z."
	;";
$STH=$DBH->query($keskustelulista);
$STH->setFetchMode(PDO::FETCH_ASSOC);
try{
	while($row=$STH->fetch()){
		echo('<a href="#" id='.$row['ID'].' class="comment">'.$row['title'].'</a><br \>');
	}
}catch(PDOException $e){
	echo "Jotain meni pieleen :(";
	file_put_contents('../../loki/PDOErrors.txt', $e->getMessage()."\n",FILE_APPEND);
}
?>