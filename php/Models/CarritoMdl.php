<?php namespace Models\CarritoMdl;
	
	/**
	* 
	*/
	class CarritoMdl{
		
		function __construct()
		{

			$dsn = 'mysql:dbname=' . DB_NAME . ';host='.DB_HOST;

			try{
				$this->pdo = new \PDO($dsn,DB_USER,DB_PASS);
			}catch(PDOException $e){
				echo  'Connection failed: ' . $e -> getMessage();
			}

		}

		function agregar($IdProducto){

			session_start();
			$IdUsuario 		= $_SESSION['usuarioID'];
			$st = $this->pdo->prepare('SELECT * FROM carrito WHERE IdProducto = ? AND IdUsuario = ?');
			$st->execute(array($IdProducto,$IdUsuario));

			$verificaProducto = $st->rowCount();
			if ($verificaProducto > 0) {
				echo "false";
				return false;
			}else{

				$st = $this->pdo->prepare('SELECT * FROM productos WHERE IdProducto = ?');
				
				$st->execute(array($IdProducto));

				$result = $st -> fetch(\PDO::FETCH_OBJ);
				
				$nombreProducto = $result->NombreProducto;
				$precio			= $result->PrecioProducto;
				$total			= $precio;
				$cantidad		= 1;
				
				

				$st = $this->pdo->prepare('INSERT INTO carrito(IdProducto, ip_add, IdUsuario,  
					                      NombreProductoCart, Cantidad, PrecioCarrito, Total)
											VALUES(?,?,?,?,?,?,?)');

				echo "true";
				return $st->execute(array($IdProducto,'0',$IdUsuario,$nombreProducto,$cantidad,$precio,$total));
			}
			
		}

		function obtenerProductos(){
			session_start();
			$IdUsuario 		= $_SESSION['usuarioID'];

			$st = $this->pdo->prepare('SELECT * FROM carrito WHERE IdUsuario = ?');

			$st->execute(array($IdUsuario));

			$result = $st->fetchAll(\PDO::FETCH_OBJ);

			return $result;

		}

		function eliminarProducto($id){
			session_start();
			$IdUsuario 		= $_SESSION['usuarioID'];

			$st = $this->pdo->prepare('DELETE FROM carrito WHERE IdUsuario = ? AND IdProducto = ?');

			return $st->execute(array($IdUsuario,$id));
		}

		function actualizarProducto($id,$total,$cantidad){
			session_start();
			$IdUsuario 		= $_SESSION['usuarioID'];
			
			$st = $this->pdo->prepare('UPDATE carrito SET Total = ?, Cantidad = ? WHERE IdUsuario = ? AND IdProducto = ?');
			return $st->execute(array($total,$cantidad,$IdUsuario,$id));
		}

		function badgeCart(){
			session_start();
			$IdUsuario 		= $_SESSION['usuarioID'];

			$st = $this->pdo->prepare('SELECT * FROM carrito WHERE IdUsuario = ?');

			$st->execute(array($IdUsuario));

			$filas = $st->rowCount();

			return $filas;
		}
		
	}