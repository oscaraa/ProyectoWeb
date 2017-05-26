<?php namespace Models\MarcaMdl;
	
	/**
	* 
	*/
	class MarcaMdl{
		
		function __construct()
		{

			$dsn = 'mysql:dbname=' . DB_NAME . ';host='.DB_HOST;

			try{
				$this->pdo = new \PDO($dsn,DB_USER,DB_PASS);
			}catch(PDOException $e){
				echo  'Connection failed: ' . $e -> getMessage();
			}

		}

		function obtenerMarcas(){
			$st = $this->pdo -> prepare('SELECT * FROM marcas');

			$st->execute();

			$result = $st -> fetchAll(\PDO::FETCH_OBJ);

			return $result;
		}

		
	}