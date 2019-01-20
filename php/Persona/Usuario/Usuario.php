<?php


class Usuario extends \Persona\Persona implements \JsonSerializable{
//LLamamos al trait
use \Modificar\Modificar;

	protected $password;
	protected $tipo;
 	protected $fecha_sesion;


	function __construct($id, $nombre, $apellido1, $apellido2, $NIF, $email, $telefono, $direccion, $localidad, $provincia, $password, $tipo, $fecha_sesion){

		parent:: __construct($id, $nombre, $apellido1, $apellido2, $NIF, $email, $telefono, $direccion, $localidad, $provincia);
		$this->password = $password;
		$this->tipo = $tipo;
		$this->fecha_sesion = $fecha_sesion;
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
					"fecha_sesion"			=> $this->fecha_sesion
				);
	}


//Con la id hacemos la consulta y retornamos los datos de la tabla tipo_usuario

	function getTipoUsuario($id){

		$resultado = array();

		$conecta = new \Conexion\Conexion(BDNOMBRE, HOST, USUARIO, CONTRA, CHARSET);
		$valor= array(":id"=>$id);
		$sql= 'SELECT 
									*
  									FROM tipo_usuario
  									WHERE 
  									ON tipo_usuario.id = :id';

  		$resultado = $conecta->consultaPreparada($sql, $valor);

  		$conecta->cerrarConexion();
  		
  		return $resultado;

	}

//Funcion para verificar que si el usuario existe en la BD
	function verificarUsuario($email){

			$resultado = array();
			$resultado1 = array();
			$conecta = new \Conexion\Conexion(BDNOMBRE, HOST, USUARIO, CONTRA, CHARSET);
			$sql= 'SELECT * from usuario WHERE email=:email';
			$valor= array(":email"=>$email);

			$conecta->abrirConexion();
			
			$resultado = $conecta->consultaPreparada($sql, $valor);
			

			if(isset($resultado)){

					return $resultado;

					}
					else{

						return null;
					}

			$conecta->cerrarConexion();

					}


		
//Funcion para actualizar la fecha de sesion del usuario
	function actualizarFechaSesion($id){

		$resultado = array();
		$conecta = new \Conexion\Conexion(BDNOMBRE, HOST, USUARIO, CONTRA, CHARSET);
		$sql= 'UPDATE usuario SET fecha_sesion = CURRENT_TIMESTAMP WHERE id=:id';
		$valor= array(":id"=>$id);

			$conecta->abrirConexion();
			
			$resultado = $conecta->anadirDato($sql, $valor);
			
			$conecta->cerrarConexion();
		}


//Con una consulta sql generamos los objetos Usuario
	 private function generaObjUsuario($consulta){

			$usuario = array();
				for($i=0; $i<count($consulta); $i++){
				//Creamos el objeto producto
				$usuario[$i]=new Registrado( $consulta[$i]['id'],
											 $consulta[$i]['nombre'],
											 $consulta[$i]['apellido1'],
											 $consulta[$i]['apellido2'],
											 $consulta[$i]['NIF'],
											 $consulta[$i]['email'],
											 $consulta[$i]['telefono'],
											 $consulta[$i]['direccion'],
											 $consulta[$i]['localidad'],
											 $consulta[$i]['provincia'],
											 'ok',
											 $consulta[$i]['tipo'],
											 $consulta[$i]['fecha_sesion']
				
									
													);
				}

			return $usuario;

		}






	public function actualizarDato($id){

		$resultado = array();
		$conecta = new \Conexion\Conexion(BDNOMBRE, HOST, USUARIO, CONTRA, CHARSET);
		$sql= 'SELECT * FROM usuario WHERE id=:id';
		$valor= array(":id"=>$id);

			$conecta->abrirConexion();
			
			$resultado = $conecta->consultaPreparada($sql, $valor);
			
			
			$conecta->cerrarConexion();

			return $resultado[0];

			
		}



	}




 ?>