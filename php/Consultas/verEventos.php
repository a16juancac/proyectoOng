<?php 
include '../Trait/Modificar.php';
include '../Comercio/Comercio.php';
include '../Comercio/Evento.php';
include '../Persona/Persona.php';
include '../Persona/Usuario/Usuario.php';
include '../Persona/Participante/Participante.php';
include '../Conexion/Conexion.php';
include '../Conexion/Config.php';

$json = file_get_contents('php://input');

$objt = json_decode($json);

	echo Evento::verEventos($objt->all,$objt->fecha1, $objt->fecha2);


 ?>