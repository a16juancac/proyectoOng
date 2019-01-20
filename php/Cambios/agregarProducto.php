<?php 

session_start();

include '../Consultas/tiempoSesion.php';

if($_SESSION['tipo']==1 || $_SESSION['tipo']==2) {


include '../Trait/Modificar.php';
include '../Persona/Alterar.php';
include '../Persona/Persona.php';
include '../Persona/Usuario/Usuario.php';
include '../Persona/Usuario/Gestor.php';
include '../Persona/Usuario/Administrador.php';
include '../Comercio/Producto.php';
include '../Conexion/Conexion.php';
include '../Conexion/Config.php';

$json = file_get_contents('php://input');

$objt = json_decode($json);


$fechaf = new DateTime($objt->fechafincampaniapro);
$fecha = $fechaf->format('Y-m-d');


	if($_SESSION['tipo']==2){

		\Gestor\Gestor::alta(new Producto(null, 
												$objt->nombrepro, 
												$objt->descripcionpro,
												$objt->imagenpro,
												$fecha,
												$objt->categoriapro,
												$objt->stockpro,
												$objt->preciopro,
												1,
												$objt->tiendapro,
												null));
	}else{

		\Administrador\Administrador::alta(new Producto(null, 
												$objt->nombrepro, 
												$objt->descripcionpro,
												$objt->imagenpro,
												$fecha,
												$objt->categoriapro,
												$objt->stockpro,
												$objt->preciopro,
												1,
												$objt->tiendapro, 
												null));
	}


	
		 
}else{


	return false;
}




 ?>  
