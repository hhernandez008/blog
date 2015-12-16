var app = angular.module("blogApp");

app.controller("sideNavCtrl", function(getBlogData){



});


app.directive("sideNav", function(){
    return {
        restrict: "AE",
        templateUrl: "../views/sideNav.html",
        controller: "sideNavCtrl",
        controllerAs: "snc"
    }
});