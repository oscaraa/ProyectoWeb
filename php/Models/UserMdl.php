<?php namespace Models\UserMdl;
	include('config.php');
	
	/**
	* 
	*/
	class UserMdl{
		
		function __construct()
		{

			$dsn = 'mysql:dbname=' . DB_NAME . ';host='.DB_HOST;

			try{
				$this->pdo = new \PDO($dsn,DB_USER,DB_PASS);
			}catch(PDOException $e){
				echo  'Connection failed: ' . $e -> getMessage();
			}

		}

		function obtenerUsuarios(){
			$st = $this->pdo -> prepare('SELECT * FROM user');

			$st->execute();

			$result = $st -> fetchAll(\PDO::FETCH_OBJ);

			return $result;
		}

		function altaUsuarios($nombre,$correo,$apellidos,$password,$telefono,$cp,
							  $telefono2,$telefono3,$fech_naci,$direccion,$idTipo){
			$st = $this->pdo->prepare('SELECT IdUsuario FROM user WHERE Correo = ? LIMIT 1	');
			$st->execute(array($correo));
			$checaCorreo = $st->rowCount();
			if ($checaCorreo > 0) {
				echo $checaCorreo;
				return $checaCorreo;
				exit();
			}else{
				$st = $this->pdo->prepare('INSERT INTO user(Nombre,Apellidos,Telefono1,Correo,CP,Password,Direccion,Telefono2,Telefono3,IdTipoUsuario,FechaNacimiento) VALUES(?,?,?,?,?,?,?,?,?,?,?)');

				return $st->execute(array($nombre,$apellidos,$telefono,$correo,$cp,$password,$direccion,
										$telefono2,$telefono3,$idTipo,$fech_naci));	
			}
			

		}

		function muestraUsuario($id){
			$st = $this->pdo -> prepare('SELECT * FROM user WHERE IdUsuario = ?');

			$st->execute(array($id));

			$result = $st -> fetchAll(\PDO::FETCH_OBJ);

			return $result;
		}

		function eliminaUsuario($id){
			$st = $this->pdo->prepare('DELETE FROM user WHERE IdUsuario = ?');

			return $st->execute(array($id));
		}

		function modificaUsuario($nombre,$correo,$apellidos,$password,$telefono,$cp,
							  $telefono2,$telefono3,$fech_naci,$direccion,$idTipo,$id){
			$st = $this->pdo->prepare('UPDATE user SET Nombre = ?,Apellidos = ?, Telefono1 = ?, Correo = ?, 
				CP = ?, Password = ?, Direccion = ?, Telefono2 = ?, Telefono3 = ?, IdTipoUsuario = ?, FechaNacimiento = ? WHERE IdUsuario = ?');

			return $st->execute(array($nombre,$apellidos,$telefono,$correo,$cp,$password,$direccion,
										$telefono2,$telefono3,$idTipo,$fech_naci,$id));

		}

		function loginUsuario($correo,$password){
			$st = $this->pdo -> prepare('SELECT * FROM user WHERE Correo = ? AND Password = ?');

			$st->execute(array($correo,$password));

			$checaCorreo = $st->rowCount();
			if ($checaCorreo == 1) {
				session_start();
				$result = $st -> fetch(\PDO::FETCH_OBJ);
				$_SESSION['usuarioID'] =  $result->IdUsuario;
				$_SESSION['usuarioNombre'] =  $result->Nombre;
				$_SESSION['usuarioTipo'] =  $result->IdTipoUsuario;
				echo "true";

			}else{
				echo "false";
			}
		}

		function loginD(){
			session_start();
			if (!isset($_SESSION['usuarioID'])) {
				
				return false;
			}else{
				return $_SESSION['usuarioNombre'];
			}
		}

		function loginAdmin(){
			session_start();
			$tipo =$_SESSION['usuarioTipo'];
			if (!isset($_SESSION['usuarioID'])) {
				
				return false;
			}else{
				if ( $tipo == 2) {
					return false;
				}else{
					return $_SESSION['usuarioNombre'];	
				}
			}
		}

		function logOutUsuario(){
			session_start();
			unset($_SESSION['usuarioNombre']);
			unset($_SESSION['usuarioID']);
			unset($_SESSION['usuarioTipo']);
			return true;
		}

		
	}