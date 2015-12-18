var app = angular.module("blogApp");
app.controller("registrationCtrl", function(userService, $location) {
        var self = this;
        self.data = {};
        self.fName = '';
        self.lName = '';
        self.data.display_name = self.fName + '' + self.lName;
        self.data.password = '';
        self.data.email = '';
        self.registrationComplete = false;
        self.submitReg = function() {
            userService.registerUser(self.data)
                .then(function(response){
                        console.log(response);
                        self.registrationComplete = true;
                        var loginInfo = {password: self.data.password, email: response.email};
                        userService.loginUser(loginInfo).then(function(){
                                self.data = {};
                                $location.path("/");
                                self.registrationComplete = false;
                        });
                });
        };
});