var app = angular.module("blogApp");
app.controller("userEditCtrl", function(userService) {
        var self = this;
        self.data = {};
        self.data.uid = userService.uid;
        self.data.authToken = userService.authToken;
        self.editProfile = function() {
            userService.editUser(self.data);
        };
});