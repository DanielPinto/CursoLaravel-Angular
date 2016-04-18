angular.module('app.controllers')
    .controller('HomeController',['$scope','$cookies',function($scope,$cookies){

        'Estamos logado';
       // console.log($cookies.getObject('user').email);
    }]);