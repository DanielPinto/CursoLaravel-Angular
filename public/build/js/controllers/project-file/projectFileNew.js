angular.module('app.controllers')
    .controller('ProjectFileNewController',
    ['$scope','$location','$routeParams','appConfig','Url','Upload',
        function($scope,$location,$routeParams,appConfig,Url,Upload){


            $scope.save = function(){

            if($scope.form.$valid){

                var url = appConfig.baseUrl +
                    Url.getUrlFromAngularSymbol(appConfig.urls.projectFile,{
                        id:$routeParams.id,
                        idFile:''
                    });

                Upload.upload({
                    url: url,
                    fields: {

                        project_id: $routeParams.id,
                        name: $scope.projectFile.name,
                        description: $scope.projectFile.description,

                    },
                    file: $scope.projectFile.file

                }).then(function (data,status,headers,config) {


                    $location.path('/project/'+$routeParams.id+'/files');

                });


            }
        }

    }])