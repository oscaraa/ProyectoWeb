<?php namespace Controllers\ProductoCtrl;
	
	require('Models/ProductoMdl.php');
	use Models\ProductoMdl as model;
	/**
	* 
	*/
	class ProductoCtrl{
		//__nombre son metodos magicos
		function __construct()
		{
			//echo "entre";
			$this->modelo = new model\ProductoMdl();
		}

		/**
		*	Valida la accion
		* @return [mixed] [json con datos]
		*/
		
		function ejecutar(){
			if (!isset($_GET['act'])) {
				$_GET['act'] = 'listar';
			}
				switch ($_GET['act']) {
					case 'listar':
						return $this->listar();
						break;
					case 'crear':
						return $this->agregar();
						break;
					case 'mostrar':
						return $this->mostrar();
						break;
					case 'modificar':
						$this->modificar();
						break;
					case 'eliminar':
						return $this->eliminar();
						break;
					case 'muestraProductoM':
						return $this->muestraProductoM();
						break;	
					case 'buscar':
						return $this->buscaProducto();
						break;	
					case 'paginacion':
						return $this->paginacion();
						break;
					default:
						return "accion no valida";
						break;
				
			}
		}

		/**
		 * 
		 */
		function agregar(){
				
			if (isset($_POST['nombre']) && isset($_POST['price'])) {
				
				if (isset($_FILES['imagen']['name'])) {
					$nombre_imagen 		= $_FILES['imagen']['name'];
					$tmp 				= explode(".",$nombre_imagen);
					$extension			= $tmp[1];
					$tipo_imagen 		= $_FILES['imagen']['type'];
					$tam_imagen 		= $_FILES['imagen']['size'];
				}
					
				$carpeta_destino	= $_SERVER['DOCUMENT_ROOT'].'/Proyecto-Web/img/';
				$nombre 			= $_POST['nombre'];
				$precio 			= $_POST['price'];
				$idMarca			= $_POST['lista'];
				$descrip	 		= $_POST['Observaciones'];
				$keywords			= $descrip;
				
				$nuevoNombreImagen 	= $this->generateRandomString();
				$idCategoria		= 1;

				if (file_exists($carpeta_destino.$nuevoNombreImagen)) {
					while (file_exists($carpeta_destino.$nuevoNombreImagen)) {
						$nuevoNombreImagen 	= $this->generateRandomString();
					}
				}

				$imagen 			= $nuevoNombreImagen.".".$extension;
				

				if ($tam_imagen < 1000000) {
					if ($tipo_imagen == 'image/jpg' || $tipo_imagen == 'image/jpeg' || $tipo_imagen == 'image/png')
					{
						move_uploaded_file($_FILES['imagen']['tmp_name'], $carpeta_destino.$nuevoNombreImagen.".".$extension);
						return $this->modelo->altaProducto($nombre,$idMarca,$idCategoria,$precio,
															$descrip,$imagen,$keywords);
					}else{
						echo "Solo admiten JPG,JPEG,PNG";
					}
				}else{
					echo "No se admiten archivos mayores a 1 Mb";
				}
			}else{
				echo "No enviaste datos";
			}
		}

		function modificar(){
			echo "estoy modificando";
		}

		function listar(){
			
			//del modelo de sacaras todo
			//var_dump($this->modelo->obtenerProductos());
			//vas a regresar el json
			if (isset($_GET['r']) && $_GET['r'] == 'json') {
				$inicio = $_GET['i'];
				
				return json_encode($this->modelo->obtenerProductos($inicio));
				
			}
			
		}

		function buscaProducto(){
			if (isset($_GET['r']) && $_GET['r'] == 'json') {
				$keywords = $_GET['keyword'];
				return json_encode($this->modelo->buscarProductos($keywords));
				
			}
		}

		function eliminar(){
		
		}

		function mostrar(){
			$id = $_GET['id'];
			if (isset($_GET['r']) && $_GET['r'] == 'json') {
				return json_encode($this->modelo->muestraProdcuto($id));
				
			}
		}

		function muestraProductoM(){
			$id = $_GET['IdM'];
			if (isset($_GET['r']) && $_GET['r'] == 'json') {
				return json_encode($this->modelo->muestraPM($id));
				
			}
		}

		function generateRandomString(){
			$caracteres = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz1234567890"; //posibles caracteres a usar
			$numerodeletras=10; //numero de letras para generar el texto
			$cadena = ""; //variable para almacenar la cadena generada
			for($i=0;$i<$numerodeletras;$i++)
			{
			    $cadena .= substr($caracteres,rand(0,strlen($caracteres)),1); /*Extraemos 1 caracter de los caracteres 
			entre el rango 0 a Numero de letras que tiene la cadena */
			}

			return $cadena;
		} 

		function paginacion(){
			return json_encode($this->modelo->paginacionIndex());
		}

	}