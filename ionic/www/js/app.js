// Ionic Starter App

// angular.module is a global place for creating, registering and retrieving Angular modules
// 'starter' is the name of this angular module example (also set in a <body> attribute in index.html)
// the 2nd parameter is an array of 'requires'

angular.module('starter.controllers',[]);
angular.module('starter.services',[]);
angular.module('starter.filters',[]);

//ionic add ionic-platform-web-client   para ativar push

//ionic plugin add phonegap-plugin-push

//ionic io init

//ionic config set dev_push true

angular.module('starter', [
    'ionic',
    'ionic.service.core',
    'starter.controllers',
    'starter.services',
    'starter.filters',
    'angular-oauth2',
    'ngResource',
    'ngCordova',
    'uiGmapgoogle-maps',
    'pusher-angular'
])


.constant('appConfig',{
    baseUrl: 'http://localhost:8000',
    pusherKey :'65f29e97a37f0afd980a'
})

.run(function($ionicPlatform,$window,appConfig,$localStorage) {
    $window.client = new Pusher(appConfig.pusherKey);

  $ionicPlatform.ready(function() {

    if(window.cordova && window.cordova.plugins.Keyboard) {
      // Hide the accessory bar by default (remove this to show the accessory bar above the keyboard
      // for form inputs)
      cordova.plugins.Keyboard.hideKeyboardAccessoryBar(true);

      // Don't remove this line unless you know what you are doing. It stops the viewport
      // from snapping when text inputs are focused. Ionic handles this internally for
      // a much nicer keyboard experience.
      cordova.plugins.Keyboard.disableScroll(true);
    }
    if(window.StatusBar) {
      StatusBar.styleDefault();
    }

      Ionic.io();

      var push  = new Ionic.Push({
          debug : true,

          onNotification: function(message){
              console.log(message);
          }
      });

      push.register(function(token){
          console.log(token.token);
        $localStorage.set('device_token',token.token);
      });

  });
})

.config(function($stateProvider,$urlRouterProvider,OAuthProvider,OAuthTokenProvider,appConfig,$provide){


    OAuthProvider.configure({
        baseUrl: appConfig.baseUrl,
        clientId: '1',
        clientSecret: '1234', // optional,
        grantPath: '/oauth/access_token'
    });

    OAuthTokenProvider.configure({
        name: 'token',
        options: {
            secure: false //passar para true se https
        }
    });

    $stateProvider
        .state('login',{
           url :'/login',
           templateUrl:'templates/login.html',
           controller: 'loginCtrl'
         })
        .state('home',{
           url :'/home',
           templateUrl:'templates/home.html',
           controller: function($scope){

           }
         })
        .state('client',{
            abstract: true,
            cache : false,
            url : '/client',
            templateUrl: 'templates/client/menu.html',
            controller : 'ClientMenuCtrl'
        })
        .state('client.order',{
            url: '/order',
            templateUrl : 'templates/client/order.html',
            controller: 'ClientOrderCtrl'
        })
        .state('client.view_order',{
            url: '/view_order/:id',
            templateUrl : 'templates/client/view_order.html',
            controller: 'ClientViewOrderCtrl'
        })
        .state('client.view_delivery',{
            cache : false,
            url: '/view_delivery/:id',
            templateUrl : 'templates/client/view_delivery.html',
            controller: 'ClientViewDeliveryCtrl'
        })
        .state('client.checkout',{
            cache : false,
            url: '/checkout',
            templateUrl : 'templates/client/checkout.html',
            controller: 'ClientCheckoutCtrl'
        })
        .state('client.checkout_item_detail',{
            url: '/checkout/detail/:index',
            templateUrl : 'templates/client/checkout_item_detail.html',
            controller: 'ClientCheckoutDetailCtrl'
        })
        .state('client.checkout_successful',{
            cache : false,
            url: '/checkout/successful',
            templateUrl : 'templates/client/checkout_successful.html',
            controller: 'ClientCheckoutSuccessfulCtrl'
        })
        .state('client.view_products',{
            url: '/view_products',
            templateUrl : 'templates/client/view_products.html',
            controller: 'ClientViewProductCtrl'
        })
        .state('deliveryman',{
            abstract: true,
            cache : false,
            url : '/deliveryman',
            templateUrl: 'templates/deliveryman/menu.html',
            controller : 'DeliverymanMenuCtrl'
        })
        .state('deliveryman.order',{
            url: '/order',
            templateUrl : 'templates/deliveryman/order.html',
            controller: 'DeliverymanOrderCtrl'
        })
        .state('deliveryman.view_order',{
            cache : false,
            url: '/view_order/:id',
            templateUrl : 'templates/deliveryman/view_order.html',
            controller: 'DeliverymanViewOrderCtrl'
        });

  $urlRouterProvider.otherwise('/login');

    /**
     * provide
     * para dar suporte em localStorage no OAuth2
     *
     * por padrao a biblioteca trabalha com cookies. e isso nao tem mais suporte
     * no cordova, por isso precisa ser sobreescrito o objeto para dar suporte
     * em localStorage
     */

    $provide.decorator('OAuthToken',['$localStorage','$delegate',function($localStorage,$delegate){
        Object.defineProperties($delegate,{
            setToken: {
                value : function(data){
                    $localStorage.setObject('token',data);
                },
                enumerable   : true,
                configurable : true,
                writable     : true
            },
            getToken: {
                value : function(){
                    return $localStorage.getObject('token');
                },
                enumerable   : true,
                configurable : true,
                writable     : true
            },
            removeToken: {
                value : function(){
                    $localStorage.setObject('token', null);
                },
                enumerable   : true,
                configurable : true,
                writable     : true
            }
        });
        return $delegate;
    }]);

})
