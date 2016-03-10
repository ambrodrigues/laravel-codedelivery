angular.module('starter.run').run(['PermissionStore','OAuth',function(PermissionStore,OAuth){
    PermissionStore.definePermission('user-permission',function(){
        return OAuth.isAuthenticated();;
    });
}]);
