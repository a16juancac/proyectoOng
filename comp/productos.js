
var miApp = angular.module('producto',['ui.bootstrap', 'google-maps']);

//Factory para Google Maps
miApp.factory('MarkerCreatorService', function () {

    var markerId = 0;

    function create(latitude, longitude) {
        var marker = {
            options: {
                animation: 1,
                labelAnchor: "28 -5",
                labelClass: 'markerlabel'    
            },
            latitude: latitude,
            longitude: longitude,
            id: ++markerId          
        };
        return marker;        
    }
//Funciones del factory
    function invokeSuccessCallback(successCallback, marker) {
        if (typeof successCallback === 'function') {
            successCallback(marker);
        }
    }

    function createByCoords(latitude, longitude, successCallback) {
        var marker = create(latitude, longitude);
        invokeSuccessCallback(successCallback, marker);
    }

    function createByAddress(address, successCallback) {
        var geocoder = new google.maps.Geocoder();
        geocoder.geocode({'address' : address}, function (results, status) {
            if (status === google.maps.GeocoderStatus.OK) {
                var firstAddress = results[0];
                var latitude = firstAddress.geometry.location.lat();
                var longitude = firstAddress.geometry.location.lng();
                var marker = create(latitude, longitude);
                invokeSuccessCallback(successCallback, marker);
            } else {
                alert("Unknown address: " + address);
            }
        });
    }

    function createByCurrentLocation(successCallback) {
        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(function (position) {
                var marker = create(position.coords.latitude, position.coords.longitude);
                invokeSuccessCallback(successCallback, marker);
            });
        } else {
            alert('Unable to locate current position');
        }
    }

    return {
        createByCoords: createByCoords,
        createByAddress: createByAddress,
        createByCurrentLocation: createByCurrentLocation
    };

});


//Controlador de productos de la tienda
miApp.controller('productoctr', function (MarkerCreatorService, $scope, $http, $rootScope, $location) {

	$scope.tiendas = function(){

	var peticion1 = {
		"url": "php/Consultas/vertienda.php",
		"method": "POST"
		};

	$http(peticion1).then(function(fuebien){

		$scope.tiendas = fuebien.data;
	




	}, function(fuemal){

		alert("Error al hacer la peticion");
	});
	
	$scope.lasCategorias();
	};

	$scope.lasCategorias =function(){
		var peticion2 = {
		"url": "php/Consultas/verCategoria.php",
		"method": "POST"
		};


		$http(peticion2).then(function(fuebien){

		$scope.categorias = fuebien.data;

		}, function(fuemal){

		alert("Error al hacer la peticion");
		});

	};

	

	//Llamamos a la función para ver las tiendas
	$scope.tiendas();


	$scope.productosv = function(){
		var peticion3 = {
		"url": "php/Consultas/verProductos.php",
		"method": "POST",
		"data": {usu: true}


		};
		

	$http(peticion3).then(function(fuebien){

		$scope.product = fuebien.data;
		$scope.productos = angular.copy($scope.product);

	

	}, function(fuemal){

		alert("Error al hacer la peticion");
	});


	};

	$scope.productosv();
	




	catevisible = false;
	$scope.verproductos = function (){

		this.catevisible = true;
		id = this.tienda.id;
		$scope.id_tienda = id;
		var peticion3 = {
			"url": "php/Consultas/verProductos.php",
			"method": "POST",
			"data": {idti: $scope.id_tienda,
					 usu: true				}

			};
		

	$http(peticion3).then(function(fuebien){

		$scope.product = fuebien.data;
		$scope.productos = angular.copy($scope.product);
	

	}, function(fuemal){

		alert("Error al hacer la peticion");
	});



};


//Enlace para ver los los productos por categoría
$scope.verxCategoria = function (){
	id = this.tienda.id;
	categori = this.categoria.id;

	$scope.id_tiend = id;
	$scope.id_catego = categori;
	var peticion4 = {
		"url": "php/Consultas/verProductos.php",
		"method": "POST",

		"data": {idti: $scope.id_tiend,
				idcate : $scope.id_catego,
				usu : true
				}

		};
		

	$http(peticion4).then(function(fuebien){

		$scope.productos = fuebien.data;

	

	}, function(fuemal){

		alert("Error al hacer la peticion");
	});



};

//Boton para mostrar las categorías
	
	 verlista=false;
	$scope.mostrarLista = function(){
		this.verlista = !this.verlista;

	};

//Ventana modal de carrusel

	$scope.modalprodu = function(){

		modalabrir('.produmodal');

		$scope.produ=this.producto;
		var matriz=[];
		(this.producto.imagen).forEach( function(valor, indice) {
			//Almacenamos los valores en la variable img
			var img ={image : valor.ruta};
			//Añadimos los valores a la matriz
			matriz.push(img);
		});
		
		//Carrusel con angular
		$scope.myInterval = 2000;
	
	  	$scope.slides = matriz;
	    // {
	    //   image: 'img/bd/beatles.jpg'
	    // },
	    // {
	    //   image: 'img/bd/camisa.jpg'
	    // },

	};

	
	$scope.ubicacion = function(){

			modalabrir('.ubicacion');

				$scope.tiend = this.tienda;

				MarkerCreatorService.createByCoords($scope.tiend.latitud, $scope.tiend.longitud, function (marker) {
            	marker.options.labelContent = 'Tienda ' + $scope.tiend.nombre;
            	$scope.autentiaMarker = marker;
       		 });
        
        	$scope.address = '';

	        $scope.map = {
	            center: {
	                latitude: $scope.autentiaMarker.latitude,
	                longitude: $scope.autentiaMarker.longitude
	            },
	            zoom: 12,
	            markers: [],
	            control: {},
	            options: {
	                scrollwheel: false
	            }
       		 };

        	$scope.map.markers.push($scope.autentiaMarker);



		};

			var latitud =42.2358184;
			var longitud = -8.719340500000044;


	 		MarkerCreatorService.createByCoords(latitud, longitud, function (marker) {
	            marker.options.labelContent = 'Tienda';
	            $scope.autentiaMarker = marker;
	        });
	        
	        $scope.address = '';

	        $scope.map = {
	            center: {
	                latitude: $scope.autentiaMarker.latitude,
	                longitude: $scope.autentiaMarker.longitude
	            },
	            zoom: 12,
	            markers: [],
	            control: {},
	            options: {
	                scrollwheel: false
	            }
	        };

	        $scope.map.markers.push($scope.autentiaMarker);

	       

	       //Reservas


	        $scope.cantidad=1;

	         $scope.reservar = function(){

	        	$scope.produreser = this.producto;
	        	$scope.canti	 = this.cantidad;


	        	if(!$scope.canti || $scope.canti<1){

	        		alert("La cantidad introducida no es valida");
	        
	        	}

	        	else if($scope.canti > $scope.produreser.stock){

	        		alert("La cantidad introducida es superior a la ofrecida");

	        	}

	        	else{
	        	 	if($rootScope.user.tipo !='3'){

	        		alert ('Necesita logearse como cliente');

	        		modalabrir('.logearse');

	        					 }
	        	 	else{

	        		var peticion6 = {
						"url": "php/Cambios/reservaProdu.php",
						"method": "POST",
						"data": {idusu: $rootScope.user.id,
								 idprodu: $scope.produreser.id,
								 idtien: $scope.produreser.tienda[0].id,
								 cant: $scope.canti,
								 preci: $scope.produreser.precio,
								 idproduti: $scope.produreser.id_producto_tienda

								}

						};
						

					$http(peticion6).then(function(fuebien){
						$scope.productosv();
						alert('Reserva realizada');
						
					
					}, function(fuemal){

						alert("Error al hacer la peticion");
					});

	        			 }



	 			}


	        };




}).filter('euros', function(){

	return function euros(texto, moneda){
		return parseFloat(texto).formato(moneda);
		};
}).component('listaArticulos', {
		templateUrl: 'pags/tienda.html',
		controller: 'productoctr'

});

