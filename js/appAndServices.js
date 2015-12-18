var app = angular.module("blogApp", ["ngRoute", "ngSanitize"]);

app.config(['$routeProvider',
    // $routeProvider used to load proper template in index.html
    function ($routeProvider) {
        $routeProvider
            .when("/", {
                templateUrl: "views/mainBlog.html",
                controller: "blogListCtrl",
                controllerAs: "blc"
            })
            .when('/login', {
                templateUrl: 'views/login.html',
                controller: 'loginCtrl'
            })
            .when('/register', {
                templateUrl: 'views/register.html',
                controller: 'registrationCtrl'
            })
            .when('/edit-profile', {
                templateUrl: 'views/userEdit.html',
                controller: 'userEditCtrl'
            })
            .when('/edit-profile', {
                templateUrl: 'views/userEdit.html'
            })
            .when("/full-article", {
                templateUrl: "views/articleTemplate.html",
                controller: "fullArticleCtrl",
                controllerAs: "fac"
            })
            .when("/search", {
                templateUrl: "views/searchResponse.html",
                controller: "searchCtrl",
                controllerAs: "sc"
            })
            .when("/new", {
                templateUrl: "views/newArticle.html",
                controller: "newArticleCtrl",
                controllerAs: "nac"
            })
            .otherwise({
                redirectTo: '/'
            });
    }
]);

app.config(function ($httpProvider) {
    $httpProvider.defaults.headers.post["Content-Type"] = "application/x-www-form-urlencoded";
});

app.service("userService", function ($http, $log, $q) {
    var useServ = this;
    var paramString = function (object) {
        object = $.param(object);
        return object;
    };

    //set user uid & auth_token from login/register success here
    useServ.uid = null; //number
    useServ.authToken = ""; //string

    useServ.loginUser = function (data) {
        //data {email, password}
        data = paramString(data);
        var defer = $q.defer();
        $http({
            url: "http://edenprime.cloudapp.net/blog/login_user.php",
            method: "post",
            data: data
        }).then(function (response) {
            //successful response
            console.log("success", response);
            if (response.data.success) {
                useServ.uid = response.data.data.uid;
                useServ.authToken = response.data.data.auth_token;
                useServ.username = response.data.data.username;
                defer.resolve(response.data.data);
            } else {
                defer.reject(response.data);
            }
        }, function (response) {
            //failed response
            $log.error(response);
            defer.reject("Unable to connect to server at this time");
        });
        return defer.promise;
    };
    useServ.registerUser = function (data) {
        //data {email, display_name, password}
        console.log(data);
        data = paramString(data);
        var defer = $q.defer();
        $http({
            url: "http://edenprime.cloudapp.net/blog/register_user.php",
            method: "post",
            data: data
        }).then(function (response) {
            //successful response
            console.log("success", response);
            if (response.data.success) {
                defer.resolve(response.data.data);
            } else {
                defer.reject(response.data);
            }
        }, function (response) {
            //failed response
            $log.error(response);
            defer.reject("Unable to connect to server at this time");
        });
        return defer.promise;
    };

    useServ.editUser = function (data) {
        //data {uid, auth_token, display_name, password[optional], profile_img[optional]}
        data = paramString(data);
        var defer = $q.defer();
        $http({
            url: "http://s-apis.learningfuze.com/blog/edit.json",
            method: "post",
            data: data
        }).then(function (response) {
            //successful response
            console.log("success", response);
            if (response.data.success) {
                defer.resolve(response.data.data);
            } else {
                defer.reject(response.data);
            }
        }, function (response) {
            //failed response
            $log.error(response);
            defer.reject("Unable to connect to server at this time");
        });
        return defer.promise;
    };

    useServ.getUserProfile = function (data) {
        //data {uid, auth_token}
        data = paramString(data);
        var defer = $q.defer();
        $http({
            url: "http://s-apis.learningfuze.com/blog/profile.json",
            method: "post",
            data: data
        }).then(function (response) {
            //successful response
            console.log("success", response);
            if (response.data.success) {
                defer.resolve(response.data.data);
            } else {
                defer.reject(response.data);
            }
        }, function (response) {
            //failed response
            $log.error(response);
            defer.reject("Unable to connect to server at this time");
        });
        return defer.promise;
    };

    useServ.logoutUser = function (data) {
        //data {auth_token}
        data = paramString(data);
        var defer = $q.defer();
        $http({
            url: "http://s-apis.learningfuze.com/blog/logout.json",
            method: "post",
            data: data
        }).then(function (response) {
            //successful response
            console.log("success", response);
            if (response.data.success) {
                defer.resolve(response.data.data);
            } else {
                defer.reject(response.data);
            }
        }, function (response) {
            //failed response
            $log.error(response);
            defer.reject("Unable to connect to server at this time");
        });
        return defer.promise;
    };

}).service("articleReadService", function($http, $log, $q){
    var readServ = this;
    var paramString = function(object){
        object = $.param(object);
        return object;
    };

    readServ.lastFiveArticles = [];
    readServ.tags = [];

    readServ.listArticles = function(data){
        var defer = $q.defer();
        if (data != undefined) {
            //data {tag[optional], count[optional], auth_token[optional]}
            data = paramString(data);
        } else {
            $http({
                url: "http://edenprime.cloudapp.net/blog/list_blogs.php",
                method: "post"
            }).then(function (response) {
                //successful response
                console.log("success", response);
                if (response.data.success) {
                    defer.resolve(response.data.data);
                } else {
                    defer.reject(response.data);
                }
            }, function (response) {
                //failed response
                $log.error(response);
                defer.reject("Unable to connect to server at this time");
            });
            return defer.promise;
        }
        $http({
            url: "http://edenprime.cloudapp.net/blog/list_blogs.php",
            method: "post",
            data: data
        }).then(function (response) {
            //successful response
            console.log("success", response);
            if (response.data.success) {
                defer.resolve(response.data.data);
            } else {
                defer.reject(response.data);
            }
        }, function (response) {
            //failed response
            $log.error(response);
            defer.reject("Unable to connect to server at this time");
        });
        return defer.promise;
    };

    readServ.readFullArticle = function(data){
        //data {id, auth_token[optional]}
        data = paramString(data);
        var defer = $q.defer();
        $http({
            url: "http://edenprime.cloudapp.net/blog/read_one_blog.php",
            method: "post",
            data: data
        }).then(function (response) {
            //successful response
            console.log("success", response);
            console.log("response.data.data", response.data.data);
            if (response.data.success) {
                defer.resolve(response.data.data);
            } else {
                defer.reject(response.data);
            }
        }, function (response) {
            //failed response
            $log.error(response);
            defer.reject("Unable to connect to server at this time");
        });
        return defer.promise;
    };

    readServ.currentArticle = [];

    readServ.returnCurrentArticle = function(){
        return readServ.currentArticle;
    }

}).service("articleEditService", function($http, $log, $q) {
    var editServ = this;
    var paramString = function (object) {
        object = $.param(object);
        return object;
    };

    editServ.createArticle = function(data){
        //data {title, text, tags(array), public(bool), auth_token}
        data = paramString(data);
        var defer = $q.defer();
        $http({
            url: "http://s-apis.learningfuze.com/blog/create.json",
            method: "post",
            data: data
        }).then(function (response) {
            //successful response
            console.log("success", response);
            if (response.data.success) {
                defer.resolve(response.data.data);
            } else {
                defer.reject(response.data);
            }
        }, function (response) {
            //failed response
            $log.error(response);
            defer.reject("Unable to connect to server at this time");
        });
        return defer.promise;
    };

    editServ.deleteArticles = function(data){
        //data {blog_ids[array], auth_token}
        data = paramString(data);
        var defer = $q.defer();
        $http({
            url: "http://s-apis.learningfuze.com/blog/delete.json",
            method: "post",
            data: data
        }).then(function (response) {
            //successful response
            console.log("success", response);
            if (response.data.success) {
                defer.resolve(response.data.data);
            } else {
                defer.reject(response.data);
            }
        }, function (response) {
            //failed response
            $log.error(response);
            defer.reject("Unable to connect to server at this time");
        });
        return defer.promise;
    };

    editServ.updateArticle = function(data){
        //data {id, auth_token, data{title[optional], text[optional], tags[optional], public(bool)[optoinal]}
        data = paramString(data);
        var defer = $q.defer();
        $http({
            url: "http://s-apis.learningfuze.com/blog/update.json",
            method: "post",
            data: data
        }).then(function (response) {
            //successful response
            console.log("success", response);
            if (response.data.success) {
                defer.resolve(response.data.data);
            } else {
                defer.reject(response.data);
            }
        }, function (response) {
            //failed response
            $log.error(response);
            defer.reject("Unable to connect to server at this time");
        });
        return defer.promise;
    };

});

