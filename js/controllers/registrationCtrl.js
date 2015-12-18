var app = angular.module("blogApp");
app.controller("registrationCtrl", function(userService) {
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
                        self.data = {};
                        self.registrationComplete = true;
                });
        };
});