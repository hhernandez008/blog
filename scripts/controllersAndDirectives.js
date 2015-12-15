var app = angular.module("blogApp");

app.controller("sideNavCtrl", function(getBlogData){
    getBlogData.createArticle({title: "art1"});


});


app.directive("sideNav", function(){
    return {
        restrict: "AE",
        templateUrl: "../html/sideNav.html",
        controller: "sideNavCtrl",
        controllerAs: "snc"
    }
});