angular.module('app.controllers')
    .controller('ProjectListController',[
        '$scope','$routeParams','Project',function($scope,$routeParams,Project){


    $scope.projects = [];
    $scope.totalProjects = 0;
    $scope.projectsPerPage = 4; // this should match however many results your API puts on one page


    $scope.pagination = {
        current: 1
    };

    $scope.pageChanged = function(newPage) {
        getResultsPage(newPage);
    };



    function getResultsPage(pageNumber) {
      Project.query({
        page: pageNumber
      },function(data){

            $scope.projects = data.data;
            $scope.totalProjects = data.total;

          });

        }


    	getResultsPage(1);

    }]);



    /*
// this is just an example, in reality this stuff should be in a service
        	$http.get('path/to/api/users?page=' + pageNumber)
           		.then(function(result) {
                	$scope.users = result.data.Items;
                	$scope.totalUsers = result.data.Count
            	});

    */
