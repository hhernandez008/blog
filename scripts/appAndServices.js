var app = angular.module("blogApp", []);

app.config(function($httpProvider){
    //$httpProvider.defaults.headers.get = {};
    $httpProvider.defaults.headers.post["Content-Type"] = "application/x-www-form-urlencoded";
});

app.service("getBlogData", function($http, $log){
    var paramString = function(object){
        object = $.param(object);
        return object;
    };
    this.createArticle = function(data){
        //data {title, text, tags(array), public(bool), auth_token}
        data = paramString(data);
        $http({
            url: "http://s-apis.learningfuze.com/blog/create.json",
            method: "post",
            data: data
        }).then(function(response){
            //successful response
            console.log("success", response);

        }, function(response){
            //failed response
            $log.error(response);
        })
    };

    this.listArticles = function(data){
        //data {tag[optional], count[optional], auth_token[optional]}
        data = paramString(data);
        $http({
            url: "http://s-apis.learningfuze.com/blog/list.json",
            method: "post",
            data: data
        }).then(function(response){
            //successful response
            console.log("success", response);
        }, function(response){
            //failed response
            $log.error(response);
        })
    };

    this.deleteArticles = function(data){
        //data
        data = paramString(data);
        $http({
            url: "http://s-apis.learningfuze.com/blog/delete.json",
            method: "post",
            data: data
        }).then(function(response){
            //successful response
            console.log("success", response);
        }, function(response){
            //failed response
            $log.error(response);
        })
    };

    this.readFullArticle = function(data){
        //data
        data = paramString(data);
        $http({
            url: "http://s-apis.learningfuze.com/blog/read.json",
            method: "post",
            data: data
        }).then(function(response){
            //successful response
            console.log("success", response);
        }, function(response){
            //failed response
            $log.error(response);
        })
    };

    this.updateArticle = function(data){
        //data
        data = paramString(data);
        $http({
            url: "http://s-apis.learningfuze.com/blog/update.json",
            method: "post",
            data: data
        }).then(function(response){
            //successful response
            console.log("success", response);
        }, function(response){
            //failed response
            $log.error(response);
        })
    };

    this.loginUser = function(data){
        //data
        data = paramString(data);
        $http({
            url: "http://s-apis.learningfuze.com/blog/login.json",
            method: "post",
            data: data
        }).then(function(response){
            //successful response
            console.log("success", response);
        }, function(response){
            //failed response
            $log.error(response);
        })
    };

    this.registerUser = function(data){
        //data
        data = paramString(data);
        $http({
            url: "http://s-apis.learningfuze.com/blog/register.json",
            method: "post",
            data: data
        }).then(function(response){
            //successful response
            console.log("success", response);
        }, function(response){
            //failed response
            $log.error(response);
        })
    };

    this.editUser = function(data){
        //data
        data = paramString(data);
        $http({
            url: "http://s-apis.learningfuze.com/blog/edit.json",
            method: "post",
            data: data
        }).then(function(response){
            //successful response
            console.log("success", response);
        }, function(response){
            //failed response
            $log.error(response);
        })
    };

    this.logoutUser = function(data){

    }

});

