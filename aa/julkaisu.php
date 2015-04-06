<?php
session_start();
require_once('yhteiset/dbYhteys.php');
require_once('yhteiset/funktiot.php');
require_once('yhteiset/dbFunctions.php');
SSLon();
?>

<?php
	$haeJulkaisut=('
		SELECT
			j.title,
			u.username
		FROM
			a_julkaisu j,
			a_kayttaja u
		WHERE
			j.user_ID=u.userID
		');
		
	$STH=$DBH->query($haeJulkaisut);
	$STH->setFetchMode(PDO::FETCH_ASSOC);
	
	try{
		while($row=$STH->fetch()){
			?>
			<div>
			<p> 
				<?php 
					echo($row['title']);
					echo(' '.$row['username']);
				?>
			</p>
			</div>
		<?php
		}
	}catch(PDOException $e){
		echo "Jotain meni pieleen :(";
		file_put_contents('../../loki/PDOErrors.txt', $e->getMessage()."\n",FILE_APPEND);
	}
?>
<?php

?>
<div id="julkaisu">
  <form action="add_julkaisu.php" method="post">
  <input type="text" name="Otsikko" placeholder="Otsikko"/>
	<input type="text" name="Julkaisu"/>
<!--	<input type="text" name="username" value=" username" /> -->
    <input type="submit" name="add_julkaisu" value="Tee uusi ketju"/>
  </form>
