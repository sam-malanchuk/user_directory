// Custom Search JS

$('#searchun').keyup(function() {
	var searchterm = $('#searchun').val();
	
	if(searchterm!='') {
		$(".result_item").each(function() {
			var findstring = new RegExp(searchterm, "i");
			var txt = $(this).html();  
			if (findstring.test(txt)){
				$(this).show();
			} else {
				$(this).hide();
			}  
		});
	} else {
		$('.result_item').show();
	}
});
