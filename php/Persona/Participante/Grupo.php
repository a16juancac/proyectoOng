<?php namespace Grupo;

class Grupo implements \JsonSerializable{
	
	private $id;
	private $nombre;
	private $CIF;
	private $domicilio;
	private $web;

		function __construct($id, $nombre, $CIF, $domicilio, $web){
			$this->id = $id;
			$this->nombre = $nombre;
			$this->cif = $cif;
			$this->domicilio = $domicilio;
			$this->web = $web;
		}


		function jsonSerialize(){
			return array("id" 			=> $this->id,
						 "nombre" 		=> $this->nombre,
						 "CIF" 			=> $this->CIF,
						 "domicilio" 	=> $this->domicilio,
						 "web" 			=> $this->web
		);

		}


		//Se busca un grupo por la id y se retorna el objeto Grupo
		function getGrupo($id){


		$resultado = array();
		$grupo = array();
		$conecta = new \Conexion\Conexion(BDNOMBRE, HOST, USUARIO, CONTRA, CHARSET);
		$sql = 'SELECT 	grupo.id, 
						grupo.nombre, 
						grupo.CIF,
						grupo.domicilio_fiscal as domicilio,
						grupo.web

						 from grupo where id=:id';
		$conecta->abrirConexion();
		$valor= array(":id"=>$id);
		$resultado = $conecta->consultaPreparada($sql, $valor);
		$grupo = \Grupo\Grupo::generaObjGrupo($resultado);
		$conecta->cerrarConexion();
		return $grupo;
		}


		//Con la consulta introducida retornamos el objeto Grupo
		private function generaObjGrupo($consulta){

			$grupo = array();

			for($i=0; $i<count($consulta); $i++){

				//Creamos el objeto tienda
				$grupo[$i]=new \Grupo\Grupo($consulta[$i]['id'],
									 $consulta[$i]['nombre'],  
									 $consulta[$i]['CIF'],
									 $consulta[$i]['domicilio'],
									 $consulta[$i]['web']
				
				);
			}
			return $grupo;
		}


}



 ?>