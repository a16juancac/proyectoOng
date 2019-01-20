
//Función para llamar a las ventanas modales
var ventanamodal = function(ventana, boton){

var dialog = document.querySelector(ventana);
    
    dialogPolyfill.registerDialog(dialog);

    var dialogButton = document.querySelector(boton);
    dialogButton.addEventListener('click', function() {
        dialog.showModal();
      
    });
     
     dialog.querySelector('.close').addEventListener('click', function() {
     	dialog.show();
        dialog.close();
        

        
    });

};




var modalabrir = function(ventana){

	var dialog = document.querySelector(ventana);
    dialogPolyfill.registerDialog(dialog);
    dialog.showModal();
     dialog.querySelector('.close').addEventListener('click', function() {
        dialog.show();
        dialog.close();
    });
};

var modalcerrar = function(ventana){

	var dialog = document.querySelector(ventana);
	dialogPolyfill.registerDialog(dialog);
	dialog.show();
	dialog.close();

};





//Función para cerrar la ventana responsive cuando se de click en alguna opcion

var closeminiscreem = function(){
$('.mdl-layout__drawer').removeClass("is-visible");
$('.mdl-layout__drawer').attr("aria-hidden","true");
$('.mdl-layout__obfuscator').removeClass("is-visible");
};


//ANGULAR
var miApp = angular.module('ongApp',['ngRoute','gestor', 'producto', 'evento', 'administrador', 'cliente', 'home']);

// 'ngRoute'

//**Segundo pago**:Creamos el controlaro
miApp.controller('mainCtrl', function($scope, $http, $location, $rootScope){

$rootScope.loading=true;


})

.constant('vistaext', '.html').config(function($routeProvider, $locationProvider, vistaext){
   $locationProvider.hashPrefix('');
    $routeProvider
    	.when('/', {

            templateUrl :'pags/home' + vistaext,
             controller : 'homectr'
        })
        .when('/home', {

            templateUrl :'pags/home' + vistaext,
            controller : 'homectr'
        }).when('/tienda', {

        	templateUrl : 'pags/tienda' + vistaext,
        	controller : 'productoctr'
        }).when('/evento', {
        	templateUrl : 'pags/evento' + vistaext,
        	controller : 'eventoctr'
        }).when('/gestor', {
        	templateUrl : 'pags/gestor' + vistaext,
        	controller : 'gestorctr',
        	gestor: 2

        }).when('/administrador', {
        	templateUrl : 'pags/administrador' + vistaext,
        	controller : 'administradorctr',
        	administrador: 1
        }).when('/cliente', {
        	templateUrl : 'pags/cliente' + vistaext,
        	controller : 'clientectr',
        	cliente: 3
        })
        .otherwise({
        	redirectTo:'/'
        });

});


//Controlador del login

miApp.controller('loginCtr', function($scope, $http, $location, $rootScope){


$rootScope.user = {id:"", nombre:"", apellido1:"", apellido2:"", NIF:"", localidad:"", direccion:"", 
provincia:"", email:"", fecha_sesion:"", password:"", reservas:"", telefono:"", tipo:""};


//Restringir el acceso a las urls si no esta logeado
$rootScope.$on('$routeChangeStart', function (event, next) {
        
        var usuariotipo =  $rootScope.user.tipo;

        if (usuariotipo != 2 && next.gestor) {
   
            $location.path('/');
        }

   		 if (usuariotipo != 1 && next.administrador) {
  

            $location.path('/');
        }

        if(usuariotipo != 3 && next.cliente) {
  

            $location.path('/');
        }



    });





$scope.login = function(){
     


var peticion = {
	 	"url": "php/Consultas/login.php",
	 	"method": "POST",
	 	"data": {usu: $scope.usuario.email,
				 pass: $scope.usuario.password
				}

		};
		
	$http(peticion).then(function(fuebien){

		 $rootScope.user = fuebien.data;
		
//Se controla que coincida el email y se obtenga como corresta la contraseña
if($scope.usuario.email == $rootScope.user.email && $rootScope.user.password == 'ok'){

		

		 	if($rootScope.user.tipo == 1){
			$rootScope.loading=false;
 			$rootScope.paneladmi = true;
			$location.path('/administrador');
			 modalcerrar('.logearse');

			}
			else if ($scope.user.tipo == 2){
			$rootScope.loading=false;
 			$rootScope.panelgest =true;

			$location.path('/gestor');
			 modalcerrar('.logearse');
			}
			else
			{ 	$rootScope.loading=false;
			
			$rootScope.panelcliente =true;
			 modalcerrar('.logearse');
			 alert('Usuario correctamente logeado');
			}

		 }else{


			alert ('Datos incorrectos');
							}
		 
	
			
		}, function(fuemal){
		$scope.usuario.email='';
		$scope.usuario.password = "";
         alert ('Problemas de conexión, intentelo más tarde');



		});
		

};

	 

});


//Controlador del registro de usuarios
miApp.controller('registroCtr', function($scope, $http, $location, $rootScope){


$scope.usuario= { nombre:'', apellido1:'', apellido2: '', nif:'', telefono: '', direccion:'', localidad:'', provincia:'', email:'', pasword:'', repitepassword:''};


$scope.registrarse = function(){

if($scope.usuario.password == $scope.usuario.repitepassword){


	var peticion2 = {

		"url": "php/Cambios/agregarUsuario.php",
	 	"method": "POST",
	 	"data": {nombr: $scope.usuario.nombre,
				 ape1: $scope.usuario.apellido1,
				 ape2: $scope.usuario.apellido2,
				 ni: $scope.usuario.nif,
				 telef: $scope.usuario.telefono,
				 direc: $scope.usuario.direccion,
				 loca: $scope.usuario.localidad,
				 provi: $scope.usuario.provincia,
				 emai: $scope.usuario.email,
				 passw: $scope.usuario.password

				}



	};

$http(peticion2).then(function(fuebien){
		
		$scope.usuregi = fuebien.data;
		modalcerrar('.registro');

		if($scope.usuregi=='ok'){

			alert('Usuario correctamente registrado');
		}


			
		}, function(fuemal){

		alert('Usuario no registrado');
		modalcerrar('.registro');
		});
		

	}


$scope.usuario= { nombre:'', apellido1:'', apellido2: '', nif:'', telefono: '', direccion:'', localidad:'', provincia:'', email:'', pasword:'', repitepassword:''};

};





});

//Jquery para las modales

$(function () {


//Ocultar la ventana cuando se da click al boton
	$(".home").click(function(){
		closeminiscreem();
	});
	$(".minlogin").click(function(){
		closeminiscreem();
	});

	$(".tienda").click(function(){
		closeminiscreem();
	});
	$(".eventos").click(function(){
		closeminiscreem();
	});
	$(".minregistrarse").click(function(){
		closeminiscreem();
	});
	$(".xboton").click(function(){
		closeminiscreem();
	});


//Ventana modal boton login pantalla completa
 	ventanamodal('.logearse', '.login');

//Ventana modal boton login pantalla pequeña

    ventanamodal('.logearse', '.minlogin');

//Ventana modal boton registrarse pantalla completa

	ventanamodal('.registro', '.registrarse');

//Ventana modal boton registrarse pantalla pequeña

    ventanamodal('.registro', '.minregistrarse');


});

