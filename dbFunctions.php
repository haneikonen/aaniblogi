<?php
function check_user($user, $pwd, $DBH) {
    $hashpwd = hash('md5', $pwd);
    $data = array('k' => $user, 'passu' => $hashpwd);
    try {
        $STH = $DBH->prepare("SELECT * FROM a_kayttaja WHERE username=:k AND
        password = :passu");
        $STH->execute($data);
        $row = $STH->fetch();
        // print_r($row);
        if($STH->rowCount() > 0){
            return true;
        } else {
            return false;
        }
    } catch(PDOException $e) {
        echo "Login DB error.";
        file_put_contents('..\loki\PDOErrors.txt', $e->getMessage()."\n", FILE_APPEND);
    }
}


function editList($STH) {
	$STH->setFetchMode(PDO::FETCH_NUM);
	// Start the table
	$resultHTML = "<table border=\"1\">\n<tr>\n";

	// Output the table header
	$fieldCount = $STH->columnCount(); // number of columns
	
	for ($i=1; $i < $fieldCount; $i++) {
		$meta = $STH->getColumnMeta($i); // names of the fields
		$rowName = $meta['name'];
		$resultHTML .= "<th>$rowName</th>\n";
	} # end for

	$resultHTML .= "</tr>\n";
	
	// Output the table data
	while ($row = $STH->fetch()) {
		$resultHTML .= "<tr>\n";
		for ($i = 1; $i < $fieldCount; $i++)
		   $resultHTML .= "<td>".htmlentities($row[$i])."</td>\n";
		
		// FOR HOMEWORK 3 ADD THE LINKS HERE
		$resultHTML .= "<td><a href=\"?action=modify&ID=".$row[0]."\">Modify</a></td>";
		$resultHTML .= "<td><a href=\"?action=delete&ID=".$row[0]."\">Delete</a></td>";
	
		
		$resultHTML .= "</tr>\n";
		
	} # end while
	
	// Close the table
	$resultHTML .= "</table>\n";
	
	return $resultHTML;

}

function editListAjax($STH) {
	$STH->setFetchMode(PDO::FETCH_NUM);
	// Start the table
	$resultHTML = "<table>\n<tr>\n";

	// Output the table header
	$fieldCount = $STH->columnCount(); // number of columns
	
	for ($i=1; $i < $fieldCount; $i++) {
		$meta = $STH->getColumnMeta($i); // names of the fields
		$rowName = $meta['name'];
		$resultHTML .= "<th>$rowName</th>\n";
	} # end for

	$resultHTML .= "</tr>\n";
	
	// Output the table data
	while ($row = $STH->fetch()) {
	$resultHTML .= "<tr>\n";
	for ($i = 1; $i < $fieldCount; $i++)
	   $resultHTML .= "<td>".htmlentities($row[$i])."</td>\n";
	
	// FOR HOMEWORK 3 ADD THE LINKS HERE
	$resultHTML .= "<td><a href=\"javascript:modify(".$row[0].");\">Modify</a></td>";
    $resultHTML .= "<td><a href=\"javascript:remove(".$row[0].");\">Delete</a></td>";

	
	$resultHTML .= "</tr>\n";
	
} # end while
	
	// Close the table
	$resultHTML .= "</table>\n";
	
	return $resultHTML;

}

?>
