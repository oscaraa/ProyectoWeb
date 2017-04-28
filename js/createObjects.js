var counter = 1;
var limit = 3;
function addInput(divName,tipo){
	switch(tipo){
	case 'txt':
	     if (counter == limit)  {
	          alert("Solo se pueden añadir " + counter + " telefonos");
	     }
	     else {
	          var newdiv = document.createElement('div');
	          newdiv.innerHTML = divName + " " + (counter + 1) + " <br/> <input type='text' class='form-control' name='telefono'>";
	          document.getElementById(divName).appendChild(newdiv);
	          counter++;
	     }
		break;
	case 'file':
		if (counter == limit)  {
	          alert("Solo se pueden añadir " + counter + " imagenes");
	     }
	     else {
	          var newdiv = document.createElement('div');
	          newdiv.innerHTML = divName + " " + (counter + 1) + " <br/> <input type='file' name='archivo' type='file' multiple class='file-loading'>";
	          document.getElementById(divName).appendChild(newdiv);
	          counter++;
	     }	 
		break;
	}  
}