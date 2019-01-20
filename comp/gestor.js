


var miApp = angular.module('gestor',[]);

//*Creamos el controlador para el panel de gestor
miApp.controller('gestorctr', function($scope, $http, $location, $rootScope){


$scope.productovisible = true;
$scope.Productos = function (){

	var peticion = {
			"url": "php/Consultas/verProductos.php",
			"method": "POST",
			"data": {usu: false}
			};

		$http(peticion).then(function(fuebien){

			$scope.articulos = fuebien.data;
			

		}, function(fuemal){

			alert("Error al hacer la peticion");
		});

	};

	$scope.Productos();


$scope.Eventos = function(){

	var peticion1 = {
		"url": "php/Consultas/verEventos.php",
		"method": "POST",
		"data" : {all:true
				}
		};
		

	$http(peticion1).then(function(fuebien){

		$scope.event = fuebien.data;
		$scope.eventos1 = angular.copy($scope.event);
		
	}, function(fuemal){

		alert("Error al hacer la peticion");
	});	


};



	$scope.verLosEventos = function(){
	$scope.eventovisible = true;
	$scope.productovisible = false;
	$scope.verportienda = false;
	$scope.verporcatego = false;
	$scope.tiendavisible = false;
	$scope.perfilvisible=false;
	$scope.eventousuvisible=false;
	$scope.productousuvisible=false;
	$scope.Eventos();
	
	};

	$scope.Eventos();


$scope.buscarxFecha = function (){

	var peticion2 = {
		"url": "php/Consultas/verEventos.php",
		"method": "POST",
		"data": {fecha1: $("#fecha1").val(),
				 fecha2 : $("#fecha2").val(),
				 all:true
				}

		};

	$http(peticion2).then(function(fuebien){

		$scope.event = fuebien.data;
		$scope.eventos1 = angular.copy($scope.event);
		

	}, function(fuemal){

		alert("Error al hacer la peticion");
	});
};



$scope.verProductos = function(){
$scope.productovisible = true;
$scope.verportienda = false;
$scope.verporcatego = false;
$scope.tiendavisible = false;
$scope.perfilvisible=false;
$scope.eventousuvisible=false;
$scope.productousuvisible=false;
$scope.eventovisible = false;

var peticion3 = {
		"url": "php/Consultas/verProductos.php",
		"method": "POST",
		"data": {usu: false}
		};

	$http(peticion3).then(function(fuebien){

		$scope.articulos = fuebien.data;

	}, function(fuemal){

		alert("Error al hacer la peticion");
	});

};
	
// $scope.verportienda = false;
$scope.verlasTiendas = function(){

$scope.verportienda = !$scope.verportienda;
$scope.productovisible = true;
$scope.eventovisible = false;
$scope.verporcatego = false;
$scope.tiendavisible = false;
$scope.perfilvisible=false;
$scope.eventousuvisible=false;
$scope.productousuvisible=false;
};




//Enlace para ver los los productos por categoría
$scope.verxTienda = function (){
	//Guardamos la id 
	$scope.eventovisible = false;
	$scope.productovisible = true;
	$scope.verportienda = true;
	$scope.tiendavisible = false;
	$scope.verporcatego = false;
	$scope.perfilvisible=false;
	$scope.eventousuvisible=false;
	$scope.productousuvisible=false;
	


	id = this.tienda.id;
	$scope.id_tienda = id;
	var peticion4 = {
		"url": "php/Consultas/verProductos.php",
		"method": "POST",
		"data": {idti: $scope.id_tienda,
				 usu: false
				}

		};
		
	$http(peticion4).then(function(fuebien){

		$scope.art = fuebien.data;
		$scope.articulos = angular.copy($scope.art);
	
		

	}, function(fuemal){

		alert("Error al hacer la peticion");
	});


};

$scope.eventoporcatego = false;

$scope.verlascateogrias = function(){

	$scope.verporcatego = !$scope.verporcatego;
	$scope.productovisible = true;
	$scope.verportienda = false;
	$scope.tiendavisible = false;
	$scope.perfilvisible=false;
	$scope.eventousuvisible=false;
	$scope.productousuvisible=false;
	$scope.eventovisible = false;
};





$scope.lasCategorias = function(){

	
	var peticion19 = {
		"url": "php/Consultas/verCategoria.php",
		"method": "POST"
		};


	$http(peticion19).then(function(fuebien){

		$scope.categorias = fuebien.data;

	}, function(fuemal){

		alert("Error al hacer la peticion");
	});

};

$scope.lasCategorias();

$scope.verxCategoria = function (){
	$scope.verporcatego = true;
	$scope.productovisible = true;
	$scope.eventovisible = false;
	$scope.tiendavisible = false;
	$scope.perfilvisible=false;
	$scope.eventousuvisible=false;
	$scope.productousuvisible=false;
	
	categori = this.categoria.id;
	$scope.id_catego = categori;
	var peticion18 = {
		"url": "php/Consultas/verProductos.php",
		"method": "POST",
		"data": {
				idcate : $scope.id_catego,
				usu : false
				}

		};
		

	$http(peticion18).then(function(fuebien){

		$scope.procate = fuebien.data;
		$scope.articulos = angular.copy($scope.procate);
	

	}, function(fuemal){

		alert("Error al hacer la peticion");
	});



};




//consultamos las tiendas

$scope.tiendas = function(){


var peticion5 = {
		"url": "php/Consultas/vertienda.php",
		"method": "POST",
		
		};
		
		$http(peticion5).then(function(fuebien){

		$scope.otras = fuebien.data;
		$scope.otrastiendas = angular.copy($scope.otras);

	}, function(fuemal){

		alert("Error al hacer la peticion");
	});



};

$scope.tiendas();


$scope.categorias = function(){
	var peticion6 = {
		"url": "php/Consultas/verCategoria.php",
		"method": "POST"
		};


	$http(peticion6).then(function(fuebien){

		$scope.categorias = fuebien.data;

	}, function(fuemal){

		alert("Error al hacer la peticion");
	});

};

$scope.categorias();


	$scope.datos = { id:'', id_producto_tienda:'', nombre: '', descripcion: '', imagen:'', precio:'', categoria:'', estado:'', fecha_fin_campania: '', stock:'', tienda:''};
	
	$scope.modifica = function(){

		
		//Creamos un objeto modal para la ventanamodal
		$scope.modi=this;


		(['id','id_producto_tienda', 'nombre', 'descripcion', 'imagen', 'precio', 'categoria', 'estado', 'fecha_fin_campania', 'stock', 'tienda']).forEach( function(valor, indice) {

			$scope.datos[valor] = $scope.modi.articulo[valor];
			$scope.datos['fecha_fin_campania']=new Date ($scope.datos['fecha_fin_campania']);
			
		});

			$scope.mitienda = $scope.datos['tienda'][0];
			$scope.micategoria = $scope.datos['categoria'][0];

		$scope.modal = {
			'opcion' : ' Editar',
			'boton' : 'Guardar',
			'bcolor' : 'azul',
			'image':false,
			'id' : this.articulo.id,
			'datos' : $scope.datos,
			'fecha' : ('').hoy()
		};

	//mostrar ventana modal
		 modalabrir('#mRef');

	};


	$scope.anadir = function(){
		
		$scope.datos = { id:'', id_producto_tienda:'', nombre: '', descripcion: '', imagen:'', precio:'', categoria:'', estado:'', fecha_fin_campania: '', stock:'', tienda:''};
		$scope.mitienda='';
		$scope.micategoria='';
		//Creamos un objeto modal para la ventanamodal
		$scope.modal = {
			'opcion' : ' Añadir',
			'boton' : 'Añadir',
			'bcolor' : 'verde',
			'image':true,
			'datos' : $scope.datos,
			'fecha' : ('').hoy()
		};
	
		//mostrar ventana modal
		 modalabrir('#mRef');
	};



	$scope.borrar = function(){

		//Creamos un objeto modal para la ventanamodal
		$scope.modi=this;

		(['id','id_producto_tienda', 'nombre', 'descripcion', 'imagen', 'precio', 'categoria', 'estado', 'fecha_fin_campania', 'stock', 'tienda']).forEach( function(valor, indice) {

			$scope.datos[valor] = $scope.modi.articulo[valor];
			$scope.datos['fecha_fin_campania']=new Date ($scope.datos['fecha_fin_campania']);
			// statements
		});
			$scope.mitienda = $scope.datos['tienda'][0];
			$scope.micategoria = $scope.datos['categoria'][0];

		$scope.modal = {
			'opcion' : ' Quitar',
			'boton' : 'Baja',
			'bcolor' : 'rojo',
			'image':false,
			'id' : this.articulo.id,
			'datos' : $scope.datos,
			'fecha' : ('').hoy()
		};
		
		//mostrar ventana modal
		 modalabrir('#mRef');
	};


$scope.generar = function(){

			switch ($scope.modal.boton) {
				case 'Guardar':
					
					// Cerrar ventana modal
					modalcerrar('#mRef');
			
					var peticion7 = {
						"url": "php/Cambios/cambiarProducto.php",
						"method": "POST",
						"data": {

								 idpro : $scope.datos.id,
								 nombrepro: $scope.datos.nombre,
								 descripcionpro: $scope.datos.descripcion,
								 imagenpro: $scope.datos.imagen,
								 fechafincampaniapro: $scope.datos.fecha_fin_campania,
								 categoriapro: $scope.micategoria.id,
								 stockpro: $scope.datos.stock,
								 preciopro: $scope.datos.precio,
								 estadopro: $scope.datos.estado[0].id,
								 tiendapro: $scope.mitienda.id,
								 idproductotiendapro: $scope.datos.id_producto_tienda


								}

						};
						

					$http(peticion7).then(function(fuebien){

						

						alert('Cambio realizado correctamente');

						$scope.Productos();
						
						

					}, function(fuemal){

						alert("Error al hacer la peticion");
					});

					
					break;

					case 'Baja':
					// Cerrar ventana modal
					modalcerrar('#mRef');
						var peticion26 = {
						"url": "php/Cambios/bajaProducto.php",
						"method": "POST",
						// "headers" : {'Content-Type':'application/x-www-form-urlencoded; charset=UTF-8'},
						"data": {
								 idpro: $scope.datos.id_producto_tienda
								}

						};
						
					$http(peticion26).then(function(fuebien){

						

						alert("Eliminado");

						$scope.Productos();
						
						

					}, function(fuemal){

						alert("Error al hacer la peticion");
					});


			
					break;

					case 'Añadir':
					// Cerrar ventana modal
					modalcerrar('#mRef');
						var peticion9 = {
						"url": "php/Cambios/agregarProducto.php",
						"method": "POST",
						// "headers" : {'Content-Type':'application/x-www-form-urlencoded; charset=UTF-8'},
						"data": {

								 
								 nombrepro: $scope.datos.nombre,
								 descripcionpro: $scope.datos.descripcion,
								 imagenpro: $scope.datos.imagen,
								 fechafincampaniapro: $scope.datos.fecha_fin_campania,
								 categoriapro: $scope.micategoria.id,
								 stockpro: $scope.datos.stock,
								 preciopro: $scope.datos.precio,
								 tiendapro: $scope.mitienda.id,
								


								}

						};
						
					$http(peticion9).then(function(fuebien){

						

						alert('Cambio realizado correctamente');

						$scope.Productos();
						
						

					}, function(fuemal){

						alert("Error al hacer la peticion");
					});

						break;
			}

	};


	$scope.datos = {id:'', nombre: '', descripcion: '', imagen:'', fecha_posible:''};

	$scope.anadireve = function(){
		
		$scope.datos = { id:'', nombre: '', descripcion: '', imagen:'', fecha_posible:''};

		//Creamos un objeto modal para la ventanamodal
		$scope.modaleve = {
			'opcion' : ' Añadir',
			'boton' : 'Añadir evento',
			'bcolor' : 'verde',
			'id' : $scope.datos.id,
			'datos' : $scope.datos,
			'fecha' : ('').hoy()
		};
	
		//mostrar ventana modal
		 modalabrir('#mRefeve');
	};


	$scope.anadirevelug = function(){
		$scope.soloEventos();
		$scope.datos= { id:'', nombre: '', fecha_posible:'', aforo:'', lugar:'', precio:'', entradas:'', entradas_disponibles:''};
		$scope.datosevelug = { id:'', nombre: '', fecha_posible:'', aforo:'', lugar:'', precio:'', entradas:'', entradas_disponibles:''};
		//Creamos un objeto modal para la ventanamodal
		$scope.modalevelug = {
			'opcion' : ' Añadir',
			'boton' : 'Añadir',
			'bcolor' : 'gris',
			'datos' : $scope.datos,
			'fecha' : ('').hoy()
		};
		
		//mostrar ventana modal
		 modalabrir('.mRefevelug');
		 
	
	

	};

	$scope.soloEventos = function(){

		var peticion10 = {
			"url": "php/Consultas/verSoloEventos.php",
			"method": "POST",
			"data" : {all:false
				}
		};
		
		$http(peticion10).then(function(fuebien){

		$scope.event = fuebien.data;
		$scope.events = angular.copy($scope.event);

	}, function(fuemal){

		alert("Error al hacer la peticion");
	});

	};


	$scope.soloEventos();




	$scope.soloLugares = function(){



		var peticion11 = {
			"url": "php/Consultas/verLugares.php",
		"method": "POST",
		"data" : {all:false
				}
		};
		
		$http(peticion11).then(function(fuebien){

		$scope.lug = fuebien.data;
		$scope.lugares = angular.copy($scope.lug);
		
	}, function(fuemal){

		alert("Error al hacer la peticion");
	});
	};

	$scope.soloLugares();



	


	
	
	$scope.editareve = function(){

	$scope.datos = {id:'',id_evento_lugar:'',  nombre: '', descripcion:'', imagen:'', aforo:'', 
							lugar:'', precio:'', entradas_disponibles:'', fechas_posibles:'', fecha:''};
		$scope.fechaposible='';
		
		$scope.modi=this;
		


		(['id', 'id_evento_lugar', 'nombre', 'descripcion','imagen', 'precio', 'aforo', 'lugar', 
			'precio', 'entradas_disponibles', 'fechas_posibles', 'fecha']).forEach( function(valor, indice) {

			$scope.datos[valor] = $scope.modi.evento[valor];
	
		});

		$scope.listanombre =$scope.datos; 
		$scope.listalugar =$scope.datos.lugar[0];
			

		$scope.modaleveedit = {
			'opcion' : ' Editar',
			'boton' : 'Guardar',
			'bcolor' : 'azul',
			'datos' : $scope.datos,
			'fecha' : ('').hoy()


		};

		
		 modalabrir('#mRefevemodi');

		

	};

	

	$scope.generaeve = function(){


		modalcerrar('#mRefevemodi');
		 
		// $scope.fechaposi = $scope.fechaposi.toLocaleDateString('en-US');
		if($scope.fechaposible !=''){

			$scope.fechaposible= $scope.fechaposible.toLocaleDateString('en-US');
			}

		

					var peticion12 = {
						"url": "php/Cambios/cambiarEvento.php",
						"method": "POST",
						// "headers" : {'Content-Type':'application/x-www-form-urlencoded; charset=UTF-8'},
						"data": {

								 ideve: $scope.datos.id,
								 idevelug: $scope.datos.id_evento_lugar,
								 nombreeve: $scope.listanombre.nombre,
								 descripcioneve: $scope.datos.descripcion,
								 imageneve: $scope.datos.imagen,
								 aforoeve: $scope.datos.aforo,
								 lugareve: $scope.listalugar.id,
								 precioeve: $scope.datos.precio,
								 entradaseve: $scope.datos.entradas_disponibles,
								 fechasposibleseve: $scope.fechaposible,
								 fechaeve: $scope.fechaevento

								}

						};
						

					$http(peticion12).then(function(fuebien){

						
						
						alert('Cambio realizado correctamente');
						$scope.Eventos();

						
						

					}, function(fuemal){

						alert("Error al hacer la peticion");
					});

					

	};

	$scope.fechaposible='';
$scope.generarevenuevo = function(){


		modalcerrar('#mRefeve');

		// $scope.fechaposi = $scope.fechaposi.toLocaleDateString('en-US');
		if($scope.fechaposible !=''){

			$scope.fechaposible= $scope.fechaposible.toLocaleDateString('en-US');
			}


					var peticion20 = {
						"url": "php/Cambios/agregarEvento.php",
						"method": "POST",
						"data": {

						
								 nombreeve: $scope.datos.nombre,
								 descripcioneve: $scope.datos.descripcion,
								 imageneve: $scope.datos.imagen,
								 

								}

						};
						

					$http(peticion20).then(function(fuebien){
						$scope.Eventos();
						alert('Cambio realizado correctamente');
						


					}, function(fuemal){

						alert("Error al hacer la peticion");
					});
		

	};

	$scope.fechaposible='';
	$scope.generaevelug = function(){
	
			modalcerrar('#mRefevelug');
		if($scope.fechaposible !=''){

			$scope.fechaposible= $scope.fechaposible.toLocaleDateString('en-US');
			}

		

					var peticion21 = {
						"url": "php/Cambios/agregarEventoLugar.php",
						"method": "POST",
						"data": {

								 ideve: $scope.datos.nombre.id,
								 aforoeve: $scope.datos.aforo,
								 lugareve: $scope.datos.lugar.id,
								 precioeve: $scope.datos.precio,
								 entradaseve: $scope.datos.entradas_disponibles,
								 fechasposibleseve: $scope.fechaposible,

								}

						};
						

					$http(peticion21).then(function(fuebien){

						
						
						alert('Cambio realizado correctamente');
						$scope.Eventos();


					}, function(fuemal){

						alert("Error al hacer la peticion");
					});

					

	};
	
	$scope.datos = {id:'',id_evento_lugar:'',  nombre: '', descripcion:'', imagen:'', aforo:'', 
							lugar:'', precio:'', entradas_disponibles:'', fechas_posibles:'', fecha:'', participantes:''};

	$scope.anadirParticipante = function(){
		$scope.nuevoparti = new Array();
		$scope.losElegidos = new Array();
		$scope.modi=this;
		

		(['id', 'id_evento_lugar', 'nombre', 'descripcion','imagen', 'precio', 'aforo', 'lugar', 
			'precio', 'entradas_disponibles', 'fechas_posibles', 'fecha', 'participantes']).forEach( function(valor, indice) {

			$scope.datos[valor] = $scope.modi.evento[valor];
	
		});


		$scope.modalparti = {
			'opcion' : ' Añadir',
			'boton' : 'Añadir',
			'bcolor' : 'violeta',
			'tipo': ' disponibles',
			'icono': 'check_box',
			'datos' : $scope.datos,
			'fecha' : ('').hoy()

		};

		

		$scope.nopartis = new Array();
		var peticion13= {
			"url": "php/Consultas/verNoParticipantes.php",
			"method": "POST",
			"data": {idev:$scope.datos.id_evento_lugar

								}
		
		};
		
		$http(peticion13).then(function(fuebien){

		$scope.noparti = fuebien.data;
		$scope.nopartis = angular.copy($scope.noparti);
		
		
		for(var j=0; j<$scope.nopartis.length; j++){
			$scope.losElegidos[j]=$scope.nopartis[j][0];
			
		}


		}, function(fuemal){

		alert("Error al hacer la peticion");
	});

		

		modalabrir('#mRefparti');
		
	};


	$scope.borrarParticipante = function(){
		$scope.nuevoparti = new Array();
		$scope.modi=this;
		

		(['id', 'id_evento_lugar', 'nombre', 'descripcion','imagen', 'precio', 'aforo', 'lugar', 
			'precio', 'entradas_disponibles', 'fechas_posibles', 'fecha', 'participantes']).forEach( function(valor, indice) {

			$scope.datos[valor] = $scope.modi.evento[valor];
	
		});


		$scope.modalparti = {
			'opcion' : ' Quitar',
			'boton' : 'Quitar',
			'bcolor' : 'rojo',
			'tipo': ' agregados',
			'icono': 'indeterminate_check_box',
			'datos' : $scope.datos,
			'fecha' : ('').hoy()

		};

		$scope.lospartis = $scope.datos.participantes;
		$scope.losElegidos = new Array();
	
		 for(var i=0; i<$scope.datos.participantes.length; i++){
			$scope.losElegidos[i]=$scope.datos.participantes[i][0];
			
		}
	
			modalabrir('#mRefparti');


	};

	//funcion para añadir y quitar participantes de eventos


	$scope.losSelecionados = function(partis){
		return $scope.nuevoparti.indexOf(partis) > -1;

	};

	$scope.seleccionparti = function(partis){

	var idx = $scope.nuevoparti.indexOf(partis);
		if(idx > -1){

			$scope.nuevoparti.splice(idx,1);
		}
		else{
			$scope.nuevoparti.push(partis);
		}
	};



	$scope.generarParticipante = function(){

			switch ($scope.modalparti.boton) {
				case 'Añadir':
					
					modalcerrar('#mRefparti');
			
					var peticion14 = {
						"url": "php/Cambios/agregaParticipante.php",
						"method": "POST",
						"data": {

								 ideven: $scope.modalparti.datos.id_evento_lugar,
								 idparti: $scope.nuevoparti,
								 accion : true
								
								}

						};
						

					$http(peticion14).then(function(fuebien){

						alert('Cambio realizado correctamente');

						$scope.Eventos();
						
						

					}, function(fuemal){

						alert("Error al hacer la peticion");
					});

					
					break;

				case 'Quitar':
					// Cerrar ventana modal
					modalcerrar('#mRefparti');
					

					var peticion15 = {
						"url": "php/Cambios/agregaParticipante.php",
						"method": "POST",
						"data": {

								 ideven: $scope.modalparti.datos.id_evento_lugar,
								 idparti: $scope.nuevoparti,
								 accion : false
								
								}

						};
						

					$http(peticion15).then(function(fuebien){

						alert("Eliminado");

						$scope.Eventos();
						
						

					}, function(fuemal){

						alert("Error al hacer la peticion");
					});

					
			
					break;

			}

	};





	
	
	$scope.anadirFechaPosible = function(){

	$scope.fech1 ='';

	$scope.modi=this;
		

		(['id', 'id_evento_lugar', 'nombre', 'descripcion','imagen', 'precio', 'aforo', 'lugar', 
			'precio', 'entradas_disponibles', 'fechas_posibles', 'fecha', 'participantes']).forEach( function(valor, indice) {

			$scope.datos[valor] = $scope.modi.evento[valor];
	
		});


		$scope.modalparti = {
			'opcion' : ' Añadir',
			'boton' : 'Añadir',
			'bcolor' : 'rosa',
			'tipo': ' agregados',
			'datos' : $scope.datos,
			'fecha' : ('').hoy()

		};

		modalabrir('#mReffecha');
			
	};



	$scope.fechaelegida = function(){



		
		modalcerrar('#mReffecha');
			


		if($scope.fechaeve !=''){

			$scope.fech1= $scope.fech1.toLocaleDateString('en-US');
			}

					var peticion16 = {
						"url": "php/Cambios/agregaPosibleFecha.php",
						"method": "POST",
						"data": {

								 ideve: $scope.datos.id_evento_lugar,
								 fechaeve: $scope.fech1,
								
								}

						};	

					$http(peticion16).then(function(fuebien){
						
						alert('Cambio realizado correctamente');
						$scope.Eventos();

					}, function(fuemal){

						alert("Error al hacer la peticion");
					});



	};



	$scope.cerrarSesion = function(){


		var peticion22 = {
						"url": "php/Consultas/cerrarSesion.php",
						"method": "POST",
					

						};	

					$http(peticion22).then(function(fuebien){
						
						$location.path('/');
						$rootScope.user = {id:"", 
						nombre:"", apellido1:"", apellido2:"", 
						NIF:"", localidad:"", direccion:"", 
						provincia:"", email:"", fecha_sesion:"", 
						password:"", reservas:"", telefono:"", tipo:""};
						$rootScope.loading=true;
 						$rootScope.panelgest=false;
						
					}, function(fuemal){

						alert("Error al hacer la peticion");
					});

	};


	

	$scope.perfil = { id:'', nombre: '', apellido1: '', apellido2:'', NIF:'', email:'', telefono:'', direccion: '', localidad:'', provincia:'', password:'', tipo:''};
	
	$scope.perfilvisible=false;

	$scope.edPerfil = function(){
	$scope.perfil = { id:'', nombre: '', apellido1: '', apellido2:'', NIF:'', email:'', telefono:'', direccion: '', localidad:'', provincia:'', password:'', tipo:''};

	(['id', 'nombre', 'apellido1', 'apellido2', 'NIF', 'email', 'telefono', 'direccion', 'localidad', 'provincia', 'tipo']).forEach( function(valor, indice) {

				$scope.perfil[valor] = $rootScope.user[valor];
			
			});


	};

$scope.edPerfil();


$scope.editarPerfil = function(){
	$scope.perfilvisible=true;
	$scope.tiendavisible = false;
	$scope.productovisible = false;
	$scope.verportienda = false;
	$scope.verporcatego = false;
	$scope.eventovisible = false;
	$scope.eventousuvisible=false;
	$scope.productousuvisible=false;

$scope.edPerfil();
};



$scope.cambiarPerfil = function(){


	var peticion27 = {

		"url": "php/Cambios/cambiarUsuario.php",
	 	"method": "POST",
	 	"data": {idper: $scope.perfil.id,
	 			nombr: $scope.perfil.nombre,
				 ape1: $scope.perfil.apellido1,
				 ape2: $scope.perfil.apellido2,
				 ni: $scope.perfil.NIF,
				 emai: $scope.perfil.email,
				 telef: $scope.perfil.telefono,
				 direc: $scope.perfil.direccion,
				 loca: $scope.perfil.localidad,
				 provi: $scope.perfil.provincia,
				 passw: $scope.perfil.password,
				 tip:  $scope.perfil.tipo

				}

	};

$http(peticion27).then(function(fuebien){
		

			 $scope.actualizarDatos();
			alert('Cambio realizado correctamente');
			
		}, function(fuemal){

		alert('Cambio no realizado');
		
		});

	

};



$scope.actualizarDatos = function(){
     

	 var peticion30 = {
	 	"url": "php/Consultas/actualizarDato.php",
	 	"method": "POST",
	 	"data": {idper: $scope.perfil.id
				
				}

		};
		
	$http(peticion30).then(function(fuebien){
		
		 $rootScope.user = fuebien.data;
		
		

			
		}, function(fuemal){


		});


};


$scope.productousuvisible=false;
$scope.verlosproductos = function(){

	$scope.productousuvisible=true;
	$scope.eventovisible = false;
	$scope.productovisible = false;
	$scope.verportienda = false;
	$scope.verporcatego = false;
	$scope.tiendavisible = false;
	$scope.perfilvisible=false;
	$scope.eventousuvisible=false;

};




$scope.buscarxFechaprodu = function (){

	var peticion31 = {
		"url": "php/Consultas/verReservaProducto.php",
		"method": "POST",
		"data": {fecha1: $("#fecha1p").val(),
				 fecha2 : $("#fecha2p").val()
				}

		};

	$http(peticion31).then(function(fuebien){

		$scope.listap = fuebien.data;
		$scope.listaproducto = angular.copy($scope.listap);
		

	}, function(fuemal){

		alert("Error al hacer la peticion");
	});
};


$scope.buscarxFechaprodu();


$scope.eventousuvisible=false;

$scope.verloseventos = function(){

	$scope.eventousuvisible=true;
	$scope.eventovisible = false;
	$scope.productovisible = false;
	$scope.verportienda = false;
	$scope.verporcatego = false;
	$scope.tiendavisible = false;
	$scope.perfilvisible=false;
	$scope.productousuvisible=false;

};


	$scope.buscarxFechaevent = function(){

		var peticion32 = {
		"url": "php/Consultas/verReservaEvento.php",
		"method": "POST",

		"data": {fecha1e: $("#fecha1e").val(),
				 fecha2e : $("#fecha2e").val()
				}

		};

	$http(peticion32).then(function(fuebien){

		$scope.listae = fuebien.data;
		$scope.listaevento = angular.copy($scope.listae);
		

	}, function(fuemal){

		alert("Error al hacer la peticion");
	});


	};

	$scope.buscarxFechaevent();


}).filter('euros', function(){

	return function euros(texto, moneda){
		return parseFloat(texto).formato(moneda);
		};
}).filter('vfecha', function(){

	return function vfecha(texto){
		return (texto)? texto.fv():'';
	};
}).

component('listaArticulos', {
		templateUrl: 'pags/gestor.html',
		controller: 'tablactr'

});

