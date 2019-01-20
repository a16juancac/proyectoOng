<?php 
include '../Trait/Modificar.php';
include '../Tienda/Tienda.php';
include '../Conexion/Conexion.php';
include '../Conexion/Config.php';


$json = file_get_contents('php://input');

$objt = json_decode($json);




	echo \Tienda\Tienda::verTiendas($objt->tie, $objt->idti);


?>
