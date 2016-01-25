angular.module('starter.controllers')
.controller('loginCtrl',['$scope','OAuth','$ionicPopup','$state',function($scope,OAuth,$ionicPopup,$state){

    $scope.user = {
        username : '',
        password : ''
    };

    $scope.login = function(){
        OAuth.getAccessToken($scope.user).then(function(data){

           $state.go('client.checkout');

        },function(responseError){
            alert(responseError.statusText);
            $ionicPopup.alert({
                title : 'Alerta',
                template: 'Login e/ou senha inválidos'
            });
        });
    };

}]);