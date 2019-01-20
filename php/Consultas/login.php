<?php 
include '../Trait/Modificar.php';
include '../Persona/Alterar.php';
include '../Persona/Persona.php';
include '../Persona/Usuario/Usuario.php';
include '../Persona/Usuario/Administrador.php';
include '../Persona/Usuario/Gestor.php';
include '../Persona/Usuario/Registrado.php';
include '../Conexion/Conexion.php';
include '../Conexion/Config.php';
include 'tiempoSesion.php';


$json = file_get_contents('php://input');

$objt = json_decode($json);

$login = htmlentities(addslashes($objt->usu));
$password = htmlentities(addslashes($objt->pass));

$resultado = array();
$usuario = array();
	$resultado = Usuario::verificarUsuario($login);
				if(isset($resultado)){

					if(password_verify($password, $resultado[0]['password']))
					{ 

					session_start();

					$_SESSION["id"] = $resultado[0]['id'];
					$_SESSION["nombre"] = $resultado[0]['nombre'];
					$_SESSION["email"] = $resultado[0]['email'];
					$_SESSION["tipo"]= $resultado[0]['tipo'];
					$_SESSION["fecha_sesion"] = $resultado[0]['fecha_sesion'];


					if($resultado->tipo == '1'){


						$usuario = new \Administrador\Administrador($resultado[0]['id'],
													 $resultado[0]['nombre'],
													 $resultado[0]['apellido1'],
													 $resultado[0]['apellido2'],
													 $resultado[0]['NIF'],
													 $resultado[0]['email'],
													 $resultado[0]['telefono'],
													 $resultado[0]['direccion'],
													 $resultado[0]['localidad'],
													 $resultado[0]['provincia'],
													 'ok',
													 $resultado[0]['tipo'],
													 $resultado[0]['fecha_sesion']);

					}
					elseif($resultado->tipo == '2'){

						$usuario = new \Gestor\Gestor(		 $resultado[0]['id'],
													 $resultado[0]['nombre'],
													 $resultado[0]['apellido1'],
													 $resultado[0]['apellido2'],
													 $resultado[0]['NIF'],
													 $resultado[0]['email'],
													 $resultado[0]['telefono'],
													 $resultado[0]['direccion'],
													 $resultado[0]['localidad'],
													 $resultado[0]['provincia'],
													 'ok',
													 $resultado[0]['tipo'],
													 $resultado[0]['fecha_sesion']);


					}
					else{


						$usuario = new \Registrado\Registrado(	$resultado[0]['id'],
													$resultado[0]['nombre'],
													$resultado[0]['apellido1'],
													$resultado[0]['apellido2'],
													$resultado[0]['NIF'],
													$resultado[0]['email'],
													$resultado[0]['telefono'],
													$resultado[0]['direccion'],
													$resultado[0]['localidad'],
													$resultado[0]['provincia'],
													'ok',
													$resultado[0]['tipo'],
													$resultado[0]['fecha_sesion'],
													$resultado[0]['reservas']
												);
					}

					$usuario->actualizarFechaSesion($_SESSION["id"]);


				}

				 else{

						$usuario = false;
				 }

				}


				else{

					$usuario=false;
				}

			
		
			
			 echo json_encode($usuario);
			

 ?> 
