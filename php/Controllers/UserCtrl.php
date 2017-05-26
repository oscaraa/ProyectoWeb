<?php namespace Controllers\UsersCtrl;
	
	require('Models/UserMdl.php');
	use Models\UserMdl as model;
	/**
	* 
	*/
	class UserCtrl{
		//__nombre son metodos magicos
		function __construct()
		{
			//echo "entre";
			$this->modelo = new model\UserMdl();
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
						return $this->modificar();
						break;
					case 'eliminar':
						 $this->eliminar();
						break;
					case 'login':
						$this->login();
						break;
					case 'usuarioLogin':
						return $this->usuarioLogin();
						break;		
					case 'logOut':
						return $this->logOut();
						break;
					default:
						echo "accion no valida";
						break;
				
			}
		}

		/**
		 * 
		 */
		function agregar(){
			
			if (!empty($_POST)) {
				$nombre 	= $_POST['nombre'];
				$apellidos 	= $_POST['apellidos'];
				$telefono 	= $_POST['telefono'];
				$correo   	= $_POST['correo'];
				$password 	= $_POST['password'];
				$direccion 	= $_POST['direccion'];
				$cp			= $_POST['cp'];
				$telefono2	= null;
				$telefono3	= null;
				$fech_naci  = $_POST['fech_naci'];
				if (empty($_POST['tipo'])) {
					$idTipo = 2;
				}else{
					$idTipo = 1;
				}
				

				return json_encode($this->modelo->altaUsuarios($nombre,$correo,$apellidos,$password,$telefono,
													$cp,$telefono2,$telefono3,$fech_naci,
													$direccion,$idTipo));
			}else{
				$error = 'No se envio ningun dato';
				return json_encode($error);
			}
		}

		function modificar(){
			if (!empty($_POST)) {
				$nombre 	= $_POST['nombre'];
				$apellidos 	= $_POST['apellidos'];
				$telefono 	= $_POST['telefono'];
				$correo   	= $_POST['correo'];
				$password 	= $_POST['password'];
				$direccion 	= $_POST['direccion'];
				$cp			= $_POST['cp'];
				$telefono2	= null;
				$telefono3	= null;
				$fech_naci  = $_POST['fech_naci'];
				if (empty($_POST['lista'])) {
					$idTipo = 2;
				}else{
					$idTipo = 1;
				}
				
				if (!isset($_GET['id'])) {
				session_start();
				$id = $_SESSION['usuarioID'];
				
				}else{
					$id = $_GET['id'];
				}
				
				return json_encode($this->modelo->modificaUsuario($nombre,$correo,$apellidos,	
					$password,$telefono,$cp,$telefono2,$telefono3,$fech_naci,$direccion,$idTipo,$id));
			}else{
				$error = 'No se envio ningun dato';
				return $error;
			}
		}
	

		function listar(){
			//del modelo de sacaras todo
			//var_dump($this->modelo->obtenerProductos());
			//vas a regresar el json
			if (isset($_GET['r']) && $_GET['r'] == 'json') {
				return json_encode($this->modelo->obtenerUsuarios());
				
			}
			
		}

		function login(){
			$correo 	= $_POST['correoUsuario'];
			$password	= $_POST['passCorreo'];
			return json_encode($this->modelo->loginUsuario($correo,$password));
		}

		function usuarioLogin(){
		if (isset($_GET['t']) && $_GET['t'] == 'admin') {
				return json_encode($this->modelo->loginAdmin());
			}else{
				return json_encode($this->modelo->loginD());
			}	
		}

		function logOut(){
			if (isset($_GET['r']) && $_GET['r'] == 'json') {
				return json_encode($this->modelo->logOutUsuario());
				
			}
			
		}

		function eliminar(){

			$id = $_POST['IdUsuario'];
			return json_encode($this->modelo->eliminaUsuario($id));
			
		}

		function mostrar(){
			if (!isset($_GET['id'])) {
				session_start();
				$id = $_SESSION['usuarioID'];
				
			}else{
				$id = $_GET['id'];
			}
			if (isset($_GET['r']) && $_GET['r'] == 'json') {
				return json_encode($this->modelo->muestraUsuario($id));
				
			}
		}



		
	}