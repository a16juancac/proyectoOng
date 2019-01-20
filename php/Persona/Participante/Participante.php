<?php namespace Participante;


include 'Grupo.php';


class Participante extends \Persona\Persona implements \JsonSerializable{

	private $grupo;

		function __construct($id, $nombre, $apellido1, $apellido2, $NIF, $email, $telefono, $direccion, $localidad, $provincia, $grupo=''){
			parent:: __construct($id, $nombre, $apellido1, $apellido2, $NIF, $email, $telefono, $direccion, $localidad, $provincia);
			
			$this->grupo =$grupo;
		}
	

		function jsonSerialize(){
			return array("id" 			=> $this->id,
						 "nombre" 		=> $this->nombre,
						 "apellido1" 	=> $this->apellido1,
						 "apellido2" 	=> $this->apellido2,
						 "NIF"			=> $this->NIF,
						 "email" 		=> $this->email,
						 "telefono" 	=> $this->telefono,
						 "direccion" 	=> $this->direccion,
						 "localidad" 	=> $this->localidad,
						 "provincia" 	=> $this->provincia,
						 "grupo" 		=> $this->grupo
						);
		}

		//Generamos los datos de Participante conla Id y retornamos el objeto Participante

		function getParticipante($id=''){


		$resultado= array();
		$valor = array(':id' => $id);
		$participante = array();
		$sql = 'SELECT * from participante';
		$sql1 = ' WHERE participante.id=:id';
		$conecta = new \Conexion\Conexion(BDNOMBRE, HOST, USUARIO, CONTRA, CHARSET);

		$conecta->abrirConexion();

		if(!empty($id)){

		$resultado = $conecta->consultaPreparada($sql.$sql1, $valor);

		$participante = \Participante\Participante::generaObjParticipante($resultado);

		}

		else{

			$resultado = $conecta->consultaPreparada($sql);
			$participante = json_encode(\Participante\Participante::generaObjParticipante($resultado));
		}

		$conecta->cerrarConexion();	

		return $participante;
		}


		

		  private function generaObjParticipante($consulta){

			$participante = array();
				for($i=0; $i<count($consulta); $i++){
				//Creamos el objeto producto
				$participante[$i]=new \Participante\Participante( $consulta[$i]['id'],
													$consulta[$i]['nombre'],
													$consulta[$i]['apellido1'],
													$consulta[$i]['apellido2'],
													$consulta[$i]['NIF'],
													$consulta[$i]['email'],
													$consulta[$i]['telefono'],
													$consulta[$i]['direccion'],
													$consulta[$i]['localidad'],
													$consulta[$i]['provincia'],
													\Grupo\Grupo::getGrupo($consulta[$i]['grupo'])
									
													);
				}

			return $participante;

		}



}




?>