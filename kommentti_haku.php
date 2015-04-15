<?php

$popular_max=[];

		// Suosituimpien julkaisujen selvitys
		
				// Selvitetään montako julkaisua meillä on

$lkm = $DBH->prepare("SELECT COUNT(ID) FROM a_julkaisu WHERE ID;");
$lkm->execute();
$lkm_data = $lkm->fetch();


				
$mostPopularID = [];
$vertaus[0] = 0;
$popular_max = [];

		// Selvitetään kuinka monta kommenttia kussakin julkaisussa
				
for ($i = 0; $i < $lkm_data['COUNT(ID)']; $i++) {
	$popularity = $DBH->prepare("SELECT COUNT(julkaisu) FROM a_kommentti WHERE julkaisu = ".$i.";");
	$popularity->execute();
	$popularity_data = $popularity->fetch();
	$mostPopularID[$i-1] = $i;
	$popular_max[$i-1] = intval($popularity_data['COUNT(julkaisu)']) ;	
		// päivitetään postilaskuri				
	$update = $DBH->prepare("UPDATE a_julkaisu SET postilaskuri = ".$popular_max[$i-1]." WHERE ID = ".$i.";");
	$update->execute();
}
			//Järjesteetään popular max array suurimmasta pienimpään
rsort($popular_max);

	// Laitetaan julkaisut järjestykseen suosimmuuden mukaan
			
for($i = 1; $i < $lkm_data['COUNT(ID)']; $i++){

	
	
	$id = $DBH->prepare("SELECT ID FROM a_julkaisu WHERE postilaskuri = ".$popular_max[$i-1].";");
	$id->execute();
	$id_data = $id->fetch();
	$mostPopularID[$i-1] = intval($id_data['ID']); 
		}			
		

	


				// Haetaan julkaisujen tiedot

$STH = $DBH->prepare("SELECT title, sisalto, kuvaus, url FROM a_julkaisu WHERE 	ID = ".$mostPopularID[0].";");
$STH->execute();
$row_eka = $STH->fetch();

$STH2 = $DBH->prepare("SELECT title, sisalto, kuvaus, url FROM a_julkaisu WHERE ID =	".$mostPopularID[1].";");
$STH2->execute();
$row_toka = $STH2->fetch();

$STH3 = $DBH->prepare("SELECT title, sisalto, kuvaus, url FROM a_julkaisu WHERE ID = ".$mostPopularID[2].";");
$STH3->execute();
$row_kolmas = $STH3->fetch();

		// Haetaan suosituimpien julkaisujen kommentit
$STH_kommentit1 = $DBH->prepare("SELECT user_ID, kommentti, audio FROM a_kommentti WHERE julkaisu = ".$mostPopularID[0].";");
$STH_kommentit1->execute();
if($STH_kommentit1->num_rows > 0){
	echo('<br> </br>');
	while($kommentit_eka = $STH_kommentit1-> fetch_assoc()){
		echo("<br>".$kommentit_eka['kommentti']."</br>");
		}
	}

$STH_kommentit2 = $DBH->prepare("SELECT user_ID, kommentti, audio FROM a_kommentti WHERE julkaisu = ".$mostPopularID[1].";");
$STH_kommentit2->execute();
$kommentit_toka = $STH_kommentit2->fetch();

$STH_kommentit3 = $DBH->prepare("SELECT user_ID, kommentti, audio FROM a_kommentti WHERE julkaisu = ".$mostPopularID[2].";");
$STH_kommentit3->execute();
$kommentit_kolmas = $STH_kommentit3->fetch();	
?>
