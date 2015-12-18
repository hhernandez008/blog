var app = angular.module("blogApp");

app.controller("mainBlogCtrl", function (articleService, userService, dummyData) {
    var mbc = this;
    //store the full array of articles in the article service
    articleService.articleList = [];
    articleService.listArticles().then(function (response) {
        articleService.articleList = dummyData.articleList;
        //PUSH to articleList so saved in array; WAS AN OBJECT
        //articleService.articleList.push(response);
    }, function(response){
        console.log("list articles failed: ", response);
    });

    //for view to display article list array
    mbc.returnArticleList = function(){
        return articleService.articleList;
    }


}).controller("singleReadCtrl", function (articleService, userService, dummyData) {

});


app.controller("sideNavCtrl", function (articleService, userService, dummyData) {
    var snc = this;
    snc.lastFiveArticles = [];
    snc.tags = [];

    articleService.listArticles().then(function (response) {
        response = dummyData.articleList;
        if(response.length > 5){
            for(var i = 0; i <= 5; i++){
                snc.lastFiveArticles.push(response[i]);
            }
        }else{
            snc.lastFiveArticles = response;
        }
        //PUSH to articleList so saved in array; WAS AN OBJECT
        //mbc.articleList.push(response);
    }, function(response){
        console.log("list articles failed: ", response);
    });

    snc.tagList = function(){
        var articles = articleService.articleList;
        //articles[0].tags = ["cat", "blog", "fun"]
        for(var i = 0; i < articles.length; i++) {
            if(i == 0){
                for(tag in articles[i].tags){
                    snc.tags.push(articles[i].tags[tag]);
                }
            }else{
                for(tag in articles[i].tags){
                    if(snc.tags.indexOf(articles[i].tags[tag]) == -1){
                        snc.tags.push(articles[i].tags[tag]);
                    }
                }
            }
            console.log(snc.tags);
        }
        return snc.tags;
    }


}).directive("sideNav", function () {
    return {
        restrict: "AE",
        templateUrl: "views/sideNav.html",
        controller: "sideNavCtrl",
        controllerAs: "snc"
    }
});
