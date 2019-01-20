<?php 

session_start();

include '../Consultas/tiempoSesion.php';

if($_SESSION['tipo']==1 || $_SESSION['tipo']==2 || $_SESSION['tipo']==3){


include '../Trait/Modificar.php';
include '../Persona/Alterar.php';
include '../Persona/Persona.php';
include '../Persona/Usuario/Usuario.php';
include '../Persona/Usuario/Administrador.php';
include '../Persona/Usuario/Gestor.php';
include '../Persona/Usuario/Registrado.php';
include '../Conexion/Conexion.php';
include '../Conexion/Config.php';


$json = file_get_contents('php://input');

$objt = json_decode($json);


echo json_encode(Usuario::actualizarDato($objt->idper)) ;

				
			
	
}






 ?> 
