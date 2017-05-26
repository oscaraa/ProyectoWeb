<?php namespace Models\ProductoMdl;
	
	/**
	* 
	*/
	class ProductoMdl{
		
		function __construct()
		{

			$dsn = 'mysql:dbname=' . DB_NAME . ';host='.DB_HOST;

			try{
				$this->pdo = new \PDO($dsn,DB_USER,DB_PASS);
			}catch(PDOException $e){
				echo  'Connection failed: ' . $e -> getMessage();
			}

		}

		function obtenerProductos($inicio){
			$limite = 9;
			if ($inicio != 0) {
				$inicio = ($inicio * 9) - $limite;
					
			}
			
			$st = $this->pdo -> prepare("SELECT * FROM productos LIMIT $inicio,$limite");

			$st->execute();


			$result = $st -> fetchAll(\PDO::FETCH_OBJ);

			return $result;
		}

		function altaProducto($nombre,$idMarca,$idCategoria,$precio,$descrip,$imagen,$keywords){

			$st = $this->pdo->prepare('INSERT INTO productos(NombreProducto,IdCategoria,IdMarca,   
				 						PrecioProducto,Producto,ImagenProducto,KeyWordsProducto) 
										VALUES(?,?,?,?,?,?,?)');

			return $st->execute(array($nombre,$idCategoria,$idMarca,$precio,$descrip,$imagen,$keywords));
		}

		function muestraProdcuto($id){
			$st = $this->pdo -> prepare('SELECT * FROM productos WHERE IdProducto = ?');

			$st->execute(array($id));

			$result = $st -> fetchAll(\PDO::FETCH_OBJ);

			return $result;
		}

		function muestraPM($id){
			$st = $this->pdo -> prepare('SELECT * FROM productos WHERE IdMarca = ?');

			$st->execute(array($id));

			$result = $st -> fetchAll(\PDO::FETCH_OBJ);

			return $result;
		}

		function buscarProductos($keyword){
			$st = $this->pdo -> prepare('SELECT * FROM productos WHERE KeyWordsProducto LIKE ?');
			$st->execute(array("%$keyword%"));

			$result = $st -> fetchAll(\PDO::FETCH_OBJ);

			return $result;
		}
		
		function paginacionIndex(){
			$st = $this->pdo->prepare('SELECT * FROM productos');

			$st->execute();

			$filas = $st->rowCount();

			return $paginacion = ceil($filas/9);
		}
	}