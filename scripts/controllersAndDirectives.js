var app = angular.module("blogApp");

app.controller("sideNavCtrl", function(){

});


app.directive("sideNav", function(){
    return {
        restrict: "AE",
        templateUrl: "../html/sideNav.html",
        controller: "sideNavCtrl"
    }
});