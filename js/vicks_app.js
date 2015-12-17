var vicks_app = angular.module('vicks_app', ['ngRoute']);

vicks_app.config(['$routeProvider',

    // $routeProvider used to load proper template in index.html
    function ($routeProvider) {
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
            .when('/edit-profile', {
                templateUrl: 'views/userEdit.html'

            })
            .otherwise({
                redirectTo: '/login'
            });
    }]);
