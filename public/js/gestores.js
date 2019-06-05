$(document).ready(function(){
	var url = "http://localhost/fiscalizacion/public";

	$('#editar').click(function(){

		var data = { 'name': 'luis' };

       //we will send data and recive data fom our AjaxController

       $.ajax({
          url: url + '/prueba-ajax',
          data: data,
          success: function (response) {
          	alert(response);
          }
       });
	});
});