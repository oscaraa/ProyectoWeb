
function validacion() {

  valor     = document.getElementById("nombre").value;
  apellidos = document.getElementById("apellidos").value;
  telefono  = document.getElementsByName("telefono").value;
  pass      = document.getElementById("password").value;
  confirmar = document.getElementById("confirmar").value;
  correo    = document.getElementById("correo").value;
  fecha     = document.getElementById("fech_naci").value;
  cp        = document.getElementById("cp").value;
  direccion = document.getElementById("direccion").value;

 if (valor == null || valor.length == 0 || /^\s+$/.test(valor)) {
    errorAlert('Error', 'El campo nombre debe ser completado!'); 
    return false;
  }else if (apellidos == null || apellidos.length == 0 || /^\s+$/.test(apellidos)) {
    errorAlert('Error', 'El campo apellidos debe ser completado!'); 
    return false;
  }/*else if (/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3,4})+$/.test(correo) == false) {
    errorAlert('Error', 'El formato del correo es invalido');   
    return false;
  }*/else if(valor == null || valor.length == 0 || /^\s+$/.test(cp)){
    errorAlert('Error', 'El campo de codigo postal debe de ser llenado');   
    return false;
  }else if(valor == null || valor.length == 0 || /^\s+$/.test(direccion)){
    errorAlert('Error', 'El campo de direccion debe de ser llenado');   
    return false;
  }else if(valor == null || valor.length == 0 || /^\s+$/.test(telefono)){
    errorAlert('Error', 'El campo de telefono debe de ser llenado');   
    return false;
  }else if (pass == null || pass.length == 0 || /^\s+$/.test(pass)) {
    errorAlert('Error', 'El campo password debe ser completado!'); 
    return false;
  }else if (confirmar != pass) {
    errorAlert('Error', 'No coinciden las contraseña'); 
    return false;
  }else if( !$('#agree').prop('checked') ) {
    errorAlert('Error', 'Debe aceptar termino y condiciones'); 
    return false; 
  }
  return true; 
 }