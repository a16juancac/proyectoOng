<?php 
include '../Trait/Modificar.php';
include '../Comercio/Producto.php';
include '../Conexion/Conexion.php';
include '../Conexion/Config.php';

$json = file_get_contents('php://input');

$objt = json_decode($json);


	echo Producto::verProductos($objt->usu, $objt->idti, $objt->idcate);


 ?>