
var miApp = angular.module('evento',[]);

//Creamos el controlador de evento
miApp.controller('eventoctr', function($scope, $http, $rootScope, $location){

//Petición para mostrar todos los eventos

$scope.eventosv = function(){

	var peticion1 = {
		"url": "php/Consultas/verEventos.php",
		"method": "POST",
		"data" : {all:false
				}
		};
		

	$http(peticion1).then(function(fuebien){

		$scope.event = fuebien.data;
		$scope.eventos = angular.copy($scope.event);
		
	}, function(fuemal){

		alert("Error al hacer la peticion");
	});	


};

//Mostrar eventos al cargar la pagina
$scope.eventosv();


$scope.buscarxFecha = function (){
	

	var peticion4 = {
		"url": "php/Consultas/verEventos.php",
		"method": "POST",
		"data": {	fecha1: $("#fechas1").val(),
					fecha2 : $("#fechas2").val(),
					all:true
				}

		};

	$http(peticion4).then(function(fuebien){

		$scope.eventos = fuebien.data;
		console.log($scope.eventos);
	

	}, function(fuemal){

		alert("Error al hacer la peticion");
	});
};


	$scope.cantidadeve=1;

	         $scope.reservareve = function(){

	        	$scope.evereser = this.evento;
	        	$scope.canti	 = this.cantidadeve;


	        	if(!$scope.canti || $scope.canti<1){

	        		alert("La cantidad introducida no es valida");
	        
	        	}

	        	else if($scope.canti > $scope.evereser.stock){

	        		alert("La cantidad introducida es superior a la ofrecida");

	        	}

	        	else{
	        	 	if($rootScope.user.tipo !='3'){

	        		alert ('Necesita logearse como cliente');

	        		modalabrir('.logearse');

	        					 }
	        	 	else{

	        		var peticion6 = {
						"url": "php/Cambios/reservaEvento.php",
						"method": "POST",
						"data": {idusu: $rootScope.user.id,
								 ideve: $scope.evereser.id,
								 cant: $scope.canti,
								 preci: $scope.evereser.precio

								}
						};
						

					$http(peticion6).then(function(fuebien){
						$scope.eventosv();
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
}).filter('vfecha', function(){

	return function vfecha(texto){
		return (texto)? texto.vf():'';
	};
}).component('listaEventos', {
		templateUrl: 'pags/evento.html',
		controller: 'eventoctr'

});