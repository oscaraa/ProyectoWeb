$(document).ready(function(){
	cargaMarca();
	function cargaMarca(){
			$.ajax({
				type: 'GET',
				url: 'http://localhost/phpClase/?ctrl=marca&act=listar&r=json',
				dataType: 'json',
				success: function(json){
					console.log(json);
				}
			});
		}
})