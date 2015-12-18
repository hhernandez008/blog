app.controller("userEditCtrl", function(userService) {
        var self = this;
        self.data = {};
        self.data.uid = userService.uid;
        self.data.authToken = userService.authToken;
        self.editProfile = function(self.data) {
            userService.editUser(self.data);
        };
});