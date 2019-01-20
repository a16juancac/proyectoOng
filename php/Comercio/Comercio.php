<?php namespace Comercio;


abstract class Comercio {
	protected $id;
	protected $nombre;
	protected $descripcion;
	protected $imagen;

	function __construct($id, $nombre, $descripcion, $imagen){
		$this->id = $id;
		$this->nombre = $nombre;
		$this->descripcion = $descripcion;
		$this->imagen = $imagen;
	}


}


 ?>