function haeAihe(id){
	$('#keskustelulista').text('');
	var aiheID=id;
	$.ajax({
		type: "POST",
		url: "keskustelut.php",
		data: 'q='+aiheID,
		success:function(data){
			var k=data;
			$('#keskustelulista').append(k);
		}
	});	
}