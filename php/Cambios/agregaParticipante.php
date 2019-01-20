<?php 



session_start();

include '../Consultas/tiempoSesion.php';

if($_SESSION['tipo']==1 || $_SESSION['tipo']==2) {

include '../Trait/Modificar.php';
include '../Persona/Persona.php';
include '../Persona/Alterar.php';
include '../Persona/Participante/Participante.php';
include '../Persona/Usuario/Usuario.php';
include '../Persona/Usuario/Gestor.php';
include '../Comercio/Comercio.php';
include '../Comercio/Evento.php';
include '../Conexion/Conexion.php';
include '../Conexion/Config.php';

$json = file_get_contents('php://input');

$objt = json_decode($json, true);


for($i=0; $i<count($objt['idparti']); $i++){

 Evento::agregaParticipante($objt['accion'], $objt['ideven'], $objt['idparti'][$i]['id']);
		}

	}
else{

	echo false;
}

 ?>