var app = angular.module("blogApp");

app.controller("mainBlogCtrl", function (articleService, userService) {
    var mbc = this;
    mbc.articleList = [];
    articleService.listArticles().then(function (response) {
        //PUSH to articleList so saved in array
        mbc.articleList.push(response);
    });


}).controller("singleReadCtrl", function (articleService, userService) {

});


app.controller("sideNavCtrl", function (articleService, userService) {

}).directive("sideNav", function () {
    return {
        restrict: "AE",
        templateUrl: "../views/sideNav.html",
        controller: "sideNavCtrl",
        controllerAs: "snc"
    }
});