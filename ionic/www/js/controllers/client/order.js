angular.module('starter.controllers')

.controller('ClientOrderCtrl',[
    '$scope',
    '$state',
    '$ionicLoading',
    'ClientOrder',
    '$ionicActionSheet',
    function($scope,$state,$ionicLoading,ClientOrder,$ionicActionSheet) {

        $scope.items = [];

        $ionicLoading.show({
            template: 'Carregando...'
        });


        $scope.doRefresh = function(){
            getOrders().then(function (data) {
                $scope.items = data.data;
                $scope.$broadcast('scroll.refreshComplete');
            }, function () {
                $scope.$broadcast('scroll.refreshComplete');
            });
        };

        $scope.openOrderDetail = function(order){

            $state.go('client.view_order',{id : order.id});
        }


        $scope.showActionSheet = function(order){
            $ionicActionSheet.show({
                buttons : [
                    {text : 'Ver Detalhes'},
                    {text : 'Ver Entrega'}
                ],
                tittleText : 'O que fazer?',
                cancelText : 'Cancelar',
                cancel : function(){

                },
                buttonClicked : function(index){
                    switch (index){
                        case 0 :
                            $state.go('client.view_order',{id : order.id});
                            break;
                        case 1 :
                            $state.go('client.view_delivery',{id : order.id});
                            break;
                    }
                }

            });
        };


        /**
         * a ordenacao eh um recurso do l5-repository
         * do PushCriteria do repository
         */

        function getOrders() {
            return ClientOrder.query({
                id: null,
                orderBy: 'created_at',
                sortedBy: 'desc'
            }).$promise;
        };

        getOrders().then(function (data) {
                $scope.items = data.data;

                $ionicLoading.hide();
            }, function () {
                $ionicLoading.hide();
        });

}]);