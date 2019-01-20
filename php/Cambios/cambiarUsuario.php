<?php 

session_start();

include '../Consultas/tiempoSesion.php';

if($_SESSION['tipo']==1 || $_SESSION['tipo']==2 || $_SESSION['tipo']==3){




include '../Trait/Modificar.php';
include '../Persona/Persona.php';
include '../Persona/Alterar.php';
include '../Persona/Usuario/Usuario.php';
include '../Persona/Usuario/Registrado.php';
include '../Comercio/Comercio.php';
include '../Comercio/Evento.php';
include '../Conexion/Conexion.php';
include '../Conexion/Config.php';

$json = file_get_contents('php://input');

$objt = json_decode($json);

if(!empty($objt->passw)){

$passwordcif = password_hash($objt->passw, PASSWORD_DEFAULT);

}

 Usuario::modifica(new Usuario($objt->idper, $objt->nombr, $objt->ape1, $objt->ape2, $objt->ni, $objt->emai, $objt->telef, $objt->direc, $objt->loca, $objt->provi, $passwordcif, $objt->tip, null));
}


 ?> 
