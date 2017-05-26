function validacionArticulo() {

  nombre    = document.getElementById("nombre").value;
  precio    = document.getElementById("price").value;

  
  
  if (nombre == null || nombre.length == 0 || /^\s+$/.test(nombre)) {
    alert('El campo nombre debe ser completado');
    return false;
  }else if (precio == null || precio.length == 0 || /^\s+$/.test(precio)) {
    alert('El campo apellidos debe ser completado');
    return false;
  }
  // Si el script ha llegado a este punto, todas las condiciones
  // se han cumplido, por lo que se devuelve el valor true
  return true;
}