<?php namespace Administrador;

class Administrador extends \Usuario implements \Alterar\Alterar, \JsonSerializable{


	function __construct($id, $nombre, $apellido1, $apellido2, $NIF, $email, $telefono, $direccion, $localidad, $provincia, $password, $tipo, $fecha_sesion){

		parent:: __construct($id, $nombre, $apellido1, $apellido2, $NIF, $email, $telefono, $direccion, $localidad, $provincia, $password, $tipo, $fecha_sesion);

	}


	function jsonSerialize(){
	return array(
					"id" 			=> $this->id,
					"nombre" 		=> $this->nombre,
					"apellido1" 	=> $this->apellido1,
					"apellido2"		=> $this->apellido2,
					"NIF"			=> $this->NIF,
					"email" 		=> $this->email,
					"telefono" 		=> $this->telefono,
					"direccion" 	=> $this->direccion,
					"localidad" 	=> $this->localidad,
					"provincia" 	=> $this->provincia,
					"password" 		=> $this->password,
					"tipo" 			=> $this->tipo,
					"fecha_sesion"	=> $this->fecha_sesion

				);
	}

	function __get($atributo) {
	if (property_exists(__CLASS__, $atributo)) {
	return $this->$atributo;
	}
	return null;
	}


	function __set($atributo, $valor) {
	if (property_exists(__CLASS__, $atributo)) {
		$this->$atributo = $valor;
		} else { echo "No existe el atributo $atributo."; }
	}

	// Funcion alta de productos y eventos
	function alta($objeto){

		
			$objeto->agregar($objeto);
	
		}

    //Funcion de modificar productos y eventos
	
	function modificar($objeto){

			$objeto->modifica($objeto);
		

	}

	//Funcion de baja de productos y eventos

	function baja($id){


		Producto::baja($id);

	}
}

 ?>