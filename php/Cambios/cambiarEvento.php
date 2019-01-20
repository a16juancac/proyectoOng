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

$objt = json_decode($json);


if(!empty($objt->fechaeve)){

$fechaf = new DateTime($objt->fechaeve);
$fecha = $fechaf->format('Y-m-d');

}
else{

	$fecha='';
}

if(!empty($objt->fechasposibleseve)){

	$fechap = new DateTime($objt->fechasposibleseve);
$fechaposi = $fechap->format('Y-m-d');
}else{

	$fechaposi='';
}




\Gestor\Gestor::modificar(new Evento(	$objt->ideve, 
							 	$objt->nombreeve, 
								$objt->descripcioneve,
								$objt->imageneve,
								$objt->lugareve,
								$objt->aforoeve,
								$fecha,
								$fechaposi,
								$objt->precioeve,
								$objt->entradaseve,
								$objt->idevelug,
								null));
}
else{

	return false;
}


 ?> 
