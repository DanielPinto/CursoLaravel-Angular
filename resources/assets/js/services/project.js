angular.module('app.services')
    .service('Project',['$resource','$filter','appConfig',
        function($resource,$filter,appConfig){
            return $resource(appConfig.baseUrl + '/projects/:id',{id: '@id'},
                {
                    get:{
                        method: 'GET',
                        transformResponse: function(data,headers){
                            var trans = appConfig.utils.transformResponse(data,headers);
                            if(angular.isObject(trans) && trans.hasOwnProperty('due_date')){

                                var arrayDate = trans.due_date.split('-');
                                month = parseInt(arrayDate['1']-1);
                                trans.due_date = new Date(arrayDate[0],month,arrayDate[2]);
                            }
                            return trans;
                        }
                   },

                   query:{
                     isArray : false
                   },


                    update: {
                      method: 'PUT'

                    },
                    projectsMember: {
                      url: appConfig.baseUrl + '/projects-member',
                      method: 'GET'
                    }


                    /* subscreve o metodo save para formatar a data antes de enviar apara a API

                     continu a configura��o no arquivo app.js


                     save:{
                     method:'POST',
                     transformRequest: function(data){
                     if(angular.isObject(data) && data.hasOwnProperty('due_date')){
                     var o = angular.copy(data);
                     o.due_date = $filter('date')(data.due_date,'yyyy-MM-dd');
                     return appConfig.util.transformRequest(o);
                     }

                     return data;
                     }
                     },
                     */

            });
    }]);
