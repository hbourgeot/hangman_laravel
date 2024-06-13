(function (){
    "use strict";
    angular.module('myApp', []).controller('mainController', ['$scope',function ($scope) {
        $scope.greeting = 'Hola, Mundo!';
    }]).config(['$locationProvider', function($locationProvider) {
        $locationProvider.html5Mode(true);
    }]);
})();