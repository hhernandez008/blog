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
                        self.data = {};
                        self.registrationComplete = true;
                        var loginInfo = {password: response.password, email: response.email};
                        userService.loginUser(loginInfo);
                        $location.path("/");
                });
        };
});