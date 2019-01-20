<?php namespace Reserva;


abstract class Reserva{


protected $id_reserva;
protected $id_usuario;
protected $id_objeto;
protected $cantidad;
protected $precio_total;
protected $fecha;



	function __construct($id_reserva, $id_usuario, $id_objeto, $cantidad, $precio_total, $fecha){
		$this->id_reserva = $id_reserva;
		$this->id_usuario = $id_usuario;
		$this->id_objeto = $id_objeto;
		$this->cantidad = $cantidad;
		$this->precio_total = $precio_total;
		$this->fecha = $fecha;
		
	}




}


 ?>