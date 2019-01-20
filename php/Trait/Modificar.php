<?php namespace Modificar;

trait Modificar{

//Se modifica el objeto introducido en la funcion del trait
public function modifica($objeto){

	if(get_class($objeto)=='Evento'){

		$sql = array();
			$valor = array();

			$conecta = new \Conexion\Conexion(BDNOMBRE, HOST, USUARIO, CONTRA, CHARSET);

			$sql[0] = 'UPDATE evento SET  
											nombre=:nombre, 
											descripcion =:descripcion, 
											ruta_imagen=:imagen
											WHERE id= :id';

			$valor[0] = array(	":id" 					=> $objeto->id,
								":nombre"				=> $objeto->nombre,
								":descripcion" 			=> $objeto->descripcion,
								":imagen" 				=> $objeto->imagen

							);


			$sql[1] = 'UPDATE evento_lugar SET
													 	id_evento=:id,
													 	id_lugar=:lugar,
													 	aforo=:aforo,
													 	precio_entrada =:precio,
													 	entradas_disponibles =:entradas_disponibles

													 	WHERE id_evento_lugar = :id_evento_lugar';
			
			$valor[1] = array( 	":id_evento_lugar" 		=> $objeto->id_evento_lugar,
								":id"					=> $objeto->id,
								":lugar"				=> $objeto->lugar,
								":aforo"				=> $objeto->aforo,
								":precio"				=> $objeto->precio,
								":entradas_disponibles"	=> $objeto->entradas_disponibles

								);

			$conecta->abrirConexion();
			$conecta->actualizarDatos($sql, $valor);

			if(!empty($objeto->fechas_posibles)){
				$valorf = array(	':id_evento_lugar' 	=> $objeto->id_evento_lugar, 
									':fecha'			=> $objeto->fechas_posibles);
			$sqlf = 'INSERT INTO fechas_posibles (id_evento, fecha)
						VALUES (:id_evento_lugar, :fecha)';

			$conecta->anadirDato($sqlf, $valorf);

			}

			

			
			
		
			$conecta->cerrarConexion();

			return 'OK';

		}
		elseif(get_class($objeto)=='Producto'){

			$sql = array();
			$valor = array();
			$conecta = new \Conexion\Conexion(BDNOMBRE, HOST, USUARIO, CONTRA, CHARSET);

			$sql[0] = 'UPDATE producto SET  
											nombre=:nombre, 
											descripcion =:descripcion, 
											categoria=:categoria,
											fecha_fin_campania=:fecha_fin_campania
											WHERE id= :id';

			$valor[0] = array(	":id" 					=> $objeto->id,
								":nombre"				=> $objeto->nombre,
								":descripcion" 			=> $objeto->descripcion,
								":categoria" 			=> $objeto->categoria,
								":fecha_fin_campania"	=> $objeto->fecha_fin_campania
							);


			$sql[1] = 'UPDATE producto_tienda SET		
													 	id_tienda=:id_tienda,
													 	stock=:stock,
													 	precio=:precio,
													 	estado=:estado
													 	WHERE id_producto_tienda = :id_producto_tienda';
			
			$valor[1] = array(
								":id_tienda"			=> $objeto->tienda,
								":stock" 				=> $objeto->stock,
								":precio"				=> $objeto->precio,
								":estado"				=> $objeto->estado,
								":id_producto_tienda" 	=> $objeto->id_producto_tienda

								);
	

			for($i=0; $i<count($objeto->imagen); $i++){
				$sqlimg = array();
				$valorimg=array();

				$sqlimg = 'UPDATE imagenes_prod SET
													 	ruta=:ruta
													 	
													 	WHERE id=:id';
				array_push($sql, $sqlimg);

				$valorimg = array( 	":id" => $objeto->imagen[$i]->id,
									":ruta" => $objeto->imagen[$i]->ruta

								);

				array_push($valor, $valorimg);
			}
			

			$conecta->abrirConexion();
			$conecta->actualizarDatos($sql, $valor);

			$conecta->cerrarConexion();

			return 'OK';



		}elseif(get_class($objeto)=='Usuario'){

			
			$valor = array();

			$conecta = new \Conexion\Conexion(BDNOMBRE, HOST, USUARIO, CONTRA, CHARSET);

			$sql = 'UPDATE usuario SET nombre=:nombre, apellido1 =:apellido1, apellido2 =:apellido2, NIF =:NIF, email =:email, telefono =:telefono, direccion=:direccion, localidad=:localidad, provincia=:provincia, tipo =:tipo WHERE id=:id';

				$valor = array(	":id" 					=> $objeto->id,
								":nombre"				=> $objeto->nombre,
								":apellido1"			=> $objeto->apellido1,
								":apellido2"			=> $objeto->apellido2,
								":NIF"					=> $objeto->NIF,
								":email" 				=> $objeto->email,
								":telefono" 			=> $objeto->telefono,	
								":direccion" 			=> $objeto->direccion,
								":localidad" 			=> $objeto->localidad,
								":provincia" 			=> $objeto->provincia,
								":tipo"					=> $objeto->tipo
							);


			$conecta->abrirConexion();
			$conecta->anadirDato($sql, $valor);


			if(!empty($objeto->password)){
		
			$valor1 = array();

			$sql1 = 'UPDATE usuario SET  
											password= :password
											WHERE id= :id';

				$valor1 = array(":id" 					=> $objeto->id,
								":password" 			=> $objeto->password
							);


					$conecta->anadirDato($sql1, $valor1);
			}



			$conecta->cerrarConexion();

			return 'OK';

		}

	}




}

 ?> 
