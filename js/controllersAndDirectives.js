var app = angular.module("blogApp");

app.controller("mainCtrl", function(articleReadService, articleEditService, userService){
    this.readFullArticle = function(data){
        //console.log("readFullArt", data);
        if(userService.authToken.length > 0){
            data = {
                id: data,
                auth_token: userService.authToken
            };
        }else{
            data = { id: data }
        }
        articleReadService.readFullArticle(data)
            .then(function(response){
                //for storing response object in array for ngRepeat
                articleReadService.currentArticle[0] = (response);
            });
    };

    this.tagSearch = function(data){
        if(userService.authToken.length > 0){
            data = {
                tag: data,
                count: 10,
                auth_token: userService.authToken
            }
        } else {
            data = {
                tag: data,
                count: 10
            }
        }
        articleReadService.listArticles(data)
            .then(function(response){
                console.log(response);
                //response is object store in array for ngRepeat
                //empty array from previous search
                articleReadService.searchResponse = [];
                articleReadService.searchResponse.push(response);
            });
    };
}).controller("blogListCtrl", function (articleReadService, articleEditService, userService) {
    var blc = this;
    //store the full array of articles in the article service
    articleReadService.articleList = [];

    //make call to list articles
    if(userService.authToken.length > 0){
        console.log("list articles passed user_token");
        data = { auth_token: userService.authToken };
        articleReadService.listArticles(data).then(function (response) {
            console.log(response);
            articleReadService.articleList = response;
        }, function(response){
            console.log("list articles failed: ", response);
        });
    }else {
        articleReadService.listArticles().then(function (response) {
            console.log(response);
            articleReadService.articleList = response;
        }, function (response) {
            console.log("list articles failed: ", response);
        });
    }

    //for view to display article list array
    blc.returnArticleList = function(){
        return articleReadService.articleList;
    };

}).controller("fullArticleCtrl", function (articleReadService, articleEditService, userService) {
        this.currentArticle = articleReadService.returnCurrentArticle;
}).controller("searchCtrl", function(articleReadService, articleEditService, userService){
    //for view to display article list array
    this.returnSearchResponse = function(){
        console.log(articleReadService.searchResponse);
        return articleReadService.searchResponse;
    };
}).controller("newArticleCtrl", function(articleEditService, userService){
    var nac = this;
    nac.title = '';
    nac.text = '';
    nac.tags = '';
    nac.viewable = {name: "private"};

    var createTagArray = function(){
        var tagArray = [];
        tagArray.push(nac.tags);
        return tagArray;
    };

    this.postArticle = function(){
        var articleInfo = {};
        articleInfo.title = nac.title;
        articleInfo.text = nac.text;
        articleInfo.tags = createTagArray();
        articleInfo.public = (nac.viewable.name == "public");
        articleInfo.auth_token = userService.authToken;
        articleEditService.createArticle(articleInfo)
            .then(function(response){
                nac.title = '';
                nac.text = '';
                nac.tags = '';
                nac.viewable = {name: "private"};
            });
    }
});


app.controller("sideNavCtrl", function (articleReadService, articleEditService, userService) {
    var snc = this;
    snc.loggedIn = function(){
        return (userService.authToken != '' && userService.authToken != undefined);
    };
    snc.user = userService.username;

    articleReadService.listArticles().then(function (response) {
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
            if(i == 0 && (tags.length < 1 || tags.length == undefined)){

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
