var app = angular.module("blogApp");

app.controller("sideNavCtrl", function(articleService, userService){

}).controller("mainBlogCtrl", function(articleService, userService){
    this.articleList = articleService.listArticles()
        .then(function(response){
            console.log(response);
        }, function(response){
            console.log(response);
        });
}).controller("singleReadCtrl", function(articleService, userService){

});


app.directive("sideNav", function(){
    return {
        restrict: "AE",
        templateUrl: "../views/sideNav.html",
        controller: "sideNavCtrl",
        controllerAs: "snc"
    }
});