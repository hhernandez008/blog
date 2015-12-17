var vicks_app = angular.module('vicks_app', ['ngRoute']);

vicks_app.config(['$routeProvider',
                 
    // $routeProvider used to load proper template in index.html
    function ($routeProvider) {
        $routeProvider.
        when('/views/login', {
            templateUrl: 'views/login.html',
            
        }).
        when('/views/register', {
            templateUrl: 'views/register.html',
           
        }).
        when('/views/edit-profile', {
            templateUrl: 'views/userEdit.html',
           
        }).
        otherwise({
            redirectTo: '/views/login'
        });
}]);