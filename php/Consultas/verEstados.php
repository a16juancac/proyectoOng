<?php 

session_start();
include '../Trait/Modificar.php';
include '../Consultas/tiempoSesion.php';

if($_SESSION['tipo']==1) {




include '../Comercio/Producto.php';
include '../Conexion/Conexion.php';
include '../Conexion/Config.php';



echo Producto::verEstados();
}
else
{
	echo false;
}



 ?> 
