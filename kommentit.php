<?php
//JSON_ENCODE -> voidaan erotella käyttäjä, kommentti ja audio-urli
//javascriptin puolella erikseen

require_once('../yhteiset/dbYhteys.php');
//$k=$_POST['q'];
$k=1;
$kommenttilista=
"SELECT
 a.kommentti,
 a.audio,
 k.username,
 a.posted,
 j.url
FROM
 a_kommentti a,
 a_kayttaja k,
 a_julkaisu j
WHERE
 a.julkaisu=".$k." AND
 a.user_ID=k.userID;";

$STH=$DBH->query($kommenttilista);
$STH->setFetchMode(PDO::FETCH_ASSOC);

$kommentti=[];
$kommentit=[];
$kommentit["comments"]=[];

try{
	while($row=$STH->fetch()){
		$kommentti=array('username'=>$row['username'],'audio'=>$row['audio'],'url'=>$row['url'],'kommentti'=>$row['kommentti'],'time'=>date('G:i j.n.Y',strtotime($row['posted'])));
		array_push($kommentit["comments"],$kommentti);
	}
	echo(json_encode($kommentit));
}catch(PDOException $e){
	echo "Jotain meni pieleen :(";
	file_put_contents('../../loki/PDOErrors.txt', $e->getMessage()."\n",FILE_APPEND);
}
/*try{
	while($row=$STH->fetch()){
		echo('<p>'.$row['kommentti'].'</p><p>'.$row['username'].'</p>');
	}
}catch(PDOException $e){
		echo "Jotain meni pieleen :(";
		file_put_contents('../../loki/PDOErrors.txt', $e->getMessage()."\n",FILE_APPEND);
}*/
?>
