<?php namespace ReservaEvento;



class ReservaEvento extends \Reserva\Reserva implements \JsonSerializable{


	function __construct($id_reserva, $id_usuario, $id_objeto, $cantidad, $precio_total, $fecha){

		parent::__construct($id_reserva, $id_usuario, $id_objeto, $cantidad, $precio_total, $fecha);
	
	}

	function jsonSerialize(){
		return array("id_reserva" 	=> $this->id_reserva,
					"id_usuario" 	=> $this->id_usuario,
					"id_objeto"		=> $this->id_objeto,
					"cantidad" 		=> $this->cantidad,
					"precio_total" 	=> $this->precio_total,
					"fecha" 		=> $this->fecha
					);
	}



//Introducimos el objeto reservaProducto para insertalo en la base de datos
 	function hacerReserva($reservaEvento){

 				$sql = array();
				$valor = array();
				$sql1 = array();
				$valor1 = array();
			

				$conecta = new \Conexion\Conexion(BDNOMBRE, HOST, USUARIO, CONTRA, CHARSET);

				$sql[0] ='INSERT INTO reserva_event (id_reserva, id_usuario, id_evento, cantidad, precio_total, fecha) VALUES (:id_reserva, :id_usuario, :id_evento, :cantidad, :precio_total, :fecha)';

				$valor[0]=array(":id_reserva"	=> $reservaEvento->id_reserva,
								":id_usuario"	=> $reservaEvento->id_usuario,
								":id_evento" 	=> $reservaEvento->id_objeto,
								":cantidad"		=> $reservaEvento->cantidad,
								":precio_total"	=> $reservaEvento->precio_total,
								":fecha"		=> $reservaEvento->fecha		
							);
				
				

				$sql1 ='SELECT  entradas_disponibles FROM evento_lugar WHERE id_evento_lugar = :id_evento';

				$valor1=array(":id_evento"=>$reservaEvento->id_objeto);
				
				
				$conecta->abrirConexion();

				
				$resultado=$conecta->consultaPreparada($sql1, $valor1);

				$cantidad = $resultado[0]['entradas_disponibles'] - $reservaEvento->cantidad;
	

					$sql[1] ='UPDATE evento_lugar SET entradas_disponibles = :entradas_disponibles WHERE id_evento_lugar= :id_evento';

					$valor[1]=array(":entradas_disponibles" => $cantidad, 
									":id_evento" 	=> $reservaEvento->id_objeto);

				

				$resultado=$conecta->actualizarDatos($sql, $valor);


				$conecta->cerrarConexion();

				return $cantidad;

 	} 







//Consultamos las reservas existentes en la BD y el retorno varia segun los parametros introducidos en la función
	function verReservaEvento($usuario='',$fecha1='', $fecha2=''){

 	$resultado1 = array();
	$conecta = new \Conexion\Conexion(BDNOMBRE, HOST, USUARIO, CONTRA, CHARSET);

	$conecta->abrirConexion();

	$sql='SELECT reserva_event.id_reserva, reserva_event.id_usuario,
					usuario.nombre, usuario.apellido1, usuario.apellido2,
					usuario.NIF, evento.nombre as evento,  reserva_event.cantidad,  
					reserva_event.precio_total, reserva_event.fecha FROM  reserva_event
					INNER JOIN usuario ON  reserva_event.id_usuario = usuario.id
					INNER JOIN evento_lugar ON   reserva_event.id_evento
					= evento_lugar.id_evento_lugar INNER JOIN evento ON evento_lugar.id_evento_lugar = evento.id';
	
	$sql1 = ' WHERE reserva_event.id_usuario =:usuario ';


	if(empty($usuario)){

		if(empty($fecha1) && !empty($fecha2)){

			$valor= array(":fecha2"=>$fecha2);

			$resultado1 = $conecta->consultaPreparada($sql .  ' where reserva_event.fecha <= :fecha2 GROUP BY id_reserva ORDER BY reserva_event.fecha', $valor);
			
		}

		elseif(!empty($fecha1) && empty($fecha2)){
			$valor= array(":fecha1"=>$fecha1);

			$resultado1 = $conecta->consultaPreparada($sql . ' where reserva_event.fecha >= :fecha1 GROUP BY id_reserva ORDER BY reserva_event.fecha', $valor);
			

		}
		elseif(!empty($fecha1) && !empty($fecha2)){
			$valor= array(":fecha1"=>$fecha1, ":fecha2"=>$fecha2);

			$resultado1 = $conecta->consultaPreparada($sql . ' where reserva_event.fecha >= :fecha1 AND reserva_event.fecha <= :fecha2 GROUP BY id_reserva ORDER BY reserva_event.fecha', $valor);
		
		}

		else{

			$resultado1 = $conecta->consultaPreparada($sql . ' GROUP BY id_reserva ORDER BY reserva_event.fecha');						
		 }

	}
	else{

		if(empty($fecha1) && !empty($fecha2)){

			$valor= array(":fecha2"=>$fecha2, ":usuario"=>$usuario);

			$resultado1 = $conecta->consultaPreparada($sql . $sql1.' AND reserva_event.fecha <= :fecha2 GROUP BY id_reserva ORDER BY reserva_event.fecha', $valor);
			
		}

		elseif(!empty($fecha1) && empty($fecha2)){
			$valor= array(":fecha1"=>$fecha1, ":usuario"=>$usuario);

			$resultado1 = $conecta->consultaPreparada($sql .  $sql1.' AND reserva_event.fecha >= :fecha1 GROUP BY id_reserva ORDER BY reserva_event.fecha', $valor);
			

		}
		elseif(!empty($fecha1) && !empty($fecha2)){
			$valor= array(":fecha1"=>$fecha1, ":fecha2"=>$fecha2, ":usuario"=>$usuario);

			$resultado1 = $conecta->consultaPreparada($sql . $sql1. ' AND reserva_event.fecha >= :fecha1 AND reserva_event.fecha <= :fecha2 GROUP BY id_reserva ORDER BY reserva_event.fecha', $valor);
		
		}

		else{
			$valor= array(":usuario"=>$usuario);
			$resultado1 = $conecta->consultaPreparada($sql . $sql1 . ' GROUP BY id_reserva ORDER BY reserva_event.fecha', $valor);	
			

		 }


	}
			return json_encode($resultado1);

			$conecta->cerrarConexion();
 	}

}







 ?>