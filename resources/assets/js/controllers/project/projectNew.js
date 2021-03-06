angular.module('app.controllers')
    .controller('ProjectNewController',
    ['$scope','$location','$routeParams','$cookies','Project','Client','appConfig',function(
        $scope,$location,$routeParams,$cookies,Project,Client,appConfig)
    {
        $scope.project = new Project();
        $scope.status = appConfig.project.status;


        $scope.due_date = {

            status:{
                opened:false
            }
        };

        $scope.open = function ($event) {
            $scope.due_date.status.opened = true;
        };


        $scope.formatName = function (model) {

            if(model){

                return model.nome;
            }

            return '';

        };


        $scope.getClients = function (nome) {

            return Client.query({
                search: nome,
                searchFields: 'nome:like'

            }).$promise;
        };

        $scope.selectClient = function (item) {
            $scope.project.client_id = item.id;
        };


        $scope.save = function(){

            if($scope.form.$valid){
                $scope.project.user_id = $cookies.getObject('user').id;
                $scope.project.$save().then(function(){
                    $location.path('/projects/');
                });
            }
        };

    }]);