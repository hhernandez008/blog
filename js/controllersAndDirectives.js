var app = angular.module("blogApp");

app.controller("mainBlogCtrl", function (articleReadService, articleEditService, userService, dummyData) {
    var mbc = this;
    //store the full array of articles in the article service
    articleReadService.articleList = [];
    articleReadService.listArticles().then(function (response) {
        articleReadService.articleList = dummyData.articleList;
        //PUSH to articleList so saved in array; WAS AN OBJECT
        //articleService.articleList.push(response);
    }, function(response){
        console.log("list articles failed: ", response);
    });

    //for view to display article list array
    mbc.returnArticleList = function(){
        return articleReadService.articleList;
    };

    mbc.readFullArticle = function(data){
        //console.log("readFullArt", data);
        if(userService.authToken.length > 0){
            data = {
                id: data,
                auth_token: userService.authToken
            };
        }
        articleReadService.readFullArticle(data)
            .then(function(response){
                articleReadService.currentArticle[0] = (response);
            });
    }

}).controller("fullArticleCtrl", function (articleReadService, articleEditService, userService, dummyData) {
        this.currentArticle = articleReadService.returnCurrentArticle;
});


app.controller("sideNavCtrl", function (articleReadService, articleEditService, userService, dummyData) {
    var snc = this;

    articleReadService.listArticles().then(function (response) {
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
        var articles = articleReadService.articleList;
        var tags = articleReadService.tags;
        for(var i = 0; i < articles.length; i++){
            if(i == 0 && tags.length < 1){
                for(tag in articles[i].tags){
                    tags.push(articles[i].tags[tag]);
                }
            }else{
                for(tag in articles[i].tags){
                    if(tags.indexOf(articles[i].tags[tag]) == -1){
                        tags.push(articles[i].tags[tag]);
                    }
                }
            }
        }
        return tags;
    }


}).directive("sideNav", function () {
    return {
        restrict: "AE",
        templateUrl: "views/sideNav.html",
        controller: "sideNavCtrl",
        controllerAs: "snc"
    }
});