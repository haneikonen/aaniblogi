function haeKommentti(julkId){
	$('#kommenttilista').text('');
	$.ajax({
		type: "POST",
		url: "kommentit.php",
		data: 'q='+julkId,
		dataType: 'json',
		success:function(data){
			data.comments.forEach(function(c){
			var kommentti='<div class="comment">'+
				'<p class="kommentti-uname">'+c.username+'</p>'+
				'<p class="audio">'+c.audio+'</p>'+
				'<p class="comment-text">'+c.kommentti+'</p>'+
				'</div>';
				$('#kommenttilista').append(kommentti);
			})
		}
	});	

}