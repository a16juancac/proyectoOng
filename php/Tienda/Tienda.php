<?php namespace Tienda;


class Tienda implements \JsonSerializable{
	private $id;
	private $nombre;
	private $direccion;
	private $ciudad;
	private $codigo_postal;
	private $telefono;
	private $email;
	private $fax;
	private $latitud;
	private $longitud;

	function __construct($id, $nombre, $direccion, $ciudad, $codigo_postal, $telefono, $email, $fax, $latitud, $longitud){
		$this->id = $id;
		$this->nombre = $nombre;
		$this->direccion = $direccion;
		$this->ciudad = $ciudad;
		$this->codigo_postal = $codigo_postal;
		$this->telefono = $telefono;
		$this->email = $email;
		$this->fax = $fax;
		$this->latitud = $latitud;
		$this->longitud = $longitud;
	}

	
	function jsonSerialize(){
		
		return array(

		'id'			=> $this->id,
		'nombre'		=> $this->nombre,
		'direccion' 	=> $this->direccion,
		'ciudad'		=> $this->ciudad,
		'codigo_postal'	=> $this->codigo_postal,
		'telefono'		=> $this->telefono,
		'email'			=> $this->email,
		'fax'			=> $this->fax,
		'latitud'		=> $this->latitud,
		'longitud'		=> $this->longitud
		);

	}

//Con la id hacemos la consulta y generamos el objeto Tienda
	function getTienda($id){
		$resultado = array();
		$tienda = array();
		$conecta = new \Conexion\Conexion(BDNOMBRE, HOST, USUARIO, CONTRA, CHARSET);
		$sql = 'SELECT * from tienda where id=:id';
		$conecta->abrirConexion();
		$valor= array(":id"=>$id);
		$resultado = $conecta->consultaPreparada($sql, $valor);
		$tienda = \Tienda\Tienda::generaObjTienda($resultado);
		$conecta->cerrarConexion();
		return $tienda;
	}

//Con una consulta sql generamos los objetos Tienda
	function generaObjTienda($consulta){

		$tienda = array();

		for($i=0; $i<count($consulta); $i++){

			//Creamos el objeto tienda
			$tienda[$i]=new \Tienda\Tienda($consulta[$i]['id'],
								   $consulta[$i]['nombre'],  
								   $consulta[$i]['direccion'],
								   $consulta[$i]['ciudad'],
								   $consulta[$i]['codigo_postal'],
								   $consulta[$i]['telefono'],
								   $consulta[$i]['email'],
								   $consulta[$i]['fax'],
								   $consulta[$i]['latitud'],
								   $consulta[$i]['longitud']
			);
		}
		return $tienda;
	}


//Consultamos las tienda existentes en la BD y el retorno varia segun los parametros introducidos en la función
	 function verTiendas($tipo='', $id=''){

		$conecta = new \Conexion\Conexion(BDNOMBRE, HOST, USUARIO, CONTRA, CHARSET);

		$resultado = array();
		$tienda=array();
		$sql = 'SELECT * FROM tienda';
		$sql1 = ' WHERE id = :id';
		$sql2 = ' WHERE id != :id';
		$conecta->abrirConexion();
		
		if(empty($tipo) && empty($id)){

			$resultado = $conecta->consultaPreparada($sql);
		}

		elseif($tipo==true && !empty($id)){

		$valor= array(":id"=>$id);

		$resultado = $conecta->consultaPreparada($sql . $sql1, $valor);

		}

		else{

			$valor= array(":id"=>$id);

			$resultado = $conecta->consultaPreparada($sql . $sql2, $valor);
		}
		
		
	
		$tienda = \Tienda\Tienda::generaObjTienda($resultado);


		return json_encode($tienda);
		
		$conecta->cerrarConexion();
	
		}

		//Introduciendo el objeto Tienda e insertamos en la BD una Tienda

		function agregarTienda(Tienda $tienda){

			$sql = array();
			$valor = array();

			$conecta = new \Conexion\Conexion(BDNOMBRE, HOST, USUARIO, CONTRA, CHARSET);

			$sql = 'INSERT INTO tienda (id, nombre, direccion, ciudad, codigo_postal, telefono, email, fax, latitud, longitud)
						VALUES (:id, :nombre, :direccion, :ciudad, :codigo_postal, :telefono, :email, :fax, :latitud, :longitud)';

			$valor = array(		":id" 					=> $tienda->id,
								":nombre"				=> $tienda->nombre,
								":direccion" 			=> $tienda->direccion,
								":ciudad" 				=> $tienda->ciudad,
								":codigo_postal" 		=> $tienda->codigo_postal,
								":telefono" 			=> $tienda->telefono,
								":email" 				=> $tienda->email,
								":fax" 					=> $tienda->fax,
								":latitud" 				=> $tienda->latitud,
								":longitud" 			=> $tienda->longitud,

							);

			

			$conecta->abrirConexion();
			$conecta->anadirDato($sql, $valor);
			$conecta->cerrarConexion();

			return 'OK';


		}

		//Introduciendo el objeto Tienda y modificamos en la BD los datos de la tienda

		function cambiarTienda($tienda){

			$sql = array();
			$valor = array();

			$conecta = new \Conexion\Conexion(BDNOMBRE, HOST, USUARIO, CONTRA, CHARSET);

			$sql ='UPDATE tienda SET nombre =:nombre, 
										 direccion =:direccion, 
										 ciudad =:ciudad, 
										 codigo_postal= :codigo_postal, 
										 telefono =:telefono, 
										 email= :email, fax =:fax, 
										 latitud =:latitud, 
										 longitud =:longitud
										 WHERE id =:id';

			$valor = array(		":id" 					=> $tienda->id,
								":nombre"				=> $tienda->nombre,
								":direccion" 			=> $tienda->direccion,
								":ciudad" 				=> $tienda->ciudad,
								":codigo_postal" 		=> $tienda->codigo_postal,
								":telefono" 			=> $tienda->telefono,
								":email" 				=> $tienda->email,
								":fax" 					=> $tienda->fax,
								":latitud" 				=> $tienda->latitud,
								":longitud" 			=> $tienda->longitud

							);


			$conecta->abrirConexion();
			$conecta->anadirDato($sql, $valor);
			$conecta->cerrarConexion();

			return 'OK';
		}

}



 ?>