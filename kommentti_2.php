<?php 
$count = $DBH->prepare("SELECT COUNT(julkaisu) FROM a_kommentti WHERE julkaisu = ".$mostPopularID[1].";");
$count->execute();
$count_data = $count->fetch();
$cnt_rows = $count_data['COUNT(julkaisu)'];

$sql = "SELECT user_ID, kommentti, audio FROM a_kommentti WHERE julkaisu = ".$mostPopularID[1].";";
$result = $DBH->query($sql);				
if($cnt_rows > 0){
	for($i = 1; $i < $cnt_rows; $i++){
		$row = $result-> fetch();
		echo('<br><td>'.$row['kommentti'].'</td></br>');
		}
	} else{
		echo('No comments');
	}
	?>
