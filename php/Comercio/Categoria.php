<?php namespace Categoria;


class Categoria implements \JsonSerializable{

	private $ip;
	private $nombre;

	function __construct($id, $nombre){
		$this->id=$id;
		$this->nombre=$nombre;
	}

	function jsonSerialize(){
	return array(
					"id" => $this->id,
					"descripcion"=> $this->nombre
				);
	}


//Con la id hacemos la consulta y retornamos la categoria
	function getCategoria($id){

		$resultado = array();
		$conecta = new \Conexion\Conexion(BDNOMBRE, HOST, USUARIO, CONTRA, CHARSET);
		$sql= 'SELECT * from categoria WHERE id=:id ORDER BY id';
		$conecta->abrirConexion();
		$valor= array(":id"=>$id);
		$resultado = $conecta->consultaPreparada($sql, $valor);
		
		$conecta->cerrarConexion();
		
		return $resultado;

	}


//Consultamos las categorias existentes en la BD
	function verCategorias(){

	$conecta = new \Conexion\Conexion(BDNOMBRE, HOST, USUARIO, CONTRA, CHARSET);

	$conecta->abrirConexion();
	
	return json_encode($conecta->consultaPreparada('SELECT 
									*
									
  							FROM categoria'));

	$conecta->cerrarConexion();


	}

}

 ?>