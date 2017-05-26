<?php namespace Controllers\MarcaCtrl;
	
	require('Models/MarcaMdl.php');
	use Models\MarcaMdl as model;
	/**
	* 
	*/
	class MarcaCtrl{
		//__nombre son metodos magicos
		function __construct()
		{
			//echo "entre";
			$this->modelo = new model\MarcaMdl();
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
						$this->modificar();
						break;
					case 'eliminar':
						$this->eliminar();
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
			echo "estoy agregando";
		}

		function modificar(){
			echo "estoy modificando";
		}

		function listar(){
			
			//del modelo de sacaras todo
			//var_dump($this->modelo->obtenerProductos());
			//vas a regresar el json
			if (isset($_GET['r']) && $_GET['r'] == 'json') {
				return json_encode($this->modelo->obtenerMarcas());
				
			}
			
		}

		function eliminar(){
			echo "estoy eliminando";
		}

		function mostrar(){
			echo "estoy mostrando";
		}

		/*function procesarSalida($datos){
			if (isset($_GET['o']) && $_GET['o'] === 'json') {
				return json_encode($datos);
			}

			return $this->procesarVista($datos);
		}*/
	}