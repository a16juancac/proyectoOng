<?php 


class Evento extends \Comercio\Comercio implements \JsonSerializable{
//LLamamos al trait
use \Modificar\Modificar; 

	private $lugar;
	private $aforo;
	private $fecha;
	private $fechas_posibles;
	private $precio;
	private $entradas_disponibles;
	private $id_evento_lugar;
	private $participantes;

	function __construct($id, $nombre, $descripcion, $imagen, $lugar='', $aforo='', $fecha='', $fechas_posibles='', $precio='', $entradas_disponibles='', $id_evento_lugar='', $participantes=''){
			parent:: __construct($id, $nombre, $descripcion, $imagen);
			$this->lugar  				= $lugar;
			$this->aforo  				= $aforo; 
			$this->fecha  				= $fecha;
			$this->fechas_posibles		= $fechas_posibles;
			$this->precio 				= $precio;
			$this->entradas_disponibles = $entradas_disponibles;
			$this->id_evento_lugar 		= $id_evento_lugar;
			$this->participantes		= $participantes;
		}


	function jsonSerialize(){
	return array(
					"id" 					=> $this->id,
					"nombre" 				=> $this->nombre,
					"descripcion"			=> $this->descripcion,
					"imagen" 				=> $this->imagen,
					"lugar" 				=> $this->lugar,
					"aforo"					=> $this->aforo,
					"fecha"					=> $this->fecha,
					"fechas_posibles"		=> $this->fechas_posibles,
					"precio"				=> $this->precio,	
					"entradas_disponibles"	=> $this->entradas_disponibles,
					"id_evento_lugar"		=> $this->id_evento_lugar,
					"participantes"			=> $this->participantes

				);
	}


	private function generaObjEvento($consulta){

	$evento = array();
		for($i=0; $i<count($consulta); $i++){
				//Creamos el objeto evento
				$evento[$i]=new Evento( 	$consulta[$i]['id'],
											$consulta[$i]['nombre'],
											$consulta[$i]['descripcion'],
											$consulta[$i]['imagen'],
											Evento::getLugar($consulta[$i]['lugar']),
											$consulta[$i]['aforo'],
											$consulta[$i]['fecha'],
											Evento::getFechasPosibles($consulta[$i]['id_evento_lugar']),
											$consulta[$i]['precio'],
											$consulta[$i]['entradas_disponibles'],
											$consulta[$i]['id_evento_lugar'],
											Evento::participanteEvento($consulta[$i]['id_evento_lugar'])
											);
				}

		return  $evento;
	}


	 private function getLugar($id_lugar=''){
		$resultado= array();
		$conecta = new \Conexion\Conexion(BDNOMBRE, HOST, USUARIO, CONTRA, CHARSET);
		$sql = 'SELECT * from lugar';
		$sql1 = ' WHERE lugar.id=:id_lugar';
		$conecta->abrirConexion();
		if(!empty($id_lugar)){
		$valor = array(':id_lugar' => $id_lugar);
		
		$resultado = $conecta->consultaPreparada($sql.$sql1, $valor);

		}
		
		else{
		$resultado = $conecta->consultaPreparada($sql);

		}
		$conecta->cerrarConexion();	

		return $resultado;

		}

		function verLugares(){
		$resultado= array();
		$conecta = new \Conexion\Conexion(BDNOMBRE, HOST, USUARIO, CONTRA, CHARSET);
		$sql = 'SELECT * from lugar';
		
		$conecta->abrirConexion();
		
		$resultado = $conecta->consultaPreparada($sql);

		
		$conecta->cerrarConexion();	

		return json_encode($resultado);

		}




		

	private function getFechasPosibles($id_evento_lugar){
		$resultado= array();
		$valor = array(':id_evento_lugar' => $id_evento_lugar);
		$sql = 'SELECT * from fechas_posibles WHERE id_evento=:id_evento_lugar';
		$conecta = new \Conexion\Conexion(BDNOMBRE, HOST, USUARIO, CONTRA, CHARSET);

		$conecta->abrirConexion();

		$resultado = $conecta->consultaPreparada($sql, $valor);

		$conecta->cerrarConexion();	
		return $resultado;
		


	}

	function verEventos($all, $fecha1='',$fecha2=''){

	$resultado1 = array();
	$sql = 'SELECT 
										evento.id,
										evento.nombre,
										evento.descripcion,
										evento.ruta_imagen as imagen,
										evento_lugar.fecha,
										evento_lugar.aforo,
										evento_lugar.precio_entrada as precio,
										evento_lugar.id_lugar as lugar,
										evento_lugar.entradas_disponibles,
										evento_lugar.id_evento_lugar
	  									FROM evento
	  									INNER JOIN evento_lugar
	  									ON evento.id = evento_lugar.id_evento';
	 $sql1 = 'SELECT 
										evento.id,
										evento.nombre,
										evento.descripcion,
										evento.ruta_imagen as imagen
	  									FROM evento';




	$conecta = new \Conexion\Conexion(BDNOMBRE, HOST, USUARIO, CONTRA, CHARSET);

	
	$conecta->abrirConexion();

	
		if($all==true){

			$sql2='';
		}

		else{
			$sql2=' AND evento_lugar.fecha is not null';

		}


		if(empty($fecha1) && !empty($fecha2)){

			$valor= array(":fecha2"=>$fecha2);

			$resultado1 = $conecta->consultaPreparada($sql .  ' where evento_lugar.fecha <= :fecha2 ORDER BY evento_lugar.fecha' . $sql2, $valor);

			$evento =  Evento::generaObjEvento($resultado1);
			
		}

		elseif(!empty($fecha1) && empty($fecha2)){
			$valor= array(":fecha1"=>$fecha1);

			$resultado1 = $conecta->consultaPreparada($sql . ' where evento_lugar.fecha >= :fecha1 ORDER BY evento_lugar.fecha' . $sql2, $valor);

			$evento =  Evento::generaObjEvento($resultado1);
			

		}
		elseif(!empty($fecha1) && !empty($fecha2)){
			$valor= array(":fecha1"=>$fecha1, ":fecha2"=>$fecha2);

			$resultado1 = $conecta->consultaPreparada($sql . ' where evento_lugar.fecha >= :fecha1 AND evento_lugar.fecha <= :fecha2 ORDER BY evento_lugar.fecha' . $sql2, $valor);

			$evento =  Evento::generaObjEvento($resultado1);
		
		}

		else{
			$resultado1 = $conecta->consultaPreparada($sql.$sql2);

			$evento =  Evento::generaObjEvento($resultado1);

		}



		
	
  									

  		$conecta->cerrarConexion();					

	
		return json_encode($evento);


	}


	function verSoloEventos(){

		$resultado= array();
		$valor = array(':id_evento_lugar' => $id_evento_lugar);
		$sql = 'SELECT * from evento';
		$conecta = new \Conexion\Conexion(BDNOMBRE, HOST, USUARIO, CONTRA, CHARSET);

		$conecta->abrirConexion();

		$resultado = $conecta->consultaPreparada($sql, $valor);

		$conecta->cerrarConexion();	
		return json_encode($resultado);

	}




	public function verxFecha($fecha1='',$fecha2=''){

	$resultado1 = array();
	$conecta = new \Conexion\Conexion(BDNOMBRE, HOST, USUARIO, CONTRA, CHARSET);

	$conecta->abrirConexion();

	$sql='SELECT 
									evento.id,
									evento.nombre,
									evento.descripcion,
									evento.ruta_imagen,
									evento_lugar.fecha,
									evento_lugar.aforo,
									evento_lugar.precio_entrada,
									lugar.lugar
  									FROM evento
  									INNER JOIN evento_lugar
  									ON evento.id = evento_lugar.id_evento
  									INNER JOIN lugar ON evento_lugar.id_lugar = lugar.id';


		if(empty($fecha1) && !empty($fecha2)){

			$valor= array(":fecha2"=>$fecha2);

			$resultado1 = $conecta->consultaPreparada($sql .  ' where evento_lugar.fecha <= :fecha2 ORDER BY evento_lugar.fecha', $valor);
			
		}

		elseif(!empty($fecha1) && empty($fecha2)){
			$valor= array(":fecha1"=>$fecha1);

			$resultado1 = $conecta->consultaPreparada($sql . ' where evento_lugar.fecha >= :fecha1 ORDER BY evento_lugar.fecha', $valor);
			

		}
		elseif(!empty($fecha1) && !empty($fecha2)){
			$valor= array(":fecha1"=>$fecha1, ":fecha2"=>$fecha2);

			$resultado1 = $conecta->consultaPreparada($sql . ' where evento_lugar.fecha >= :fecha1 AND evento_lugar.fecha <= :fecha2 ORDER BY evento_lugar.fecha', $valor);
		
		}

		else{

			$resultado1 = $conecta->consultaPreparada($sql . ' ORDER BY evento_lugar.fecha');
  									


		 }


			return json_encode($resultado1);

			$conecta->cerrarConexion();

	}




		function participanteEvento($id_evento_lugar){


			$resultado = array();
			$valor = array(':id_evento_lugar' => $id_evento_lugar);
			$participante = array();

			$conecta = new \Conexion\Conexion(BDNOMBRE, HOST, USUARIO, CONTRA, CHARSET);
			$conecta->abrirConexion();

		  	$sql= 'SELECT 	evento_participante.id_participante
			  				FROM evento_participante
			  				 WHERE evento_participante.id_evento = :id_evento_lugar';

			$resultado = $conecta->consultaPreparada($sql, $valor);
			

			for ($i=0; $i<count($resultado); $i++){
			$participante[$i] = \Participante\Participante::getParticipante($resultado[$i]['id_participante']);

			}

			return $participante;

			$conecta->cerrarConexion();

		}


	function noParticipante($idEvento){

		$resultado= array();
		$valor = array(':id' => $idEvento);
		$participante = array();
		$result = array();
		//Solicitamos los participantes que no pertenecen a dicho evento
		$sql = 'SELECT participante.id from participante WHERE participante.id NOT IN 
				(SELECT id_participante FROM evento_participante WHERE id_evento =:id)';
		$conecta = new \Conexion\Conexion(BDNOMBRE, HOST, USUARIO, CONTRA, CHARSET);

		$conecta->abrirConexion();


		$resultado = $conecta->consultaPreparada($sql, $valor);

		$conecta->cerrarConexion();	

		for($i=0; $i<count($resultado);$i++){

			$result[$i]=\Participante\Participante::getParticipante($resultado[$i]['id']);
		}



		 $participante = json_encode($result);

		
		

		return $participante;




		}

	

		function agregaPosibleFecha($id_evento_lugar, $fecha){

		$resultado= array();
		$valor = array(	':id_evento_lugar' => $id_evento_lugar, 
						':fecha' => $fecha);
		$sql = 'INSERT INTO fechas_posibles (id_evento, fecha)
						VALUES (:id_evento_lugar, :fecha)';

		$conecta = new \Conexion\Conexion(BDNOMBRE, HOST, USUARIO, CONTRA, CHARSET);

		$conecta->abrirConexion();


		$resultado = $conecta->anadirDato($sql, $valor);

		$conecta->cerrarConexion();	

		return 'ok';

		}


		function agregarFechaFija($id_evento_lugar, $fecha){
			$resultado= array();
			$valor = array(	':id_evento_lugar' => $id_evento_lugar, 
							':fecha' => $fecha);
			$sql = 'UPDATE evento_lugar SET  fecha = :fecha
							WHERE id_evento_lugar = :id_evento_lugar';

			$conecta = new \Conexion\Conexion(BDNOMBRE, HOST, USUARIO, CONTRA, CHARSET);

			$conecta->abrirConexion();


			$resultado = $conecta->anadirDato($sql, $valor);

			$conecta->cerrarConexion();	

			return 'ok';
	}

		function agregaParticipante($accion, $id_evento, $id_participante){

		$resultado= array();
		$valor = array(	':id_evento' => $id_evento, 
						':id_participante' => $id_participante);
		

		if($accion==true){

		

		$sql = 'INSERT INTO evento_participante (id_evento, id_participante)
						VALUES (:id_evento, :id_participante)';

		}
		else{

		$sql = 'DELETE FROM evento_participante WHERE evento_participante.id_evento = :id_evento AND evento_participante.id_participante = :id_participante';
		}

		$conecta = new \Conexion\Conexion(BDNOMBRE, HOST, USUARIO, CONTRA, CHARSET);

		$conecta->abrirConexion();


		$resultado = $conecta->anadirDato($sql, $valor);

		$conecta->cerrarConexion();	

		return 'ok';

		}



		function agregar($evento){

			$sql = array();
			$valor = array();

			$conecta = new \Conexion\Conexion(BDNOMBRE, HOST, USUARIO, CONTRA, CHARSET);

			$sql = 'INSERT INTO evento (id, nombre, descripcion, ruta_imagen)
						VALUES (:id, :nombre, :descripcion, :imagen)';

			$valor = array(		":id" 					=> $evento->id,
								":nombre"				=> $evento->nombre,
								":descripcion" 			=> $evento->descripcion,
								":imagen" 				=> $evento->imagen

							);

			

			$conecta->abrirConexion();
			$conecta->anadirDato($sql, $valor);
			$conecta->cerrarConexion();

			return 'OK';

		}

		// $id, $nombre, $descripcion, $imagen, $lugar='', $aforo='', $fecha='',
//fechas_posibles='', $precio='', $entradas_disponibles='', $id_evento_lugar='', $participantes=''

			function agregarEventoLugar($evento){

			$sql = array();
			$valor = array();
			$sqlf = array();
			$valorf = array();

			$conecta = new \Conexion\Conexion(BDNOMBRE, HOST, USUARIO, CONTRA, CHARSET);
			$conecta->abrirConexion();
			$sql = 'INSERT INTO evento_lugar (id_evento_lugar, id_evento, id_lugar, aforo, precio_entrada, entradas_disponibles)
						VALUES (:id_evento_lugar, :id_evento, :id_lugar, :aforo, :precio_entrada, :entradas_disponibles)';

			$valor = array(		":id_evento_lugar" 		=> null,
								":id_evento"			=> $evento->id,
								":id_lugar"				=> $evento->lugar,
								":aforo" 				=> $evento->aforo,
								":precio_entrada" 		=> $evento->precio,
								":entradas_disponibles"	=> $evento->entradas_disponibles

							);

		

			$conecta->anadirDato($sql, $valor);

			$idpr =$conecta->consultaPreparada('SELECT MAX(id_evento_lugar) AS id FROM evento_lugar');

			$ideven = $idpr[0]['id'];
				// $idprodu = $conecta->ultimoId();


			$valorf = array(	':id_evento' 	=> $ideven, 
								':fecha' 		=> $evento->fechas_posibles);
			$sqlf = 'INSERT INTO fechas_posibles (id_evento, fecha)
						VALUES (:id_evento, :fecha)';


		
	
			$conecta->anadirDato($sqlf, $valorf);
			$conecta->cerrarConexion();

			return 'OK';

		}
	
}


 ?>



