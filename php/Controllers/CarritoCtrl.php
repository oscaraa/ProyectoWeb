<?php namespace Controllers\CarritoCtrl;
	
	require('Models/CarritoMdl.php');
	use Models\CarritoMdl as model;
	/**
	* 
	*/
	class CarritoCtrl{
		//__nombre son metodos magicos
		function __construct()
		{
			//echo "entre";
			$this->modelo = new model\CarritoMdl();
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
						$this->agregar();
						break;
					case 'mostrar':
						$this->mostrar();
						break;
					case 'modificar':
						return $this->modificar();
						break;
					case 'eliminar':
						$this->eliminar();
						break;	
					case 'badge';
						return $this->badge();
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
			$id = $_POST['idProducto'];
			return json_encode($this->modelo->agregar($id));
		}

		function modificar(){
			$id 		= $_POST['IdProducto'];
			$total		= $_POST['TotalPrecio'];
			$cantidad	= $_POST['CantidadProducto'];
			if ($total == 0) {
				echo "false";
				
			}else{
				return json_encode($this->modelo->actualizarProducto($id,$total,$cantidad));
			}
		}

		function listar(){
			
			//del modelo de sacaras todo
			//var_dump($this->modelo->obtenerProductos());
			//vas a regresar el json
			if (isset($_GET['r']) && $_GET['r'] == 'json') {
				return json_encode($this->modelo->obtenerProductos());
				
			}
			
		}

		function eliminar(){
			$id = $_POST['IdProducto'];
			return json_encode($this->modelo->eliminarProducto($id));
		}

		function badge(){
			return json_encode($this->modelo->badgeCart());
		}
	
	}