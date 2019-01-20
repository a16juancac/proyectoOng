var miApp = angular.module('cliente',[]);

//Creamos el controlador de panel cliente
miApp.controller('clientectr', function($scope, $http, $rootScope, $location){





$scope.cerrarSesion = function(){


		var peticion22 = {
						"url": "php/Consultas/cerrarSesion.php",
						"method": "POST",
	
						};	

					$http(peticion22).then(function(fuebien){
						
						$location.path('/');
						$rootScope.user =  {id:"", 
						nombre:"", apellido1:"", apellido2:"", 
						NIF:"", localidad:"", direccion:"", 
						provincia:"", email:"", fecha_sesion:"", 
						password:"", reservas:"", telefono:"", tipo:""};
						$rootScope.loading=true;
 						$rootScope.panelcliente=false;
						
						
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


$scope.productousuvisible=true;
$scope.verlosproductos = function(){

	$scope.productousuvisible=true;
	$scope.perfilvisible=false;
	$scope.eventousuvisible=false;

};


$scope.buscarxFechaprodu = function (){

	var peticion31 = {
		"url": "php/Consultas/verReservaProducto.php",
		"method": "POST",

		"data": {fecha1: $("#fecha1pc").val(),
				 fecha2 : $("#fecha2pc").val(),
				 usu: $rootScope.user.id
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
	$scope.perfilvisible=false;
	$scope.productousuvisible=false;

};


	$scope.buscarxFechaevent = function(){

		var peticion32 = {
		"url": "php/Consultas/verReservaEvento.php",
		"method": "POST",

		"data": {fecha1e: $("#fecha1ec").val(),
				 fecha2e : $("#fecha2ec").val(),
				 usu: $rootScope.user.id
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
		templateUrl: 'pags/administrador.html',
		controller: 'tablactr'

});

 
