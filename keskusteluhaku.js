function haeAihe(id){
	$('#keskustelulista').text('');
	$('#kommenttilista').text('');
	var aiheID=id;
	$.ajax({
		type: "POST",
		url: "keskustelut.php",
		data: 'q='+aiheID,
		dataType: 'json',
		success:function(data){
			data.om.forEach(function(k){
				console.log(k.id);
				//console.log("hei");
				linkki='<p id="link'+k.id+'">'+k.title+'</p>';
				$('#keskustelulista').append(linkki);
				$('#link'+k.id).click(function(){
					haeKommentti(k.id);
				})
			})
		}
	});	
}
/*

data.hits.forEach(function(hit){
			kuva='<img src="'+hit.previewURL+'" id="img'+f+'" class="searchResultImg"></img>';
			$('#searchResults').append(kuva);
			$('#img'+f).click(function(){
				
				
				*/