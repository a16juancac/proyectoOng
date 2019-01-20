<?php namespace ReservaProducto;



class ReservaProducto extends \Reserva\Reserva implements \JsonSerializable{

private $id_objetoespecifico;
private $id_tienda;

	function __construct($id_reserva, $id_usuario, $id_objeto, $cantidad, $precio_total, $fecha, $id_objetoespecifico, $id_tienda){

		parent::__construct($id_reserva, $id_usuario, $id_objeto, $cantidad, $precio_total, $fecha);
		$this->id_objetoespecifico = $id_objetoespecifico;
		$this->id_tienda = $id_tienda;
	}



	function jsonSerialize(){
		return array("id_reserva" 	=> $this->id_reserva,
					"id_usuario" 	=> $this->id_usuario,
					"id_objeto"		=> $this->id_objeto,
					"cantidad" 		=> $this->cantidad,
					"precio_total" 	=> $this->precio_total,
					"fecha" 		=> $this->fecha,
					"id_objetoespecifico" => $this->id_objetoespecifico,
					"id_tienda" 	=> $this->id_tienda);

	}




//Introducimos el objeto reservaProducto para insertalo en la base de datos
 	function hacerReserva($reservaProducto){

 				$sql = array();
				$valor = array();
				$sql1 = array();
				$valor1 = array();
			

				$conecta = new \Conexion\Conexion(BDNOMBRE, HOST, USUARIO, CONTRA, CHARSET);

				$sql[0] ='INSERT INTO reserva_prod (id_reserva, id_usuario, id_producto, id_tienda, cantidad, precio_total, fecha) VALUES (:id_reserva, :id_usuario, :id_producto, :id_tienda, :cantidad, :precio_total, :fecha)';

				$valor[0]=array(":id_reserva"	=> $reservaProducto->id_reserva,
								":id_usuario"	=> $reservaProducto->id_usuario,
								":id_producto" 	=> $reservaProducto->id_objeto,
								":id_tienda"	=> $reservaProducto->id_tienda,
								":cantidad"		=> $reservaProducto->cantidad,
								":precio_total"	=> $reservaProducto->precio_total,
								":fecha"		=> $reservaProducto->fecha		
							);
				
				


				$sql1 ='SELECT  estado, stock FROM producto_tienda WHERE id_producto_tienda = :id_producto_tienda';

				$valor1=array(":id_producto_tienda"=>$reservaProducto->id_objetoespecifico);
				
				
				
				
				$conecta->abrirConexion();

				
				$resultado=$conecta->consultaPreparada($sql1, $valor1);

				$cantidad = $resultado[0]['stock'] - $reservaProducto->cantidad;
			


				if($cantidad==0){

				$sql[1] ='UPDATE producto_tienda SET stock = 0, estado=3 WHERE id_producto_tienda= :id_producto_tienda';

				$valor[1]=array(":id_producto_tienda" 	=> $reservaProducto->id_objetoespecifico);

				}
				else{

					$sql[1] ='UPDATE producto_tienda SET stock = :stock WHERE id_producto_tienda= :id_producto_tienda';

					$valor[1]=array(":stock" => $cantidad, 
								":id_producto_tienda" 	=> $reservaProducto->id_objetoespecifico);

				}


				$resultado=$conecta->actualizarDatos($sql, $valor);


				$conecta->cerrarConexion();

				return $cantidad;

 	} 



 	function verReservaProducto($usuario='', $fecha1='', $fecha2=''){

 	$resultado1 = array();
	$conecta = new \Conexion\Conexion(BDNOMBRE, HOST, USUARIO, CONTRA, CHARSET);

	$conecta->abrirConexion();

	$sql='SELECT reserva_prod.id_reserva, reserva_prod.id_usuario,
					usuario.nombre, usuario.apellido1, usuario.apellido2,
					usuario.NIF, producto.nombre as producto,  reserva_prod.cantidad,  
					reserva_prod.precio_total, reserva_prod.fecha FROM  reserva_prod
					INNER JOIN usuario ON  reserva_prod.id_usuario = usuario.id
					INNER JOIN  producto_tienda ON   reserva_prod.id_producto
					= producto_tienda.id_prod INNER JOIN producto ON producto_tienda.id_prod
					= producto.id';
	
	$sql1 = '  WHERE reserva_prod.id_usuario =:usuario ';


	if(empty($usuario)){

		if(empty($fecha1) && !empty($fecha2)){

			$valor= array(":fecha2"=>$fecha2);

			$resultado1 = $conecta->consultaPreparada($sql .  ' where reserva_prod.fecha <= :fecha2 GROUP BY id_reserva ORDER BY reserva_prod.fecha', $valor);
			
		}

		elseif(!empty($fecha1) && empty($fecha2)){
			$valor= array(":fecha1"=>$fecha1);

			$resultado1 = $conecta->consultaPreparada($sql . ' where reserva_prod.fecha >= :fecha1 GROUP BY id_reserva ORDER BY reserva_prod.fecha', $valor);
			

		}
		elseif(!empty($fecha1) && !empty($fecha2)){
			$valor= array(":fecha1"=>$fecha1, ":fecha2"=>$fecha2);

			$resultado1 = $conecta->consultaPreparada($sql . ' where reserva_prod.fecha >= :fecha1 AND reserva_prod.fecha <= :fecha2 GROUP BY id_reserva ORDER BY reserva_prod.fecha', $valor);
		
		}

		else{
			$valor= array(":usuario"=>$usuario);
			$resultado1 = $conecta->consultaPreparada($sql . ' GROUP BY id_reserva ORDER BY reserva_prod.fecha');
  									


		 }

	}
	else{

		if(empty($fecha1) && !empty($fecha2)){

			$valor= array(":fecha2"=>$fecha2, ":usuario"=>$usuario);

			$resultado1 = $conecta->consultaPreparada($sql .  $sql1 .' AND reserva_prod.fecha <= :fecha2 GROUP BY id_reserva ORDER BY reserva_prod.fecha', $valor);
			
		}

		elseif(!empty($fecha1) && empty($fecha2)){
			$valor= array(":fecha1"=>$fecha1, ":usuario"=>$usuario);

			$resultado1 = $conecta->consultaPreparada($sql . $sql1.' AND reserva_prod.fecha >= :fecha1 GROUP BY id_reserva ORDER BY reserva_prod.fecha', $valor);
			

		}
		elseif(!empty($fecha1) && !empty($fecha2)){
			$valor= array(":fecha1"=>$fecha1, ":fecha2"=>$fecha2, ":usuario"=>$usuario);

			$resultado1 = $conecta->consultaPreparada($sql . $sql1 . ' AND reserva_prod.fecha >= :fecha1 AND reserva_prod.fecha <= :fecha2 GROUP BY id_reserva ORDER BY reserva_prod.fecha', $valor);
		
		}

		else{
			$valor= array(":usuario"=>$usuario);
			$resultado1 = $conecta->consultaPreparada($sql . $sql1 .' GROUP BY id_reserva ORDER BY reserva_prod.fecha', $valor);
  									
			

		 }


	}

			return json_encode($resultado1);

			$conecta->cerrarConexion();
 	}

}


 ?>