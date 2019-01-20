<?php namespace Registrado;


class Registrado extends \Usuario implements \JsonSerializable{

	private $reservas = array();

	function __construct($id, $nombre, $apellido1, $apellido2, $NIF, $email, $telefono, $direccion, $localidad, $provincia, $password, $tipo, $fecha_sesion, $reservas){

		parent:: __construct($id, $nombre, $apellido1, $apellido2, $NIF, $email, $telefono, $direccion, $localidad, $provincia, $password, $tipo, $fecha_sesion);
		$this->reservas = $reservas;
	}


	function jsonSerialize(){
	
		return array(
					"id" 					=> $this->id,
					"nombre" 				=> $this->nombre,
					"apellido1"				=> $this->apellido1,
					"apellido2" 			=> $this->apellido2,
					"NIF"					=> $this->NIF,
					"email" 				=> $this->email,
					"telefono" 				=> $this->telefono,
					"direccion" 			=> $this->direccion,
					"localidad" 			=> $this->localidad,
					"provincia"				=> $this->provincia,
					"password"				=> $this->password,
					"tipo"					=> $this->tipo,
					"fecha_sesion"			=> $this->fecha_sesion,
					"reservas"				=> $this->reservas
				);
	}


//Introduciendo el objeto usuario registrado e insertamos en la BD un usuario registrado
	function agregarUsuario($registrado){



		$resultado= array();
		$valor = array(	":id" 					=> $registrado->id,
						":nombre" 				=> $registrado->nombre,
						":apellido1"			=> $registrado->apellido1,
						":apellido2" 			=> $registrado->apellido2,
						":NIF"					=> $registrado->NIF,
						":email" 				=> $registrado->email,
						":telefono" 			=> $registrado->telefono,
						":direccion" 			=> $registrado->direccion,
						":localidad" 			=> $registrado->localidad,
						":provincia"			=> $registrado->provincia,
						":password"				=> $registrado->password,
						":tipo"					=> $registrado->tipo,
					
					);
		


		$sql = 'INSERT INTO usuario (id, nombre, apellido1, apellido2, NIF, email, telefono, direccion, localidad, provincia, password, tipo, fecha_sesion) VALUES (:id, :nombre, :apellido1, :apellido2, :NIF, :email, :telefono, :direccion, :localidad, :provincia, :password, :tipo, CURRENT_TIMESTAMP)';

		
	

		$conecta = new \Conexion\Conexion(BDNOMBRE, HOST, USUARIO, CONTRA, CHARSET);

		$conecta->abrirConexion();


		$resultado = $conecta->anadirDato($sql, $valor);

		$conecta->cerrarConexion();	

		return 'ok';


	}
	
//Con la id hacemos la consulta y generamos el objeto usuario Registrado, sin la id se devuelven todos los usuarios registrados
	function getUsuario($id=''){


		$resultado= array();
		$valor = array(':id' => $id);
		$usuario = array();
		$sql = 'SELECT * from usuario';
		$sql1 = ' WHERE usuario.id=:id';
		$conecta = new \Conexion\Conexion(BDNOMBRE, HOST, USUARIO, CONTRA, CHARSET);

		$conecta->abrirConexion();

		if(!empty($id)){

		$resultado = $conecta->consultaPreparada($sql.$sql1, $valor);

		$usuario = \Registrado\Registrado::generaObjRegistrado($resultado);

		}

		else{

			$resultado = $conecta->consultaPreparada($sql);
			$usuario = json_encode(\Registrado\Registrado::generaObjRegistrado($resultado));
		}

		$conecta->cerrarConexion();	

		return $usuario;
		

	}

//Con una consulta sql generamos los objetos usuario Registrado
	 private function generaObjRegistrado($consulta){

			$usuario = array();
				for($i=0; $i<count($consulta); $i++){
				//Creamos el objeto producto
				$usuario[$i]=new \Registrado\Registrado( $consulta[$i]['id'],
											 $consulta[$i]['nombre'],
											 $consulta[$i]['apellido1'],
											 $consulta[$i]['apellido2'],
											 $consulta[$i]['NIF'],
											 $consulta[$i]['email'],
											 $consulta[$i]['telefono'],
											 $consulta[$i]['direccion'],
											 $consulta[$i]['localidad'],
											 $consulta[$i]['provincia'],
											 $consulta[$i]['password'],
											 $consulta[$i]['tipo'],
											 $consulta[$i]['fecha_sesion'],
											 $consulta[$i]['reservas']
				
									
													);
				}

			return $usuario;

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

}



 ?>