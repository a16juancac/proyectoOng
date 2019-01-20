<?php 

session_start();

include '../Consultas/tiempoSesion.php';

if($_SESSION['tipo']==1 || $_SESSION['tipo']==2 || $_SESSION['tipo']==3) {



include '../Trait/Modificar.php';
include '../Comercio/Comercio.php';
include '../Comercio/Evento.php';
include '../Persona/Persona.php';
include '../Persona/Usuario/Usuario.php';
include '../Reserva/Reserva.php';
include '../Reserva/ReservaProducto.php';
include '../Conexion/Conexion.php';
include '../Conexion/Config.php';

$json = file_get_contents('php://input');

$objt = json_decode($json);


	echo \ReservaProducto\ReservaProducto::verReservaProducto($objt->usu, $objt->fecha1, $objt->fecha2);


}else{

		echo false;
}




 ?> 
