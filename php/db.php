<?php
	//el prepare genera un statement, cuando se ejecuta cambia su estado
	include('config.php');
	header('Access-Control-Allow-Origin: *');
	$dsn = 'mysql:dbname=' . DB_NAME . ';host='.DB_HOST;

	try{
		$pdo = new PDO($dsn,DB_USER,DB_PASS);
	}catch(PDOException $e){
		echo  'Connection failed: ' . $e -> getMessage();
	}

	/*var_dump($pdo);
	echo '<br/>';
	$st = $pdo -> prepare('SELECT * FROM user');

	$st->execute();

	var_dump($st);
	echo '<br/>';
	$result = $st -> fetchAll(PDO::FETCH_OBJ);

	var_dump($result);

	$st = $pdo->prepare('INSERT INTO user(nombre,apellidos,telefono,email,password) VALUES(?,?,?,?,?)');

	$st->execute(array('jose','gac','323232','w@j.com','2323'));*/

