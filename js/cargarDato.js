$(document).ready(function(){
muestraMarca();
function muestraMarca(){
				$.ajax({
					type: 'GET',
					url: 'php/index.php/?ctrl=marcas&act=listar&r=json',
					dataType: 'json',
					success: function(json){
						var divSideBar = document.getElementById('sideBarAccount');
						for (i in json) {
							var texto = document.createTextNode(json[i].Marca);
							var li = document.createElement('li');
							var link = document.createElement('a');
							link.appendChild(texto);
							link.setAttribute('href','#');
							link.setAttribute('id',json[i].IdMarca);
							link.setAttribute('class','marcas');
							

							li.appendChild(link);
							divSideBar.appendChild(li);
						}
						
					}
				});
			}



});