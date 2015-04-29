<?php
require_once('yhteiset/dbYhteys.php');
$k=$_POST['q'];

$kommenttilista=
"SELECT a.kommentti FROM a_kommentti a WHERE a.julkaisu=".$k.";";
$STH=$DBH->query($kommenttilista);
$STH->setFetchMode(PDO::FETCH_ASSOC);
try{
	while($row=$STH->fetch()){
		echo('<p>'.$row['kommentti'].'</p>		<script>function haeAihe(g){
			$("#kommenttilista").text("");
			var aiheID=g;

			$.ajax({
				type: "POST",
				url: "kommentit.php",
				data: "komma="+aiheID,
				success:function(data){
					var d=data;
					$("#kommenttilista").append(d);
				}
			});
		}');
	}
}catch(PDOException $e){
		echo "Jotain meni pieleen :(";
		file_put_contents('../../loki/PDOErrors.txt', $e->getMessage()."\n",FILE_APPEND);
}
?>