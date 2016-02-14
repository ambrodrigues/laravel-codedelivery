angular.module('starter.controllers')

.controller('DeliverymanViewOrderCtrl',[
    '$scope',
    '$stateParams',
    'DeliverymanOrder',
    '$ionicLoading',
    '$cordovaGeolocation',
    '$ionicPopup',
    function($scope,$stateParams,DeliverymanOrder,$ionicLoading,$cordovaGeolocation,$ionicPopup){

    var watch;

    $scope.order = [];

    $ionicLoading.show({
        template: 'Carregando...'
    });

        DeliverymanOrder.get({id : $stateParams.id, include : 'items,cupom'},function(data){
        $scope.order = data.data;

        $ionicLoading.hide();
    },function(){
        $ionicLoading.hide();
    });

    $scope.goToDelivery = function(){

        $ionicPopup.alert({
            title : 'Alerta',
            template: 'Para cancelar o envio de localizacao, clique em OK.'
        }).then(function(){
            stopWatchPosition();
        });


        DeliverymanOrder.updateStatus({id : $stateParams.id}, {status : 1},function(){
            var watchOptions = {
                timeout : 3000,
                enableHighAccuracy  :false
            }

            watch = $cordovaGeolocation.watchPosition(watchOptions);

            watch.then(null,
                function(responseError){

            },function(position){
                DeliverymanOrder.geo({id : $stateParams.id,
                    lat : position.coords.latitude,
                    long: position.coords.longitude
                });
            });
        });
    };

        function stopWatchPosition(){
            if (watch && typeof watch == 'object' && watch.hasOwnProperty('watchID')){
                $cordovaGeolocation.clearWatch(watch.watchID);
            }
        }

}]);