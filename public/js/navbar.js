$(document).ready(function(){

	//var url = "http://localhost/fiscalizacion/public";

	var elementos = $('.nav-link');

	$.each(elementos, function(i, val){
		if (val.href == window.location) {
			if ($(val).parent().parent().parent().attr('class') == 'nav-parent') {
				$(val).parent().parent().parent().addClass('nav-expanded nav-active');
				$(val).addClass('nav-active');
			} else {
				$(val).addClass('nav-active');
			}
		} 
	});

});