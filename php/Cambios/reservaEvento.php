<?php 

session_start();

include '../Consultas/tiempoSesion.php';



if($_SESSION['tipo']==3){
include '../Trait/Modificar.php';
include '../Persona/Alterar.php';
include '../Persona/Persona.php';
include '../Reserva/Reserva.php';
include '../Reserva/ReservaEvento.php';
include '../Persona/Usuario/Usuario.php';
include '../Persona/Usuario/Registrado.php';
include '../Comercio/Producto.php';
include '../Conexion/Conexion.php';
include '../Conexion/Config.php';

$json = file_get_contents('php://input');

$objt = json_decode($json);


$fechaf = new DateTime('now');
$fecha = $fechaf->format('Y-m-d');


 \ReservaEvento\ReservaEvento::hacerReserva(new \ReservaEvento\ReservaEvento(null, $objt->idusu, $objt->ideve, $objt->cant, $objt->preci, $fecha));
	
	}else{


	return false;
}



 ?> 
