function validacion() {

  valor = document.getElementById("name").value;
  apellidos = document.getElementById("apellidos").value;
  opciones = document.getElementsByName("gender");
  pass = document.getElementById("password").value;
  confirmar = document.getElementById("confirm").value;
  correo = document.getElementById("correo").value;
  regex = /[\w-\.]{2,}@([\w-]{2,}\.)*([\w-]{2,}\.)[\w-]{2,4}/;
  if (valor == null || valor.length == 0 || /^\s+$/.test(valor)) {
    alert('El campo nombre debe ser completado');
    return false;
  }else if (apellidos == null || apellidos.length == 0 || /^\s+$/.test(apellidos)) {
    alert('El campo apellidos debe ser completado');
    return false;
  }else if (pass == null || pass.length == 0 || /^\s+$/.test(pass)) {
    alert('El campo de contraseña y confirmar contraseña no son validos');
    return false;
  }else if (confirmar != pass) {
    alert('El campo de contraseña y confirmar contraseña no son validos');
    return false;
  }else if( !$('#agree').prop('checked') ) {
    alert('Debe aceptar termino y condiciones');
     return false; 
  }else if (/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3,4})+$/.test(correo) == false) {
      alert('El formato del correo es invalido');
     return false;
  }
  // Si el script ha llegado a este punto, todas las condiciones
  // se han cumplido, por lo que se devuelve el valor true
  return true;
}