<?php
require_once('../yhteiset/dbYhteys.php');
$z=$_POST['q'];

//$z=1;

$keskustelu=[];
$keskustelut=[];
$keskustelulista=
"SELECT 
	j.title,
	j.ID,
	j.url
FROM 
	a_julkaisu j
WHERE 
	j.aihealue=".$z."
	;";
$STH=$DBH->query($keskustelulista);
$STH->setFetchMode(PDO::FETCH_ASSOC);
/*try{
	while($row=$STH->fetch()){
		echo('<a href="#" id='.$row['ID'].' class="comment">'.$row['title'].'</a><br \>');
	}
}
*/
$keskustelut["om"]=[];
	try{
		while($row=$STH->fetch()){
			$keskustelu=array('title' => $row['title'], 'id' => $row['ID']);
			//$keskustelut["om"]=$keskustelu;
			array_push($keskustelut["om"],$keskustelu);
		}
		//echo("ECHO ".json_encode($keskustelu));
		//print_r($keskustelu);
		echo(json_encode($keskustelut));
		
	}
catch(PDOException $e){
	echo "Jotain meni pieleen :(";
	file_put_contents('../../loki/PDOErrors.txt', $e->getMessage()."\n",FILE_APPEND);
}
?>
