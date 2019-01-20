<?php 

include 'Comercio.php';
include '../Tienda/Tienda.php';
include 'Categoria.php';

class Producto extends \Comercio\Comercio implements JsonSerializable{
//Llamamos al trait
use \Modificar\Modificar;

	private $fecha_fin_campania;
	private $categoria;
	private $stock;
	private $precio;
	private $estado;
	private $tienda;
	private $id_producto_tienda;

	function __construct($id, $nombre, $descripcion, $imagen, $fecha_fin_campania, 
						 $categoria, $stock, $precio, $estado, $tienda, $id_producto_tienda){
			parent:: __construct($id, $nombre, $descripcion, $imagen);
			$this->fecha_fin_campania = $fecha_fin_campania;
			$this->categoria = $categoria;
			$this->stock = $stock;
			$this->precio = $precio;
			$this->estado = $estado;
			$this->tienda = $tienda;
			$this->id_producto_tienda = $id_producto_tienda;

	}


	function jsonSerialize(){
	
	return array(
					"id" 					=> $this->id,
					"nombre" 				=> $this->nombre,
					"descripcion"			=> $this->descripcion,
					"imagen" 				=> $this->imagen,
					"fecha_fin_campania" 	=> $this->fecha_fin_campania,
					"categoria" 			=> $this->categoria,
					"stock" 				=> $this->stock,
					"precio" 				=> $this->precio,
					"estado"				=> $this->estado,
					"tienda"				=> $this->tienda,
					"id_producto_tienda"	=> $this->id_producto_tienda
				);
	}


//Con la id hacemos la consulta y generamos el objeto Producto
public function getProducto($id){

	$resultado = array();
	$conecta = new \Conexion\Conexion(BDNOMBRE, HOST, USUARIO, CONTRA, CHARSET);
	$sql= 'SELECT 	producto.id,
					producto.nombre, 
					producto.descripcion, 
					producto.categoria, 
					producto.fecha_fin_campania,
					producto_tienda.id_producto_tienda,
					producto_tienda.precio, 
					producto_tienda.stock, 
					producto_tienda.id_prod,
					producto_tienda.id_tienda as tienda,
					producto_tienda.estado
	  				FROM producto 
	  				INNER JOIN producto_tienda
	  				ON producto.id = producto_tienda.id_prod';


	$conecta->abrirConexion();
	$resultado = $conecta->consultaPreparada($sql);
	$producto = Producto::generaObjProducto($resultado);
	$conecta->cerrarConexion();

	return $producto;

}

//Con una consulta sql generamos los objetos Producto

	private function generaObjProducto($consulta){

	$producto = array();
		for($i=0; $i<count($consulta); $i++){
				//Creamos el objeto producto
				$producto[$i]=new Producto( $consulta[$i]['id'],
											$consulta[$i]['nombre'],
											$consulta[$i]['descripcion'],
											Producto::getImagenesProductos($consulta[$i]['id']),
											$consulta[$i]['fecha_fin_campania'],
											\Categoria\Categoria::getCategoria($consulta[$i]['categoria']),
											$consulta[$i]['stock'],
											$consulta[$i]['precio'],
											Producto::getEstado($consulta[$i]['estado']),
											\Tienda\Tienda::getTienda($consulta[$i]['tienda']),
											$consulta[$i]['id_producto_tienda']

											);
		}

	return $producto;
	}

//Con la id hacemos la consulta y retornamos las imagenes de un producto

	private function getImagenesProductos($id){

		$resultado = array();
		$conecta = new \Conexion\Conexion(BDNOMBRE, HOST, USUARIO, CONTRA, CHARSET);
		$sql= 'SELECT * from imagenes_prod WHERE id_prod=:id ORDER BY id_prod';
		$conecta->abrirConexion();
		$valor= array(":id"=>$id);
		$resultado = $conecta->consultaPreparada($sql, $valor);
		
		$conecta->cerrarConexion();
		
		return $resultado;
	}



//Consultamos los productos existentes en la BD y el retorno varia segun los parametros introducidos en la función
	public function verProductos($usuario, $idTienda='', $idCategoria=''){

	
			$resultado1 = array();
			$conecta = new \Conexion\Conexion(BDNOMBRE, HOST, USUARIO, CONTRA, CHARSET);


		  	$sql1= 'SELECT 	producto.id,
							producto.nombre, 
							producto.descripcion, 
							producto.categoria, 
							producto.fecha_fin_campania,
							producto_tienda.id_producto_tienda,
							producto_tienda.precio, 
							producto_tienda.stock, 
							producto_tienda.id_prod,
							producto_tienda.id_tienda as tienda,
							producto_tienda.estado
			  				FROM producto 
			  				INNER JOIN producto_tienda
			  				ON producto.id = producto_tienda.id_prod';

			
			$conecta->abrirConexion();
			$producto=array();
			$sql2;

			
			if($usuario==false){
			   $sql2=' ';

			}
			else{

				if(empty($idTienda) && empty($idCategoria)) {

				$sql2 = ' WHERE producto_tienda.estado = 2 ';
				}
				else{

				$sql2 =' AND producto_tienda.estado = 2 ';
				}
			}

			//Si envia todo los productos
			if(empty($idTienda) && empty($idCategoria)){
				$resultado1 = $conecta->consultaPreparada($sql1 . $sql2 . 'ORDER BY tienda');

				 $producto=Producto::generaObjProducto($resultado1);

				}

			elseif(empty($idCategoria) && !empty($idTienda)){
				
				$valor1= array(":idTienda"=>$idTienda);
				$resultado1 = $conecta->consultaPreparada($sql1 .
		  									' WHERE producto_tienda.id_tienda = :idTienda' . $sql2 . 'ORDER BY id_prod', $valor1);

				$producto=Producto::generaObjProducto($resultado1);
				}
			elseif(empty($idTienda) && !empty($idCategoria)){

				$valor1= array(":idCategoria"=>$idCategoria);
				$resultado1 = $conecta->consultaPreparada($sql1 .
		  									' WHERE producto.categoria = :idCategoria' . $sql2 . 'ORDER BY id_prod', $valor1);

				$producto=Producto::generaObjProducto($resultado1);
				}
			
			else{
				$valor2 = array(":idTienda"=>$idTienda, ":idCategoria"=>$idCategoria);
				$resultado1 = $conecta->consultaPreparada($sql1 . 
		  									' WHERE producto_tienda.id_tienda = :idTienda  AND producto.categoria=:idCategoria'. $sql2, $valor2);


				$producto=Producto::generaObjProducto($resultado1);
				
				}
		 	
			
			return json_encode($producto);

			$conecta->cerrarConexion();


		}


//Con la id hacemos la consulta y obtenemos los datos del estado de un producto

		private function getEstado($idEstado){

			$resultado = array();
			$conecta = new \Conexion\Conexion(BDNOMBRE, HOST, USUARIO, CONTRA, CHARSET);
			$sql= 'SELECT * from estado WHERE id=:idEstado ORDER BY id';
			$conecta->abrirConexion();
			$valor= array(":idEstado"=>$idEstado);
			$resultado = $conecta->consultaPreparada($sql, $valor);
			
			$conecta->cerrarConexion();
			
			return $resultado;


		}

//Con el id hacemos un update y retiramos un producto
		function baja($idProducto){

			$resultado = array();
			$conecta = new \Conexion\Conexion(BDNOMBRE, HOST, USUARIO, CONTRA, CHARSET);
			$sql= 'UPDATE producto_tienda SET estado = 4 WHERE id_producto_tienda= :id_producto_tienda';
			$conecta->abrirConexion();
			$valor= array(":id_producto_tienda"=>$idProducto);
			$resultado = $conecta->anadirDato($sql, $valor);
			
			$conecta->cerrarConexion();
			
			return 'ok';



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

//Introduciendo el objeto Producto insertamos en la BD un producto

		function agregar($producto){
				$sql = array();
				$sql1 = array();
				$valor = array();
				$valor1 =array();
				$conecta = new \Conexion\Conexion(BDNOMBRE, HOST, USUARIO, CONTRA, CHARSET);

				$sql ='INSERT INTO producto (id, nombre, descripcion, categoria, fecha_fin_campania) VALUES (:id, :nombre, :descripcion, :categoria, :fecha_fin_campania)';


				$valor=array(	":id"					=> $producto->id,
								":nombre"				=> $producto->nombre,
								":descripcion" 			=> $producto->descripcion,
								":categoria" 			=> $producto->categoria,
								":fecha_fin_campania"	=> $producto->fecha_fin_campania);
				$conecta->abrirConexion();

				$conecta->anadirDato($sql, $valor);

				$idpr =$conecta->consultaPreparada('SELECT MAX(producto.id) AS id FROM producto');

				$idprodu = $idpr[0]['id'];
				// $idprodu = $conecta->ultimoId();

				$sql1='INSERT INTO producto_tienda (id_producto_tienda, id_prod, id_tienda, stock, precio, estado)
						   VALUES (:id_producto_tienda, :id_prod, :id_tienda, :stock, :precio, :estado)';
				
				$valor1=array(	":id_producto_tienda"	=> $producto->id_producto_tienda,
								 ":id_prod"				=> $idprodu,
								 ":id_tienda"			=> $producto->tienda,
								 ":stock" 				=> $producto->stock,
								 ":precio"				=> $producto->precio,
								 ":estado"				=> $producto->estado);

				
				$conecta->anadirDato($sql1, $valor1);

				$conecta->cerrarConexion();

				return 'OK';

			}

//Con esta funcion vemos los valores de la tabla estado

		function verEstados(){

				$resultado= array();
				$conecta = new \Conexion\Conexion(BDNOMBRE, HOST, USUARIO, CONTRA, CHARSET);
				$sql = 'SELECT * from estado ORDER BY id';
				
				$conecta->abrirConexion();
				
				$resultado = $conecta->consultaPreparada($sql);

				
				$conecta->cerrarConexion();	

				return json_encode($resultado);
			}

}



 ?>