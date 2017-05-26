<?php

	include('Controllers/UserCtrl.php');
	include('Controllers/MarcaCtrl.php');
	include('Controllers/ProductoCtrl.php');
	include('Controllers/CarritoCtrl.php');
	
	
	USE Controllers\UsersCtrl as Usuarios;
	USE Controllers\MarcaCtrl as Marcas;
	USE Controllers\ProductoCtrl as Productos;
	USE Controllers\CarritoCtrl as Carrito;
	//ctrl = controlador, act = accion, ? apartir de ahi es un querystring y todo se envia como cadena 
	//pagina/index.php?ctrl=usuarios&act=agregar
	//var_dump($_GET);
	
	//si no mandas que quieres pones la fecha y el nombre de la api

	//validar en en get ctrl

	//include y require es lo mismo, si require no lo encuentra manda error fatal e include warning
	//require cada vez que se ejecuta se vuelve a declarar clases y se setean otra vez variables
	//require_once si ya se cargo en el tiempo de ejecucion solo se cargar una vez si se pone

	//el modelo es el que se encarga de hacer acciones con las bases de datos
	//el como quieres que se vea es la vista

	
	
	if (isset($_GET['ctrl'])) {
		switch ($_GET['ctrl']) {
			case 'usuarios':
				$ctrl = new Usuarios\UserCtrl();
				echo $ctrl -> ejecutar();
				break;
			case 'marcas':
				$ctrlM = new Marcas\MarcaCtrl();
				echo $ctrlM -> ejecutar();
				break;
			case 'productos':
				$ctrlP = new Productos\ProductoCtrl();
				echo $ctrlP -> ejecutar();
				break;
			case 'carrito':
				$ctrlC = new Carrito\CarritoCtrl();
				echo $ctrlC -> ejecutar();
				break;
			default:
				return "No se que quiere";
				break;
		}
	}
