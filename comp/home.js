var miApp = angular.module('home',[]);

//Creamos el controlar de home
miApp.controller('homectr', function($scope, $location, $rootScope, $http){



$scope.registratehome = function(){

	modalabrir('.registro');
};


$scope.loginhome = function(){

	
modalabrir('.logearse');
};


}).

component('listaArticulos', {
		templateUrl: 'pags/home.html',
		controller: 'homectr'

});