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
include '../Reserva/ReservaEvento.php';
include '../Conexion/Conexion.php';
include '../Conexion/Config.php';

$json = file_get_contents('php://input');

$objt = json_decode($json);


	echo \ReservaEvento\ReservaEvento::verReservaEvento($objt->usu,$objt->fecha1e, $objt->fecha2e);

}else{

		echo false;
}



 ?>