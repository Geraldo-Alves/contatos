'use strict';

angular.module('editar_contato.edit', ['ngRoute'])

    .service('contatoService', function($http){
        this.getContato = function(id){
            var url = '/api/contato/'+id;
            var promise = $http.get(url);
            return promise;
        };
    })
    .service('saveContatoService', function($http){
        this.saveContato = function(id, nome, email, telefone){

            var params = {nome: nome, email: email, telefone: telefone};

            var url = '/api/contato/'+id;

            var promise = $http.post(url, params);
            return promise;
        };
    })
.config(['$routeProvider', function($routeProvider) {
  $routeProvider.when('/edit', {
    templateUrl: '/js/components/edit.html',
    controller: 'View1Ctrl'
  });
}])
.controller('View1Ctrl', function($scope, contatoService, saveContatoService) {

    var query = window.location.search.substring(1);
    var qs = (query);
    var split =  qs.split("=");

    $scope.id = split[1];

    $scope.$watch('id', function(id) {
        fetch(id);
    });

    function fetch(id){
        var promise = contatoService.getContato(id);
        promise.then(function(response){
            $scope.nome = response.data.data['nome'];
            $scope.email = response.data.data['email'];
            $scope.telefone = response.data.data['telefone'];
            $scope.id_contato = response.data.data['id'];
        });
    };

    $scope.save = function() {
        var promise = saveContatoService.saveContato($scope.id_contato, $scope.nome, $scope.email, $scope.telefone);
        promise.then(function(response){
            alert(response.data.data);
        });

    }
});