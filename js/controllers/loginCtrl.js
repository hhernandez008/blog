var app = angular.module("blogApp");
app.controller("loginCtrl", function(userService) {
        var self = this;
        self.data = {};
        self.data.email = '';
        self.data.password = '';
        self.submitLogin = function() {
                console.log(self.data);
            userService.loginUser(self.data).then(function(response){
                    console.log(response);
            });
        };

});