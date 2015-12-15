var app = angular.module("blogApp", []);

app.config(function($httpProvider){
    $httpProvider.defaults.headers.post["Content-Type"] = "application/x-www-form-urlencoded";
});



