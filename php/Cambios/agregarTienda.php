<?php 
session_start();

include '../Consultas/tiempoSesion.php';

if($_SESSION['tipo']==1){
include '../Trait/Modificar.php';
include '../Tienda/Tienda.php';
include '../Conexion/Conexion.php';
include '../Conexion/Config.php';


$json = file_get_contents('php://input');

$objt = json_decode($json);

\Tienda\Tienda::agregarTienda(new \Tienda\Tienda(null, 
												$objt->nombreti, 
												$objt->direccionti,
												$objt->ciudadti,
												$objt->cpti,
												$objt->telefonoti,
												$objt->emailti,
												$objt->faxti,
												$objt->latitudti,
												$objt->longitudti
												));
}
else{

	echo false;
}


		 


 ?>  
 
