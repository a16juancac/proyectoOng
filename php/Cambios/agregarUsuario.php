<?php 
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

$passwordcif = password_hash($objt->passw, PASSWORD_DEFAULT);



 echo \Registrado\Registrado::agregarUsuario(new \Registrado\Registrado(null, $objt->nombr, $objt->ape1, $objt->ape2, $objt->ni, $objt->emai, $objt->telef, $objt->direc, $objt->loca, $objt->provi, $passwordcif, 3, null, $objt->reserv));


 ?> 
