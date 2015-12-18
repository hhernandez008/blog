app.controller("registrationCtrl", function(userService) {
        var self = this;
        self.data = {};
        self.fName = '';
        self.lName = '';
        self.data.display_name = self.fName + ' ' + self.lName;
        self.username = '';
        self.data.password = '';
        self.data.email = '';
        self.submitReg = function(self.data) {
            userService.registerUser(self.data);
        };
});