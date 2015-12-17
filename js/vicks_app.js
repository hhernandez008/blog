var vicks_app = angular.module('vicks_app', ['ngRoute']);

vicks_app.config(['$routeProvider',

    // $routeProvider used to load proper template in index.html
    function ($routeProvider) {
<<<<<<< HEAD
        $routeProvider
            .when("/", {
                templateUrl: "views/mainBlog.html"
            })
            .when('/login', {
                templateUrl: 'views/login.html'
            })
            .when('/register', {
                templateUrl: 'views/register.html'
            })
            .otherwise({
                redirectTo: '/login'
            });
    }]);
=======
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
>>>>>>> b4e4b56a001e3c7d50fd9dfe0b14d7aeb2572b47
