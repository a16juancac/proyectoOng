<?php namespace Gestor;

class Gestor extends \Usuario implements \Alterar\Alterar, \JsonSerializable{

 	
	
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


//Con la id hacemos la consulta y generamos el objeto usuario Gestor
	function getGestor($id){

		$resultado = array();
		$gestor = array();

		$conecta = new \Conexion\Conexion(BDNOMBRE, HOST, USUARIO, CONTRA, CHARSET);
		$valor= array(":id"=>$id);
		$sql= 'SELECT * 
  									FROM usuario
  									WHERE 
  									ON usuario.id = :id';

  		
  		$resultado = $conecta->consultaPreparada($sql, $valor);

  		$gestor= Gestor::generaObjGestor($resultado);


  		$conecta->cerrarConexion();
  		
  		return $gestor;

		}

		
//Con una consulta sql generamos los objetos usuario Gestor
	private function generaObjGestor($consulta){

	$gestor = array();
		for($i=0; $i<count($consulta); $i++){
				//Creamos el objeto producto
				$gestor[$i]=new \Gestor\Gestor( $consulta[$i]['id'],
										$consulta[$i]['nombre'],
										$consulta[$i]['apellido1'],
										$consulta[$i]['apellido2'],
										$consulta[$i]['NIF'],
										$consulta[$i]['email'],
										$consulta[$i]['telefono'],
										$consulta[$i]['direccion'],
										$consulta[$i]['localidado'],
										$consulta[$i]['password'],
										parent::getTipoUsuario($consulta[$i]['tipo']),
										$consulta[$i]['fecha_sesion']
											);
		}

	return $gestor;
	}


	
	//Hacemos una consulta y retornamos los datos de los productos

	function verPanelProductos (){
		$producto = new Producto ($id, $nombrep, $descripcionp, $stockp, $preciop, $fcaducidadp, $tiendap);
		$resultado1 = array();
		$resultado2 = array();
		$conecta = new \Conexion\Conexion(BDNOMBRE, HOST, USUARIO, CONTRA, CHARSET);
		$sql= 'SELECT 
									producto.nombre, 
									producto.descripcion, 
									producto.categoria, 
									producto_tienda.precio, 
									producto_tienda.stock, 
									producto_tienda.id_prod
  									FROM producto 
  									INNER JOIN producto_tienda
  									ON producto.id = producto_tienda.id_prod';

	}

	// funcion alta de productos y eventos
	
	function alta($objeto){

	
			$objeto->agregar($objeto);


	}

//Funcion de modificar productos y eventos
	function modificar($objeto){

			$objeto->modifica($objeto);


	}

//Funcion de baja de productos y eventos. Nota: no implementado por no poder dar de baja productos y eventos el usuario gestor

	function baja($id){

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