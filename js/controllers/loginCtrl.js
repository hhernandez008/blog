app.controller("loginCtrl", function(userService) {
        var self = this;
        self.data = {};
        self.data.email = '';
        self.data.password = '';
        self.submitLogin = function(self.data) {
            userService.loginUser(self.data);
        };

});