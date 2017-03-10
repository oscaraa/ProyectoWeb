function validacion() {
  valor = document.getElementById("name").value;
  apellidos = document.getElementById("apellidos").value;
  opciones = document.getElementsByName("gender");
  var seleccionado = false;
  if (valor == null || valor.length == 0 || /^\s+$/.test(valor)) {
 
    alert('El campo nombre debe ser completado');
    return false;
  }else if (apellidos == null || apellidos.length == 0 || /^\s+$/.test(apellidos)) {
    alert('El campo apellidos debe ser completado');
    return false;
  }else if (!seleccionado) {
        for(var i=0; i<opciones.length; i++) {    
        if(opciones[i].checked) {
          seleccionado = true;
          break;
        }
      }
 
    if(!seleccionado) {
      alert('Se debe seleccionar un genero');
      return false;
    }
  }
  
  // Si el script ha llegado a este punto, todas las condiciones
  // se han cumplido, por lo que se devuelve el valor true
  return true;
}