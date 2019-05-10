'use strict';

// Declare app level module which depends on views, and core components
angular.module('editar_contato', [
    'ngRoute',
    'editar_contato.edit'
]).
config(['$locationProvider', '$routeProvider', function($locationProvider, $routeProvider) {
    $locationProvider.hashPrefix('!');
    $routeProvider.otherwise({redirectTo: '/edit'});
}]);;
